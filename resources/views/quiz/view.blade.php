@extends('theme.theme-master')
@section('content')

<style>
    .form-check {
        padding-left: 3.7em;
    }
    .card-body {
        padding: 0rem 1.5rem;
    }
    
</style>

    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom pb-3">
                  <h5 class="modal-title" id="modalCenterTitle">Quiz Instructions</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  <br>
                </div>

                <div class="modal-body" style="padding-bottom: 0px">
                    <p>This is a simple quiz system. Get ready to answer some questions!</p>
                    <ul>
                        <li>Read each question carefully.</li>
                        <li>Select the correct answer from the options provided.</li>
                        <li>You can only choose one answer per question.</li>
                        <li>Click the "Submit" button to submit your answers.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Understood</button>
                </div>
              </div>
        </div>
    </div>

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Quizes / Courses</span> Course Title
          </h4>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                
                <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                        <h5 class="mb-1">Question 1: What is the capital of France?</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row gy-4 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1_option1" value="option1">
                            <label class="form-check-label" for="q1_option1">Paris</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1_option2" value="option2">
                            <label class="form-check-label" for="q1_option2">Berlin</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1_option3" value="option3">
                            <label class="form-check-label" for="q1_option3">London</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="q1" id="q1_option3" value="option3">
                            <label class="form-check-label" for="q1_option3">London</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex flex- gap-3" style="padding-top:0">
                    <button type="button" class="btn btn-primary mt-3">Submit</button>
                    <button type="button" class="btn btn-secondary mt-3">Skip Question</button>
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){
        $('#backDropModal').modal('show');
    });
</script>
          
@endsection