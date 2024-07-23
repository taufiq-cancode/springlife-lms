<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bsLessonController;
use App\Http\Controllers\bsQuizController;
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
    return view('auth.login');
});

Route::get('/bible-studies/login', function () {
    return view('auth.login');
});

Route::get('/mission-institute/login', function () {
    return view('auth.login');
});

Route::get('/campus-mission/login', function () {
    return view('auth.login');
});

Route::get('/certificate', function () {
    return view('certificate');
});

// Route::get('/bible-studies/login', [AuthController::class, 'showLoginForm'])->name('bible-studies.login');
// Route::post('/bible-studies/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');
    Route::get('/mission-institute', [DashboardController::class, 'instituteDashboard']) ->name('institute.dashboard');
    Route::get('/campus-mission', [DashboardController::class, 'campusDashboard']) ->name('campus.dashboard');

    Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])->name('submit-quiz');
    Route::post('/submit-bs-quiz', [bsQuizController::class, 'submitQuiz'])->name('bs.submit-quiz');
    Route::post('/bible-studies/logout', [AuthController::class, 'logout'])->name('bible.logout');

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
        Route::put('/update/{courseId}', [CourseController::class, 'update']) ->name('courses.update');
        Route::delete('/delete/{courseId}', [CourseController::class, 'delete']) ->name('courses.delete');
        Route::get('/download/{courseId}', [ResourceController::class, 'download'])->name('courses.download');
    });

    Route::prefix('lessons')->group(function(){
        Route::get('/', [LessonController::class, 'index']) ->name('lessons.index');
        Route::post('/store/{courseId}', [LessonController::class, 'store']) ->name('lessons.store');
        Route::get('/view/{lessonId}', [LessonController::class, 'view']) ->name('lessons.view');
        Route::put('/update/{lessonId}', [LessonController::class, 'update']) ->name('lessons.update');
        Route::delete('/delete/{lessonId}', [LessonController::class, 'delete']) ->name('lessons.delete');
        Route::post('/{lessonId}/complete', [LessonController::class, 'completeLesson']) ->name('lessons.complete');
    });
    
    Route::prefix('resources')->group(function(){
        Route::get('/', [ResourceController::class, 'index']) ->name('resources.index');
        Route::get('/add/{courseId}', [ResourceController::class, 'create']) ->name('resources.add');
        Route::post('/store/{courseId}', [ResourceController::class, 'store']) ->name('resources.store');
        Route::get('/download/{resourceId}', [ResourceController::class, 'download'])->name('resources.download');
        Route::get('/view/{courseId}', [ResourceController::class, 'view']) ->name('resources.view');
        Route::get('/edit/{resourceId}', [ResourceController::class, 'edit']) ->name('resources.edit');
        Route::post('/update/{resourceId}', [ResourceController::class, 'update']) ->name('resources.update');
        Route::get('/delete/{resourceId}', [ResourceController::class, 'delete']) ->name('resources.delete');
    });
    
    Route::prefix('quiz')->group(function(){
        Route::get('/', [QuizController::class, 'index']) ->name('quiz.index');
        Route::get('/view/{courseId}', [QuizController::class, 'view']) ->name('quiz.view');
        Route::get('/admin-view/{courseId}', [QuizController::class, 'adminView']) ->name('quiz.admin-view');
        Route::post('/store/question/{courseId}', [QuizController::class, 'storeQuestion']) ->name('quiz.question.store');
        Route::post('/upload/{courseId}', [QuizController::class, 'uploadQuestions'])->name('quiz.question.upload');
        Route::post('/update/question/{questionId}', [QuizController::class, 'updateQuestion']) ->name('quiz.question.update');
        Route::delete('/delete/question/{questionId}', [QuizController::class, 'deleteQuestion']) ->name('quiz.question.delete');
        Route::get('/question/template', [QuizController::class, 'downloadTemplate'])->name('quiz.question.template');

    });
    
    Route::prefix('certificates')->group(function(){
        Route::get('/', [CertificateController::class, 'index']) ->name('certificates.index');
        // Route::get('/{userId}/{courseId}', [CertificateController::class, 'generateCertificate'])->name('certificate.generate');
        Route::get('/{userId}/{courseId}', [CertificateController::class, 'generateCertificate'])->name('certificate.show');
    });

    Route::prefix('users')->group(function(){
        Route::get('/', [UsersController::class, 'index']) ->name('users.index');
        Route::post('/store', [UsersController::class, 'store']) ->name('user.store');
        Route::put('/update/{userId}', [UsersController::class, 'update']) ->name('user.update');
        Route::delete('/delete/{userId}', [UsersController::class, 'delete']) ->name('user.delete');
    });

    Route::prefix('tutor')->group(function(){
        Route::post('/store', [TutorController::class, 'store']) ->name('tutor.store');
        Route::put('/update/{tutorId}', [TutorController::class, 'update']) ->name('tutor.update');
        Route::delete('/delete/{tutorId}', [TutorController::class, 'delete']) ->name('tutor.delete');
    });

    Route::prefix('coordinator')->group(function(){
        Route::get('/', [UsersController::class, 'coordinators']) ->name('coordinator.index');
        Route::post('/store', [UsersController::class, 'store']) ->name('coordinator.store');
        Route::put('/update/{coordinatorId}', [UsersController::class, 'update']) ->name('coordinator.update');
        Route::delete('/delete/{coordinatorId}', [UsersController::class, 'delete']) ->name('coordinator.delete');
    });

    Route::prefix('admin')->group(function(){
        Route::post('/store', [AdminController::class, 'store']) ->name('admin.store');
        Route::put('/update/{adminId}', [UsersController::class, 'update']) ->name('admin.update');
        Route::delete('/delete/{adminId}', [UsersController::class, 'delete']) ->name('admin.delete');
    });

    Route::post('/comments/{courseId}', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/reply/{courseId}', [CommentController::class, 'store'])->name('reply.store');

    Route::prefix('reports')->group(function(){
        Route::get('/', [ReportController::class, 'index']) ->name('reports.index');
        Route::get('/create', [ReportController::class, 'create']) ->name('reports.create');
        Route::get('/view/{id}/{role}', [ReportController::class, 'showReport']) ->name('report.view');
        Route::post('/store/student', [ReportController::class, 'student']) ->name('report.student');
        Route::post('/store/mission', [ReportController::class, 'mission']) ->name('report.mission');
        Route::post('/store/chapter', [ReportController::class, 'chapter']) ->name('report.chapter');
        Route::post('/store/zonal', [ReportController::class, 'zonal']) ->name('report.zonal');
        Route::post('/store/regional', [ReportController::class, 'regional']) ->name('report.regional');
    });

    Route::prefix('bible-studies')->group(function() {
        Route::get('/', [DashboardController::class, 'bibleDashboard'])->name('bible.dashboard');
        Route::get('/lessons', [bsLessonController::class, 'index'])->name('bs.lessons.index');
        Route::get('/profile', [ProfileController::class, 'bsIndex'])->name('bs.profile');
        Route::get('/students', [UsersController::class, 'bsIndex'])->name('bs.users');
        Route::post('/store/lessons', [bsLessonController::class, 'store'])->name('bs.lessons.store');
        Route::get('/certificate/{userId}', [CertificateController::class, 'bsShowCertificate'])->name('bs.certificate.show');

        Route::prefix('quiz')->group(function(){
            Route::get('/view/{bsLessonId}', [bsQuizController::class, 'view']) ->name('bs.quiz.view');
            Route::post('/store/question/{bsLessonId}', [bsQuizController::class, 'storeQuestion']) ->name('bs.quiz.question.store');
            Route::post('/upload/{bsLessonId}', [bsQuizController::class, 'uploadQuestions'])->name('bs.quiz.question.upload');
            Route::post('/update/question/{questionId}', [bsQuizController::class, 'updateQuestion']) ->name('bs.quiz.question.update');
            Route::delete('/delete/question/{questionId}', [bsQuizController::class, 'deleteQuestion']) ->name('bs.quiz.question.delete');
        }); 
    });

    Route::get('campus-mission/profile', [ProfileController::class, 'cmIndex'])->name('cm.profile');
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
