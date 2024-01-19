@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Certificates</span>
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
                                    <a href="app-academy-course-details.html" class="h5">Basics of Angular</a>
                                    <p class="mt-2">Introductory course for Angular and framework basics in web development.</p>
                                    <a href="javascript:void(0)" class="btn btn-outline-primary">Download Certificate <i class='bx bx-download'></i></a>
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