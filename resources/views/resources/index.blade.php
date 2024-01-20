@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Resources</span>  </h4>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalCenter">Add Resource</button>
        </div>

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

    <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Resource</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Course</label>
                        <select id="defaultSelect" class="form-select">
                            <option>Select Course</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Resource Title</label>
                        <input type="text" id="nameWithTitle" name="title" class="form-control" placeholder="Enter Resource Title">
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Resource Files</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple="">
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Resource Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

              
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>

    
      <div class="content-backdrop fade"></div>
    </div>
          
@endsection