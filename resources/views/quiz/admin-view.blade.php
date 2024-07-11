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


    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Quizes / </span>{{ $course->title }}</h4>

            <div>
                <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#largeModal">Add Question</button>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                @if($questions->isEmpty())
                    <div class="alert alert-warning me-1" style="margin-bottom: -15px;" role="alert">
                        No questions uploaded yet.
                    </div>
                @else
                    @foreach($questions as $question)
                        <div id="accordionIcon" class="accordion mt-3 accordion-with-arrow">
                            <div class="accordion-item card">
                                <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIcon-{{ $question->id }}">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-{{ $question->id }}" aria-controls="accordionIcon-{{ $question->id }}">
                                        Question {{ $loop->iteration }}: {{ $question->question_text }}
                                    </button>
                                </h2>
                        
                                <div id="accordionIcon-{{ $question->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                                    <div class="card-body">
                                        <div class="row gy-4 mb-4">

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="option1" id="q1" value="option1">
                                                    <label class="form-check-label" for="q1">{{ $question->option1 }}</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="option1" id="q1" value="option1">
                                                    <label class="form-check-label" for="q1">{{ $question->option2 }}</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="option1" id="q1" value="option1">
                                                    <label class="form-check-label" for="q1">{{ $question->option3 }}</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="option1" id="q1" value="option1">
                                                    <label class="form-check-label" for="q1">{{ $question->option4 }}</label>
                                                </div>

                                            <hr style="margin-bottom:-10px">

                                            <label style="margin-bottom:-10px"><b>Correct Option</b></label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" checked name="correct_option" id="q{{ $question->id }}_correct_option" value="correct_option">
                                                <label class="form-check-label" for="q{{ $question->id }}_correct_option">{{ $question->{$question->correct_option} }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex flex- gap-3" style="margin-top:-45px">

                                        <button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalEditQuestion_{{ $question->id }}">Edit Question</button>
                                        <div class="modal fade" id="modalEditQuestion_{{ $question->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel3">Edit Question</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="POST" action="{{ route('quiz.question.update', ['questionId' => $question->id]) }}" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="nameLarge" class="form-label">Question text</label>
                                                                    <input type="text" id="nameLarge" class="form-control" name="question_text" value="{{ $question->question_text }}">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="row g-2 mb-3">
                                                                <div class="col mb-0">
                                                                    <label for="emailLarge" class="form-label">Option 1</label>
                                                                    <input type="text" class="form-control" name="option1" value="{{ $question->option1 }}">
                                                                </div>
                                                                <div class="col mb-0">
                                                                    <label for="dobLarge" class="form-label">Option 2</label>
                                                                    <input type="text" class="form-control" name="option2" value="{{ $question->option2 }}">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="row g-2 mb-3">
                                                                <div class="col mb-0">
                                                                    <label for="emailLarge" class="form-label">Option 3</label>
                                                                    <input type="text" class="form-control" name="option3" value="{{ $question->option3 }}">
                                                                </div>
                                                                <div class="col mb-0">
                                                                    <label for="dobLarge" class="form-label">Option 4</label>
                                                                    <input type="text" class="form-control" name="option4" value="{{ $question->option4 }}">
                                                                </div>
                                                            </div>
                                        
                                                            <div class="row g-2 mb-3">
                                                                <div class="col-6 mb-0">
                                                                    <label for="emailLarge" class="form-label">Correct Option</label>
                                                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="correct_option">
                                                                        <option value="option1" {{ $question->correct_option == 'option1' ? 'selected' : '' }}>Option 1</option>
                                                                        <option value="option2" {{ $question->correct_option == 'option2' ? 'selected' : '' }}>Option 2</option>
                                                                        <option value="option3" {{ $question->correct_option == 'option3' ? 'selected' : '' }}>Option 3</option>
                                                                        <option value="option4" {{ $question->correct_option == 'option4' ? 'selected' : '' }}>Option 4</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                        
                                                            <button type="submit" class="btn btn-primary">Update Question</button>
                                                        </form>
                                    
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <form method="POST" action="{{ route('quiz.question.delete', ['questionId' => $question->id]) }}" style="margin-top:16px">
                                            @csrf
                                            @method('DELETE')
                                        
                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this question?')" style="width: 100%;" class="btn btn-outline-danger">Delete Question</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="modal fade" id="largeModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add a Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('quiz.question.store', ['courseId' => $course->id]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameLarge" class="form-label">Question text</label>
                                <input type="text" id="nameLarge" class="form-control" name="question_text">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col mb-0">
                                <label for="emailLarge" class="form-label">Option 1</label>
                                <input type="text" class="form-control" name="option1">
                            </div>
                            <div class="col mb-0">
                                <label for="dobLarge" class="form-label">Option 2</label>
                                <input type="text" class="form-control" name="option2">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col mb-0">
                                <label for="emailLarge" class="form-label">Option 3</label>
                                <input type="text" class="form-control" name="option3">
                            </div>
                            <div class="col mb-0">
                                <label for="dobLarge" class="form-label">Option 4</label>
                                <input type="text" class="form-control" name="option4">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6 mb-0">
                                <label for="emailLarge" class="form-label">Correct Option</label>
                                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="correct_option">
                                    <option value="option1">Option 1</option>
                                    <option value="option2">Option 2</option>
                                    <option value="option3">Option 3</option>
                                    <option value="option4">Option 4</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Question</button>
                    </form>

                    <div class="divider mt-4">
                        <div class="divider-text" style="font-size:15px">Upload multiple questions</div>
                      </div>


                      <div class="d-grid gap-2 col-lg-6 mx-auto">
                        <form method="POST" action="{{ route('quiz.question.upload', ['courseId' => $course->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <input class="form-control" type="file" id="csv_file" name="csv_file" required>
                            <button type="submit" class="btn btn-primary mt-2" style="width: 100%" type="button">Upload CSV</button>
                        </form>
                        <a href="{{ route('quiz.question.template') }}" class="btn btn-secondary mt-2" style="width: 100%">Download CSV Template</a>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
  


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
    document.getElementById('understoodButton').addEventListener('click', function () {
        // Start countdown timer when the user clicks on "Understood"
        var timer = 30 * 60; // 30 minutes in seconds
        var countdown = setInterval(function () {
            var minutes = Math.floor(timer / 60);
            var seconds = timer % 60;
            document.getElementById('timer').innerText = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            timer--;
            if (timer < 0) {
                clearInterval(countdown);
                // Submit quiz automatically when time runs out
                submitQuiz();
            }
        }, 1000);

        // You may also want to load the first question when the timer starts
        // Load the first question when the page loads
        loadQuestion(currentQuestionIndex);
    });

    function loadQuestion(question) {
        // Function to load question and options dynamically
        // You need to replace this with your implementation to load questions from the server
        // Example:
        // Fetch question from server using AJAX and populate the #quiz-container
        // You can use jQuery or Fetch API for AJAX requests
        // Example: $.get('/questions/' + questionId, function(data) { $('#quiz-container').html(data); });
    }

    function submitAnswer(answer) {
        // Function to submit answer to the server
        // You can use AJAX to send the answer to the server
        // Example: $.post('/submit-answer', { answer: answer }, function(data) { });
        // You may also want to handle the response from the server
    }

    function submitQuiz() {
        // Function to submit the entire quiz to the server
        // You can use AJAX to send all answers to the server
        // Example: $.post('/submit-quiz', { answers: answers }, function(data) { });
        // You may also want to handle the response from the server
    }

    // Load the first question when the page loads
    loadQuestion(currentQuestionIndex);
</script>
          
@endsection