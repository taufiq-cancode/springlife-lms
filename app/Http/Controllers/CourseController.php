<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\FileText;
use App\Models\FileVector;
use App\Models\Lesson;
use App\Models\Comment;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Smalot\PdfParser\Parser;
use OpenAI\Laravel\Facades\OpenAI;



class CourseController extends Controller
{
    public function index(){
        try{

            $courses = Course::all();
            
            return view('courses.index', compact('courses'));

        }catch (\Exception $e){
            Log::error('Error while retrieving courses : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving courses');
        }        
    }
    public function store(Request $request){
        try{
            $user = auth()->user();  

            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|mimes:pdf|max:20480',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('course_files', $fileName, 'public');

            $cover_image = $request->file('cover_image');
            $imageName = time() . '_' . $cover_image->getClientOriginalName();
            $cover_image->storeAs('course_images', $imageName, 'public');
            
            $course = new Course();
            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->file = $fileName;
            $course->cover_image = $imageName;
            $course->save();

            $this->getEmbeddings($fileName, $course);


            DB::commit();
            return redirect()->route('courses.index')->with('success', 'Course created successfully!');
            

        }catch (\Exception $e){

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

            $course = Course::findOrFail($courseId);
            $resources = $course->resources;
            $lessons = $course->lessons; 
            $lessonCount = $course->lessons->count();
            $comments = Comment::all();

            $progress = $course->getUserProgress($user);

            $totalLessons = $progress['totalLessons'];
            $completedLessons = $progress['completedLessons'];
            $progressPercentage = $progress['progressPercentage'];

            return view('courses.view', compact('course', 'resources', 'lessons', 'lessonCount', 'completedLessons', 'comments'));

        }catch(\Exception $e){

            Log::error('Error while viewing course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }
    public function update(Request $request, $courseId){
        try{
            $user = auth()->user();  
    
            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }
    
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'file' => 'nullable|mimes:pdf|max:20480',
            ]);
    
            $course = Course::findOrFail($courseId);
    
            if ($request->hasFile('file')) {
                Storage::disk('public')->delete('course_files/' . $course->file);

                $file = $request->file('file');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('course_files', $fileName, 'public');

                $course->file = $fileName;

                $this->getEmbeddings($fileName, $course);
            }

            if ($request->hasFile('cover_image')) {
                Storage::disk('public')->delete('course_images/' . $course->file);

                $cover_image = $request->file('cover_image');
                $imageName = time() . '_' . $cover_image->getClientOriginalName();
                $cover_image->storeAs('course_images', $imageName, 'public');

                $course->cover_image = $imageName;
            }
            
            $course->title = $request->input('title');
            $course->description = $request->input('description');
            $course->save();
        
            return redirect()->route('courses.index')->with('success', 'Course updated successfully!');

        } catch (\Exception $e){
    
            Log::error('Error while updating course: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
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
    public function download($courseId){
        try{
            $course = Course::findOrFail($courseId);

            $filePath = public_path("storage/course_files/{$course->file}");

            if (file_exists($filePath)) {
                $filename = $course->title . '.pdf';

                $headers = [
                    'Content-Type' => 'application/pdf',
                ];

                return response()->download($filePath, $filename, $headers);
            } else {
                return redirect()->route('courses.index')->with('error', 'PDF file not found.');
            }

        }catch(\Exception $e){
            Log::error('Error while downloading file: '. $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }


    
}
