<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResourceController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');

    Route::prefix('profile')->group(function(){
        Route::get('/', [ProfileController::class, 'index']) ->name('profile.index');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::prefix('courses')->group(function(){
        Route::get('/', [CourseController::class, 'index']) ->name('courses.index');
        Route::get('/add', [CourseController::class, 'create']) ->name('courses.add');
        Route::post('/store', [CourseController::class, 'store']) ->name('courses.store');
        Route::get('/view/{courseId}', [CourseController::class, 'view']) ->name('courses.view');
        Route::get('/edit/{courseId}', [CourseController::class, 'edit']) ->name('courses.edit');
        Route::post('/update/{courseId}', [CourseController::class, 'update']) ->name('courses.update');
        Route::get('/delete/{courseId}', [CourseController::class, 'delete']) ->name('courses.delete');
    });

    Route::prefix('lessons')->group(function(){
        Route::get('/', [LessonController::class, 'index']) ->name('lessons.index');
        Route::get('/add/{courseId}', [LessonController::class, 'create']) ->name('lessons.add');
        Route::post('/store/{courseId}', [LessonController::class, 'store']) ->name('lessons.store');
        Route::get('/view/{lessonId}', [LessonController::class, 'view']) ->name('lessons.view');
        Route::get('/edit/{lessonId}', [LessonController::class, 'edit']) ->name('lessons.edit');
        Route::post('/update/{lessonId}', [LessonController::class, 'update']) ->name('lessons.update');
        Route::get('/delete/{lessonId}', [LessonController::class, 'delete']) ->name('lessons.delete');
    });
    
    Route::prefix('resources')->group(function(){
        Route::get('/', [ResourceController::class, 'index']) ->name('resources.index');
        Route::get('/add/{courseId}', [ResourceController::class, 'create']) ->name('resources.add');
        Route::post('/store/{courseId}', [ResourceController::class, 'store']) ->name('resources.store');
        Route::get('/download/{resourceId}', [ResourceController::class, 'download'])->name('resources.download');
        Route::get('/view/{resourceId}', [ResourceController::class, 'view']) ->name('resources.view');
        Route::get('/edit/{resourceId}', [ResourceController::class, 'edit']) ->name('resources.edit');
        Route::post('/update/{resourceId}', [ResourceController::class, 'update']) ->name('resources.update');
        Route::get('/delete/{resourceId}', [ResourceController::class, 'delete']) ->name('resources.delete');
    });
    
    Route::prefix('quiz')->group(function(){
        Route::get('/', [QuizController::class, 'index']) ->name('quiz.index');
        Route::get('/add/{courseId}', [QuizController::class, 'create']) ->name('quiz.add');
        Route::post('/store/{courseId}', [QuizController::class, 'store']) ->name('quiz.store');
        Route::get('/view', [QuizController::class, 'view']) ->name('quiz.view');
        Route::get('/edit/{quizId}', [QuizController::class, 'edit']) ->name('quiz.edit');
        Route::post('/update/{quizId}', [QuizController::class, 'update']) ->name('quiz.update');
        Route::get('/delete/{quizId}', [QuizController::class, 'delete']) ->name('quiz.delete');
    });
    
    Route::prefix('certificates')->group(function(){
        Route::get('/', [CertificateController::class, 'index']) ->name('certificates.index');
    });
    
    

});





// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
