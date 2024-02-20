<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Question;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class QuizController extends Controller
{
    public function index(){
        try{
            
            $courses = Course::all();

            $courseQuestionCounts = [];
            foreach ($courses as $course) {
                $questionCount = Question::where('course_id', $course->id)->count();
                $courseQuestionCounts[$course->id] = $questionCount;
            }
            
            return view('quiz.index', compact('courses', 'courseQuestionCounts'));

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }

    public function showQuestions($courseId){
        try{

            
            return view('quiz', compact('questions'));

        }catch(\Exception $e){

        }
        
    }

    public function view($courseId){
        try{ 
            $user = auth()->user();
            $course = Course::findOrFail($courseId);

            if (!$user->hasCompletedCourse($course)) {
                return redirect()->route('quiz.index', $courseId)->with('error', 'Please complete all lessons in this course before taking the quiz.');
            }

            $questions = Question::inRandomOrder()->where('course_id', $courseId)->limit(20)->get();

            return view('quiz.view', compact('course', 'questions'));

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }

    public function adminView($courseId){
        try{ 
            $user = auth()->user();

            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $course = Course::findOrFail($courseId);
            $questions = Question::where('course_id', $course->id)->get();


            return view('quiz.admin-view', compact('course','questions'));

        }catch (\Exception $e){
            Log::error('Error while retrieving quiz : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving quiz');
        }   
    }
    public function uploadQuestions(Request $request, $courseId){
        try{
            $user = auth()->user();  

            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $course = Course::findOrFail($courseId);

            $request->validate([
                'csv_file' => 'required|mimes:csv,txt|max:2048',
            ]);

            if ($request->hasFile('csv_file')){
                $file = $request->file('csv_file');
                $path = $file->getRealPath();
                $data = array_map('str_getcsv', file($path));

                $header = array_shift($data);

                foreach ($data as $row){
                    $question = new Question();

                    $question->question_text = $row[0];
                    $question->option1 = $row[1];
                    $question->option2 = $row[2];
                    $question->option3 = $row[3];
                    $question->option4 = $row[4];
                    $question->correct_option = $row[5];
                    $question->course_id = $course->id; 
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

    public function storeQuestion(Request $request, $courseId){
        try{
            $user = auth()->user();  

            if ($user->role !== 'admin'){
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

            $course = Course::findOrFail($courseId);

            if (!$course) {
                return redirect()->back()->with('error', 'Course not found');
            }
    
            $question = new Question([
                'question_text' => $request->input('question_text'),
                'option1' => $request->input('option1'),
                'option2' => $request->input('option2'),
                'option3' => $request->input('option3'),
                'option4' => $request->input('option4'),
                'correct_option' => $request->input('correct_option'),
            ]);
    
            $question->course_id = $course->id;
            $question->save();

            return redirect()->back()->with('success', 'Question added successfully.');

        }catch(\Exception $e){
            Log::error('Error while adding quiz question: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while adding quiz question');
        }
    }
    public function updateQuestion(Request $request, $questionId){
        try{

            $user = auth()->user();  

            if ($user->role !== 'admin'){
                return redirect()->back()->with('error', 'Unauthorized access');
            }

            $question = Question::findOrFail($questionId);
            
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

    public function deleteQuestion($questionId){
        try {
            $question = Question::findOrFail($questionId);

            $question->delete();

            return redirect()->back()->with('success', 'Question deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error while deleting question: ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
