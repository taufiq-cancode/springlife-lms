@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Courses</span>
          </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                
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
                            <a href="{{ route('lessons.index') }}" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
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