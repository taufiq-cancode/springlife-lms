<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bsLesson;
use App\Models\bsStudentProgress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class bsLessonController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $completedLessonsCount = bsStudentProgress::where('user_id', $userId)
                                                    ->where('is_completed', true)
                                                    ->count();

        $completedLessons = bsStudentProgress::where('user_id', $userId)
                                                    ->where('is_completed', true)
                                                    ->pluck('bs_lesson_id')
                                                    ->toArray();

        $totalLessonsCount = bsLesson::count();

        $lessons = bsLesson::all();
        return view('bs.lessons.index', compact('lessons', 'completedLessonsCount', 'totalLessonsCount', 'completedLessons'));
    }

    public function store(Request $request) 
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'video_link' => 'nullable|string',
                'duration' => 'nullable|integer',
                'pdfs.*' => 'required|file|mimes:pdf|max:2048',
            ]);

            if($request->video_link){
                $videoId = $this->extractVideoId($request->input('video_link'));
            }

            $lesson = new bsLesson([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'video_link' => $request->input('video_link'),
                'video_id' => $videoId ?? null,
                'duration' => $request->input('duration')
            ]);

            $lesson->save();

            if ($request->hasFile('pdfs')) {
                foreach ($request->file('pdfs') as $pdf) {
                    $path = $pdf->store('bs_pdfs', 'public');

                    $lesson->bsPdfs()->create([
                        'file_path' => $path
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Lesson added successfully');

        } catch (ValidationException $e) {
            Log::error('Error while adding lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Validation error while adding lesson');

        } catch (\Exception $e) {
            Log::error('Error while adding lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding lesson');
        }
    }

    private function extractVideoId($url){
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $url, $matches);

        return $matches[1] ?? null;
    }

    public function view($bsLessonId){
        try {
            $lesson = bsLesson::with('bsPdfs')->findOrFail($bsLessonId);
            return view('bs.lesson.view', compact('lesson'));
        } catch (\Exception $e) {
            Log::error('Error while viewing lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error viewing lesson: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $bsLessonId) 
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'video_link' => 'nullable|string',
                'duration' => 'nullable|integer',
                'pdfs.*' => 'file|mimes:pdf|max:2048',
            ]);

            $lesson = bsLesson::findOrFail($bsLessonId);

            $videoId = $this->extractVideoId($request->input('video_link'));

            $lesson->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'video_link' => $request->input('video_link'),
                'video_id' => $videoId,
                'duration' => $request->input('duration')
            ]);

            if ($request->hasFile('pdfs')) {
                foreach ($request->file('pdfs') as $pdf) {
                    $path = $pdf->store('bs_pdfs', 'public');

                    $lesson->pdfs()->create([
                        'file_path' => $path
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Lesson updated successfully');

        } catch (ValidationException $e) {
            Log::error('Validation error while updating lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Validation error while updating lesson');

        } catch (\Exception $e) {
            Log::error('Error while updating lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating lesson');
        }
    }

    public function delete($bsLessonId)
    {
        try {
            $lesson = bsLesson::findOrFail($bsLessonId);

            $lesson->delete();

            return redirect()->back()->with('success', 'Lesson deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting lesson: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
