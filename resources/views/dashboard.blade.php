@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    

    <div class="container-xxl flex-grow-1 container-p-y">

        @if(auth()->check() && auth()->user()->role !== 'admin' && auth()->user()->role !== 'tutor' && auth()->user()->role !== 'user')
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                    <p class="mb-4">
                                        You have coordinator privileges. You can view and manage reports.
                                    </p>    
                                    <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-primary">Manage Reports</a>
                                </div>
                            </div>

                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">

                                @if(auth()->check())
                                    @if(auth()->user()->gender === 'male')
                                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" />
                                    @else
                                        <img src="../assets/img/illustrations/woman-with-laptop.png" height="140" />
                                    @endif
                                @endif

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @else

            <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                @if(auth()->check() && auth()->user()->role === 'admin')

                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                        <p class="mb-4">
                                            You have administrative privileges. You can manage courses, resources and users.
                                        </p>    
                                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">Manage Users</a>
                                    </div>

                                @elseif(auth()->check() && auth()->user()->role === 'tutor')

                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                        <p class="mb-4">
                                            You have tutor privileges. You can manage courses, resources and quizes.
                                        </p>    
                                        <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">Manage Courses</a>
                                    </div>
                                
                                @elseif(auth()->check() && auth()->user()->role === 'user')

                                    @if(session('first_time_registered'))
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                            <p class="mb-4">
                                                We are glad you made it here. Get started by exploring our amazing study courses!
                                            </p>
                                            <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">View Courses</a>
                                        </div>
                                    @else
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Welcome Back, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                            <p class="mb-4">
                                                We love to have you back. Keep it up and get your certificates!
                                            </p>
                                            <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">Continue Lessons</a>
                                        </div>
                                    @endif

                                @endif

                            </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">

                                @if(auth()->check())
                                    @if(auth()->user()->gender === 'male')
                                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" />
                                    @else
                                        <img src="../assets/img/illustrations/woman-with-laptop.png" height="140" />
                                    @endif
                                @endif

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">

                        @if(auth()->check() && auth()->user()->role === 'admin')

                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/playlist.png" alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Courses</span>
                                    <h5 class="card-title mb-2">{{ $totalCourses }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/video-lesson.png" alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Lessons</span>
                                    <h5 class="card-title text-nowrap mb-1">{{ $totalLessons }}</h5>
                                    </div>
                                </div>
                            </div>

                        @else

                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/webinar.png" alt="chart success" class="rounded"/>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Completed Lessons</span>
                                    <h5 class="card-title mb-2">{{ $completedLessons }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/video-lesson.png" alt="Credit Card" class="rounded" />
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Total Lessons</span>
                                    <h5 class="card-title text-nowrap mb-1">{{ $totalLessons }}</h5>
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>

        @endif

        @if(auth()->check() && auth()->user()->role !== 'admin' && auth()->user()->role !== 'tutor' && auth()->user()->role !== 'user')
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row gy-4 mb-4">
                                @if ($reports->isEmpty())
                                    <div class="alert alert-warning me-1" style="margin-bottom: -15px;" role="alert">
                                        No reports uploaded yet, check back later.
                                    </div>
                                @else
                                    @foreach ($reports as $report)
                                
                                    
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        @else

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                            <div class="card-title mb-0 me-1">
                                <h5 class="mb-1">Courses</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row gy-4 mb-4">
                                @if ($courses->isEmpty())
                                    <div class="alert alert-warning me-1" style="margin-bottom: -15px;" role="alert">
                                        @if(auth()->check() && auth()->user()->role === 'tutor')
                                            No courses assigned yet, check back later.
                                        @else
                                            No courses uploaded yet, check back later.
                                        @endif
                                    </div>
                                @else
                                    @foreach ($courses as $course)
                                        @php
                                            $totalLessons = $course->lessons()->count();
                                            $totalDuration = $course->lessons()->sum('duration'); 
                                        @endphp
                        
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="card p-2 h-100 shadow-none border">
                        
                                                <div class="rounded-2 text-center mb-3">
                                                    <a href="{{ route('courses.view', ['courseId' => $course->id]) }}">
                                                        <img class="img-fluid" src="storage/course_images/{{ $course->cover_image ?? '../assets/img/online-learning.png' }}" alt="{{ $course->title }}">
                                                    </a>
                                                </div>
                                                
                                                <div class="card-body p-3 pt-2">
                        
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="badge bg-label-primary"><i class='bx bx-time'></i> {{ $totalDuration }} Minutes</span>
                                                        <span class="badge bg-label-secondary"><i class='bx bxs-videos'></i> {{ $totalLessons }} Lessons</span>
                                                    </div>
                                                    
                                                    <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" class="h5">{{ $course->title }}</a>
                                                    <p class="mt-2"> {{ $course->description }}</p>
                                                    
                                                    @if(auth()->check() && auth()->user()->role === 'user')
                                                        <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>{{ round($course->getUserProgress(auth()->user())['progressPercentage']) }}% Completed</p>
                                                        <div class="progress mb-4" style="height: 8px">
                                                            <div class="progress-bar w-{{ round($course->getUserProgress(auth()->user())['progressPercentage']) }}" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
                                                    @endif
                        
                                                    @if(auth()->check() && auth()->user()->role === 'admin')
                                                        <div class="d-flex gap-2">
                                                            <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">View</a>
                                                            
                                                            <form method="POST" action="{{ route('courses.delete', ['courseId' => $course->id]) }}" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                            
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this course?')" style="width: 100%;" class="btn btn-outline-danger">Delete</button>
                                                            </form> 
                                                                
                                                        </div>
                                                    @endif
                        
                                                </div>
                        
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                                        
                    </div>
                </div>
            </div>

        @endif

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