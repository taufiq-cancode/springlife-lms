<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bsLesson;
use App\Models\bsQuestion;
use App\Models\bsStudentProgress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class bsQuizController extends Controller
{
    public function view($bsLessonId)
    {
        try{ 
            $user = auth()->user();
            $lesson = bsLesson::findOrFail($bsLessonId);

            if($user->role === 'admin'){
                $questions = bsQuestion::where('bs_lesson_id', $bsLessonId)->get();
            }else{
                $questions = bsQuestion::inRandomOrder()->where('bs_lesson_id', $bsLessonId)->limit(20)->get();
            }

            return view('bs.quiz.view', compact('lesson', 'questions'));

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }

    public function submitQuiz(Request $request)
    {
        $lessonId = $request->input('bs_lesson_id');
        $answers = $request->input('answers');
        $totalQuestions = count($answers);
        $score = 0;
    
        foreach ($answers as $answer) {
            $answer = json_decode($answer, true);
            $question = bsQuestion::find($answer['question_id']);
            if ($question->correct_option == $answer['selected_option']) {
                $score++;
            }
        }
    
        $percentage = ($score / $totalQuestions) * 100;
        $status = $percentage >= 100 ? 'success' : 'error';
    
        if ($percentage == 100) {
            $existingProgress = bsStudentProgress::where('user_id', Auth::id())
                ->where('bs_lesson_id', $lessonId)
                ->first();
    
            if (!$existingProgress) {
                bsStudentProgress::create([
                    'user_id' => Auth::id(),
                    'bs_lesson_id' => $lessonId,
                    'is_completed' => true
                ]);
            }
        }
    
        return view('bs.quiz.quiz-result', compact('percentage', 'status'));
    }
    

    public function storeQuestion(Request $request, $bsLessonId)
    {
        try{
            $user = auth()->user();  

            if ($user->role === 'user'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $request->validate([
                'question_text' => 'required|string',
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'correct_option' => 'required|in:option1,option2,option3,option4',
            ]);

            $lesson = bsLesson::findOrFail($bsLessonId);

            if (!$lesson) {
                return redirect()->back()->with('error', 'Course not found');
            }
    
            $question = new bsQuestion([
                'question_text' => $request->input('question_text'),
                'option1' => $request->input('option1'),
                'option2' => $request->input('option2'),
                'option3' => $request->input('option3'),
                'option4' => $request->input('option4'),
                'correct_option' => $request->input('correct_option'),
            ]);
    
            $question->bs_lesson_id = $lesson->id;
            $question->save();

            return redirect()->back()->with('success', 'Question added successfully.');

        }catch(\Exception $e){
            Log::error('Error while adding quiz question: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding quiz question');
        }
    }

    public function uploadQuestions(Request $request, $bsLessonId)
    {
        try{
            $user = auth()->user();  

            if ($user->role === 'user'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $lesson = bsLesson::findOrFail($bsLessonId);

            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048',
            ]);

            if ($request->hasFile('csv_file')){
                $file = $request->file('csv_file');
                $path = $file->getRealPath();
                $data = array_map('str_getcsv', file($path));

                $header = array_shift($data);

                foreach ($data as $row){
                    $question = new bsQuestion();

                    $question->question_text = $row[0];
                    $question->option1 = $row[1];
                    $question->option2 = $row[2];
                    $question->option3 = $row[3];
                    $question->option4 = $row[4];
                    $question->correct_option = $row[5];
                    $question->bs_lesson_id = $lesson->id; 
                    $question->save();
                }

                return redirect()->back()->with('success', 'Questions uploaded successfully.');
            }
            return redirect()->back()->with('error', 'Failed to upload questions. Please try again.');
        }catch(\Exception $e){
            Log::error('Error while uploading quiz questions: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while uploading quiz questions');
        }
    }

    public function updateQuestion(Request $request, $questionId){
        try{

            $user = auth()->user();  

            if ($user->role === 'user'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $question = bsQuestion::findOrFail($questionId);
            
            $request->validate([
                'question_text' => 'required|string',
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'correct_option' => 'required|in:option1,option2,option3,option4',
            ]);

            $question->update($request->all());

            return redirect()->back()->with('success', 'Question updated successfully.');

        }catch(\Exception $e){
            Log::error('Error while update quiz question: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while updating quiz question');
        }
    }

    public function deleteQuestion($questionId)
    {
        try {
            $question = bsQuestion::findOrFail($questionId);
            $question->delete();

            return redirect()->back()->with('success', 'Question deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting question: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
