@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Quizes</span>
          </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                <div class="card-body">
                    <div class="row gy-4 mb-4">
                        @foreach ($courses as $course)
                            <div class="col-sm-6 col-lg-4">
                                <div class="card p-2 h-100 shadow-none border">

                                    <div class="rounded-2 text-center mb-3">
                                        <a href="{{ route('courses.view', ['courseId' => $course->id]) }}"><img class="img-fluid" src="storage/{{ $course->cover_image ?? '../assets/img/online-learning.png' }}" alt="{{ $course->title }}"></a>
                                    </div>
                                    
                                    <div class="card-body p-3 pt-2">
                                        @if(auth()->check() && auth()->user()->role === 'user')
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-label-primary"><i class='bx bx-question-mark'></i> 20 Question</span>
                                                <span class="badge bg-label-secondary"><i class='bx bxs-time'></i> 30 Minutes</span>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-label-primary" style="width:100%"><i class='bx bx-question-mark'></i> {{ $courseQuestionCounts[$course->id] }} Question</span>
                                            </div>
                                        @endif
                                        
                                        <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" class="h5">{{ $course->title }}</a>
                                        <p class="mt-2">{{ $course->description }}</p>
                                        
                                        @if(auth()->check() && auth()->user()->role === 'user')
                                            <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>{{ round($course->getUserProgress(Auth::user())['progressPercentage']) }}% Completed</p>
                                            <div class="progress mb-4" style="height: 8px">
                                                <div class="progress-bar w-{{ round($course->getUserProgress(Auth::user())['progressPercentage']) }}" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <a href="{{ route('quiz.view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">Start Quiz <i class='bx bx-chevron-right'></i></a>
                                        @endif

                                        @if(auth()->check() && auth()->user()->role === 'admin')
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('quiz.admin-view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">View Quiz</a>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->


    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
            document.write(new Date().getFullYear());
            </script> Spring Life Ministry. Developed by
            <a href="https://purplebeetech.com" target="_blank" class="footer-link fw-bolder">Purple Bee Technologies.</a>
        </div>
        </div>
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>
          
@endsection