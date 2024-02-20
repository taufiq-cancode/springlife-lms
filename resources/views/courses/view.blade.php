@extends('theme.theme-master')
@section('content')

<style>
    .form-check-input {
        min-width: 1.2em;
    }
    .card.accordion-item {
        border: 1px solid;
    }
</style>


    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Courses /</span> {{ $course->title }} </h4>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <div>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalEdit">Edit Course</button>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalCenter">Add Lesson</button>
        </div>
        @endif

      </div>
      
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                   
                    <div class="card-body row g-3">

                        <div class="col-lg-6">
                            <div class="d-flex mb-2 gap-2">
                                <h5>Lessons</h5>  @if(auth()->check() && auth()->user()->role === 'user') | <span>{{ $completedLessons }} / {{ $lessonCount }} completed</span> @endif
                            </div>

                            <div class="accordion mt-3 accordion-header-primary" id="accordionStyle1">
                                @if($lessons->isEmpty())

                                    <div class="alert alert-warning" role="alert">
                                        No lessons available.
                                    </div>

                                @else
                            
                                    @foreach ($lessons as $lesson)
                                        <div class="accordion-item card">
                                            <h2 class="accordion-header">
                                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionStyle1-{{ $lesson->id }}" aria-expanded="false">
                                                    {{ $loop->iteration }}. {{ $lesson->title }}
                                                </button>
                                            </h2>
                                    
                                            <div id="accordionStyle1-{{ $lesson->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1" style="">
                                                <div class="accordion-body">
                                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $lesson->video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                    <hr>
                                                    <div class="d-flex mb-2 justify-content-between gap-2">
                                                        
                                                        {{ $lesson->duration }} minutes
                                                    
                                                        @if(auth()->check() && auth()->user()->role === 'admin')
                                                            <div class="d-flex gap-2">
                                                                
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditLesson_{{ $lesson->id }}">Edit</button>
                                                                    <div class="modal fade" id="modalEditLesson_{{ $lesson->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Edit Lesson</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                
                                                                                <div class="modal-body">
                                                            
                                                                                    <form method="POST" action="{{ route('lessons.update', ['lessonId' => $lesson]) }}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                    
                                                                                        <div class="row">
                                                                                            <div class="col mb-3">
                                                                                                <label for="nameWithTitle" class="form-label">Lesson Title</label>
                                                                                                <input type="text" id="lessonTitle" name="title" value="{{ $lesson->title }}" class="form-control" placeholder="Enter Lesson Title">
                                                                                            </div>
                                                                                        </div>
                                                            
                                                                                        <div class="row">
                                                                                            <div class="col mb-3">
                                                                                                <label for="nameWithTitle" class="form-label">Lesson link</label>
                                                                                                <input type="text" id="lessonLink" name="link" value="{{ $lesson->link }}" class="form-control" placeholder="Enter Lesson Link">
                                                                                            </div>
                                                                                        </div>
                                                            
                                                                                        <div class="row">
                                                                                            <div class="col mb-3">
                                                                                                <label for="nameWithTitle" class="form-label">Lesson Duration</label>
                                                                                                <input type="text" id="lessonDuration" name="duration" value="{{ $lesson->duration }}" class="form-control" placeholder="Enter Lesson Duration">
                                                                                            </div>
                                                                                        </div>
                                                                    
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-primary">Update lesson</button>
                                                                                        </div>
                                                                                    </form>
                                                            
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <form method="POST" action="{{ route('lessons.delete', ['lessonId' => $lesson->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                    
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this lesson?')" style="width: 100%;" class="btn btn-outline-danger">Delete</button>
                                                                    </form> 
                                                                </div>

                                                            </div>
                                                        @else
                                                        <div>
                                                            <form id="completionForm_{{ $lesson->id }}" method="POST" action="{{ route('lessons.complete', ['lessonId' => $lesson->id]) }}">
                                                                @csrf
                                                                <input type="hidden" name="completed" value="{{ $lesson->users->contains(auth()->user()) && $lesson->users->find(auth()->user()->id)->pivot->completed ? '1' : '0' }}">
                                                                <input class="form-check-input" type="checkbox" id="lesson_{{ $lesson->id }}" {{ $lesson->users->contains(auth()->user()) && $lesson->users->find(auth()->user()->id)->pivot->completed ? 'checked' : '' }}>
                                                                <label for="lesson_{{ $lesson->id }}" class="form-check-label">Completed</label>
                                                            </form>
                                    
                                                            <script>
                                                                document.addEventListener('DOMContentLoaded', function() {
                                                                    const completionForm = document.getElementById('completionForm_{{ $lesson->id }}');
                                                                    const checkbox = document.getElementById('lesson_{{ $lesson->id }}');
                                    
                                                                    checkbox.addEventListener('change', function() {
                                                                        completionForm.submit();
                                                                    });
                                                                });
                                                            </script>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                @endif
                          
                               
                            </div>
                        </div>

                        <div class="col-lg-6">

                          <div class="card academy-content shadow-none border">
                            <div class="card-body">

                                <h5 class="mb-2">About this course</h5>
                                <p class="mb-0 pt-1">{{ $course->description }}</p>
                                <hr class="my-4">

                                <h5>Course Resource</h5>

                                <div class="list-group list-group-flush">
                                    <a href="{{ route('courses.download', ['courseId' => $course->id]) }}" class="list-group-item list-group-item-action">
                                        <i class='bx bxs-file-pdf'></i> {{ $course->title }}
                                        <i class='bx bx-download' style="float:right; color:cornflowerblue"></i>
                                    </a>
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
                        <form method="POST" action="{{ route('lessons.store', ['courseId' => $course->id]) }}">
                            @csrf
        
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="title" class="form-label">Lesson Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Lesson Title" required>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="lesson_link" class="form-label">Lesson Link</label>
                                    <input type="text" name="link" class="form-control" placeholder="Enter Lesson Youtube Link" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="lesson_link" class="form-label">Lesson Duration</label>
                                    <input type="number" name="duration" class="form-control" placeholder="Enter Lesson Duration" required>
                                </div>
                            </div>

                            <input type="hidden" name="course_id" value="{{ $course->id }}">
        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload lesson</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEdit" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">

                    <form method="POST" action="{{ route('courses.update', ['courseId' => $course]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Course Title</label>
                                <input type="text" id="nameWithTitle" name="title" value="{{ $course->title }}" class="form-control" placeholder="Enter Course Title">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Course Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">{{ $course->description }}</textarea>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Course Resource Files</label>
                                <input class="form-control" type="file" id="formFileMultiple" name="file" multiple="" accept=".pdf">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Cover Image</label>
                                <input class="form-control" type="file" name="cover_image" id="formFileMultiple" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update course</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    @endif  

    <div class="content-backdrop fade"></div>
    </div>

    
          
@endsection