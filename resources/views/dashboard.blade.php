@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        @if(auth()->check() && auth()->user()->role === 'admin')

                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome, Admin {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                <p class="mb-4">
                                    You have administrative privileges. You can manage courses, resources and users.
                                </p>    
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">Manage Courses</a>
                            </div>
                        
                        @else

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
                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">Continue Lessons</a>
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
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded"/>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Completed Lessons</span>
                    <h5 class="card-title mb-2">10</h5>
                    </div>
                </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Lessons</span>
                    <h5 class="card-title text-nowrap mb-1">19</h5>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

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
                <div class="col-sm-6 col-lg-4">
                    <div class="card p-2 h-100 shadow-none border">
                    <div class="rounded-2 text-center mb-3">
                        <a href="app-academy-course-details.html"><img class="img-fluid" src="../assets/img/app-academy-tutor-1.png" alt="tutor image 1"></a>
                    </div>
                    <div class="card-body p-3 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-label-primary"><i class='bx bx-time'></i> 20 Hours</span>
                        <span class="badge bg-label-secondary"><i class='bx bxs-videos'></i> 20 Lessons</span>
                        </div>
                        <a href="app-academy-course-details.html" class="h5">Basics of Angular</a>
                        <p class="mt-2">Introductory course for Angular and framework basics in web development.</p>
                        <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30% Completed</p>
                        <div class="progress mb-4" style="height: 8px">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card p-2 h-100 shadow-none border">
                    <div class="rounded-2 text-center mb-3">
                        <a href="app-academy-course-details.html"><img class="img-fluid" src="../assets/img/app-academy-tutor-1.png" alt="tutor image 1"></a>
                    </div>
                    <div class="card-body p-3 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-label-primary"><i class='bx bx-time'></i> 20 Hours</span>
                        <span class="badge bg-label-secondary"><i class='bx bxs-videos'></i> 20 Lessons</span>
                        </div>
                        <a href="app-academy-course-details.html" class="h5">Basics of Angular</a>
                        <p class="mt-2">Introductory course for Angular and framework basics in web development.</p>
                        <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30% Completed</p>
                        <div class="progress mb-4" style="height: 8px">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
                    </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <div class="card p-2 h-100 shadow-none border">
                    <div class="rounded-2 text-center mb-3">
                        <a href="app-academy-course-details.html"><img class="img-fluid" src="../assets/img/app-academy-tutor-1.png" alt="tutor image 1"></a>
                    </div>
                    <div class="card-body p-3 pt-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-label-primary"><i class='bx bx-time'></i> 20 Hours</span>
                        <span class="badge bg-label-secondary"><i class='bx bxs-videos'></i> 20 Lessons</span>
                        </div>
                        <a href="app-academy-course-details.html" class="h5">Basics of Angular</a>
                        <p class="mt-2">Introductory course for Angular and framework basics in web development.</p>
                        <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30% Completed</p>
                        <div class="progress mb-4" style="height: 8px">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <a href="" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
                    </div>
                    </div>
                </div>
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