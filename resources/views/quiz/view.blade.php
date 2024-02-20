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
                  <button type="button" id="understoodButton" class="btn btn-outline-secondary" data-bs-dismiss="modal">Understood</button>
                </div>
              </div>
        </div>
    </div>

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Quizes / </span>{{ $course->title }}</h4>

            <h5 class="py-3 mb-4">
                <span id="timer" class="text-muted fw-light">30:00</span> left
            </h5>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    @foreach($questions as $key => $question)
                
                        <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                            <div class="card-title mb-0 me-1">
                                <h5 class="mb-1">Question {{ $key + 1 }}: {{ $question->question_text }}</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row gy-4 mb-4">

                                @foreach(['option1', 'option2', 'option3', 'option4'] as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="q{{ $key + 1 }}" id="q{{ $key + 1 }}_{{ $option }}" value="{{ $option }}">
                                        <label class="form-check-label" for="q{{ $key + 1 }}_{{ $option }}">{{ $question->$option }}</label>
                                    </div>
                                @endforeach   
                    
                            </div>
                        </div>

                    @endforeach

                    <div class="card-footer d-flex flex- gap-3" style="padding-top:0">
                        <button type="button" id="submitQuiz" onclick="submitQuiz()" class="btn btn-primary mt-3">Submit Quiz</button>
                       
                        <button type="button" id="skipQuestion" class="btn btn-secondary mt-3">Skip Question</button>
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

<script>
    const submitQuiz = () => {
        console.log('Submit quiz button clicked');
    }
</script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Add debugging statement to check if the script is loaded
        console.log('Script loaded');

        document.getElementById('submitQuiz').addEventListener('click', function() {
            // Add debugging statement to check if the event listener is triggered
            console.log('Submit quiz button clicked');

            let score = 0;
            @foreach($questions as $key => $question)
                const selectedOption = document.querySelector('input[name="q{{$key + 1}}"]:checked');
                if (selectedOption) {
                    const selectedValue = selectedOption.value;
                    const correctOption = '{{$question->correct_option}}';
                    console.log('Selected option:', selectedValue);
                    console.log('Correct option:', correctOption);
                    if (selectedValue === correctOption) {
                        score++;
                    }
                }
            @endforeach
            // Display the score using an alert
            alert('Your score is: ' + score);
        });
    });
</script> --}}



          
@endsection