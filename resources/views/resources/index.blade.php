@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Resources</span>
          </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                <div class="card-body">
                    <div class="row gy-4 mb-4">
                        
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100">
                              <img class="card-img-top" src="../assets/img/elements/2.jpg" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">Resource title</h5>
                                <p class="card-text">
                                  Resource Description
                                </p>
                                <a href="javascript:void(0)" class="btn btn-outline-primary">Download Resource <i class='bx bx-download'></i></a>
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