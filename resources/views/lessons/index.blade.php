@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Courses /</span> Course Title </h4>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalCenter">Add Lesson</button>
        @endif

      </div>
      
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                   
                    <div class="card-body row g-3">
                        <div class="col-lg-8">
                          <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                            <div class="me-1">
                              <h4 class="mb-1">UI/UX Basic Fundamentals</h4>
                            </div>
                          </div>
                          <div class="card academy-content shadow-none border">
                            <div class="p-2">
                                <div class="ratio ratio-16x9">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/R4a829TG2qM?si=M3rt56lIMV4z1e1X" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                  </div>
                            </div>
                            <div class="card-body">
                                <h5 class="mb-2">About this course</h5>
                                <p class="mb-0 pt-1">Learn web design in 1 hour with 25+ simple-to-use rules and guidelines — tons
                                  of amazing web design resources included!</p>
                                <hr class="my-4">
                                <h5>Resources</h5>

                                <div class="list-group list-group-flush">
                                  <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class='bx bxs-file-pdf'></i> Bear claw cake biscuit <i class='bx bx-download' style="float:right; color:cornflowerblue"></i></a>
                                  <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class='bx bxs-file-pdf'></i> Soufflé pastry pie ice <i class='bx bx-download' style="float:right; color:cornflowerblue"></i></a>
                                </div>
                                            
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="accordion stick-top accordion-bordered course-content-fixed" id="courseContent">
                            <div class="accordion-item shadow-none border mb-0">
                              <div class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button bg-lighter rounded-0" data-bs-target="#chapterOne" aria-expanded="false" aria-controls="chapterOne">
                                  <span class="d-flex flex-column">
                                    <span class="h5 mb-1">Lessons</span>
                                    <span class="fw-normal">2 / 5 completed</span>
                                  </span>
                                </button>
                              </div>
                              <div id="chapterOne" class="accordion-collapse" data-bs-parent="#courseContent" style="">
                                <div class="accordion-body py-3 border-top">
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" checked="">
                                    <label for="defaultCheck1" class="form-check-label ms-3">
                                      <span class="mb-0 h6">1. Welcome to this course</span>
                                      <span class="text-muted d-block">2.4 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck2" checked="">
                                    <label for="defaultCheck2" class="form-check-label ms-3">
                                      <span class="mb-0 h6">2. Watch before you start</span>
                                      <span class="text-muted d-block">4.8 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck3">
                                    <label for="defaultCheck3" class="form-check-label ms-3">
                                      <span class="mb-0 h6">3. Basic design theory</span>
                                      <span class="text-muted d-block">5.9 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck4">
                                    <label for="defaultCheck4" class="form-check-label ms-3">
                                      <span class="mb-0 h6">4. Basic fundamentals</span>
                                      <span class="text-muted d-block">3.6 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck4">
                                    <label for="defaultCheck4" class="form-check-label ms-3">
                                      <span class="mb-0 h6">5. Basic fundamentals</span>
                                      <span class="text-muted d-block">3.6 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck4">
                                    <label for="defaultCheck4" class="form-check-label ms-3">
                                      <span class="mb-0 h6">6. Basic fundamentals</span>
                                      <span class="text-muted d-block">3.6 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center mb-3">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck4">
                                    <label for="defaultCheck4" class="form-check-label ms-3">
                                      <span class="mb-0 h6">7. Basic fundamentals</span>
                                      <span class="text-muted d-block">3.6 min</span>
                                    </label>
                                  </div>
                                  <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input" type="checkbox" id="defaultCheck5">
                                    <label for="defaultCheck5" class="form-check-label ms-3">
                                      <span class="mb-0 h6">8. What is ui/ux</span>
                                      <span class="text-muted d-block">10.6 min</span>
                                    </label>
                                  </div>
                                  
                                </div>
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

    
    @if(auth()->check() && auth()->user()->role === 'admin')
      <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Lesson</h5>
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
                        <label for="nameWithTitle" class="form-label">Lesson Title</label>
                        <input type="text" id="nameWithTitle" name="title" class="form-control" placeholder="Enter Course Title">
                    </div>
                </div>

                <div class="row">
                  <div class="col mb-3">
                      <label for="nameWithTitle" class="form-label">Lesson Link</label>
                      <input type="text" id="nameWithTitle" name="title" class="form-control" placeholder="Enter Lesson Youtube Link">
                  </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Lesson Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Cover Image</label>
                        <input class="form-control" type="file" id="formFileMultiple" >
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
    @endif  

    <div class="content-backdrop fade"></div>
    </div>
          
@endsection