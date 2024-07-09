<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FileText;
use App\Models\FileVector;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Comment;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Smalot\PdfParser\Parser;
use OpenAI\Laravel\Facades\OpenAI;



class CourseController extends Controller
{
    public function index()
    {
        $tutors = User::where('role', 'tutor')->get();

        $user = auth()->user();
        $courses = [];

        if ($user->role === 'admin') {
            $courses = Course::orderBy('created_at', 'desc')->get();
        } elseif ($user->role === 'tutor') {
            $courses = $user->tutoredCourses()->orderBy('created_at', 'desc')->get();
        } else {
            $courses = Course::orderBy('created_at', 'desc')->get();
        }
        
        return view('courses.index', compact('courses', 'tutors')); 
    }

    public function store(Request $request)
    {
        try{
            $user = auth()->user();  
    
            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }
    
            DB::beginTransaction();
    
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'nullable|mimes:pdf|max:20480',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'tutor_id' => 'nullable|exists:users,id',
            ]);
    
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('files', 'public');
            }

            if ($request->hasFile('cover_image')) {
                $imageName = $request->file('cover_image')->store('course_images', 'public');
            }
    
            $course = new Course();
            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->file = $filePath;
            $course->cover_image = $imageName;
            $course->save();
    
            if ($request->filled('tutor_id')) {
                $course->tutors()->attach($request->input('tutor_id'));
            }
    
            DB::commit();
    
            return redirect()->route('courses.index')->with('success', 'Course created successfully!');
        
        } catch(ValidationException $e) {
            DB::rollback();
            Log::error('Error while creating course: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while creating course: '. $e->getMessage()); 
    
        } catch (\Exception $e){
            DB::rollback();
            Log::error('Error while creating course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    private function processPdf ($fileName, $course){
        try{

            $parser = new Parser();
            $pdf = $parser->parseFile(storage_path('app/public/course_files/' . $fileName));
            $text = $pdf->getText();

            $text = str_replace("\n", " ", $text);
            $text = preg_replace('/[^A-Za-z0-9 \-]/', '', $text);

            $processedEmbeddings = $this->getEmbeddings($text, $course);

            return $text;

        }catch(\Exception $e){
            Log::error('Error while processing PDF: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    private function getEmbeddings($text, $course){
        try{
            $vector = OpenAI::embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => $text,
            ]);

            $fileText = FileText::firstOrCreate([
                'course_id' => $course->id,
                'file_text' => $text,
            ]);

            $vectors = FileVector::create([
                'file_text_id' => $fileText->id,
                'vector' => json_encode($vector['data'][0]['embedding']),
                'course_id' => $course->id,
            ]);


        }catch(\Exception $e){

            Log::error('Error while getting embeddings: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());

        }
    }
    public function view($courseId){
        try{
            $user = Auth::user();

            $course = Course::with('tutors')->findOrFail($courseId);
            $tutors = User::where('role', 'tutor')->get(); // Adjust this query as needed to get the tutors
        
            $resources = $course->resources;
            $lessons = $course->lessons; 
            $lessonCount = $course->lessons->count();
            $comments = Comment::where('course_id', $courseId)->get();

            $progress = $course->getUserProgress($user);

            $totalLessons = $progress['totalLessons'];
            $completedLessons = $progress['completedLessons'];
            $progressPercentage = $progress['progressPercentage'];

            return view('courses.view', compact('course', 'tutors', 'resources', 'lessons', 'lessonCount', 'completedLessons', 'comments'));

        }catch(\Exception $e){

            Log::error('Error while viewing course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }
    public function update(Request $request, $courseId) {
        try {
            $user = auth()->user();
            $course = Course::with('tutors')->findOrFail($courseId);
    
            if ($user->role !== 'admin' && !$course->tutors->contains($user->id)) {
                return redirect()->back()->with('error', 'Unauthorized access');
            }
    
            DB::beginTransaction();
    
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'file' => 'nullable|mimes:pdf|max:20480',
            ];
    
            if ($user->role === 'admin') {
                $rules['tutor_id'] = 'nullable|exists:users,id';
            }
    
            $request->validate($rules);

            if ($request->hasFile('file')) {
                $file = $request->file('file');
        
                if ($course->file) {
                    Storage::disk('public')->delete($course->file);
                }
        
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('course_files', $fileName, 'public');
                $course->file = $filePath;
            }
        
            if ($request->hasFile('cover_image')) {
                $cover_image = $request->file('cover_image');
        
                if ($course->cover_image) {
                    Storage::disk('public')->delete($course->cover_image);
                }
        
                $imageName = time() . '_' . $cover_image->getClientOriginalName();
                $imagePath = $cover_image->storeAs('course_images', $imageName, 'public');
                $course->cover_image = $imagePath;
            }
    
            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->save();
    
            if ($user->role === 'admin' && $request->filled('tutor_id')) {
                $course->tutors()->sync([$request->input('tutor_id')]);
            }
    
            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    
        } catch (ValidationException $e) {
            DB::rollBack();
            Log::error('Error while updating course: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating course: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error while updating course: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
    public function delete($courseId){
        try {
            $course = Course::findOrFail($courseId);
            $course->delete();

            return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting course: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }
    public function download($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
    
            // Use storage_path instead of public_path
            $filePath = storage_path("app/public/{$course->file}");
    
            if (file_exists($filePath)) {
                $filename = $course->title . '.pdf';
    
                $headers = [
                    'Content-Type' => 'application/pdf',
                ];
    
                return response()->download($filePath, $filename, $headers);
            } else {
                return redirect()->route('courses.index')->with('error', 'PDF file not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error while downloading file: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while downloading file');
        }
    }
      
}
