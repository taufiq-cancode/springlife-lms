@extends('theme.theme-master')
@section('content')

<style>
    .form-check-input {
        min-width: 1.2em;
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
                        <div class="col-lg-8">
                          <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                            <div class="me-1">
                              <h4 class="mb-1">Lesson Title</h4>
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
                                <p class="mb-0 pt-1">{{ $course->description }}</p>
                                <hr class="my-4">

                                <h5>Resources</h5>

                                <div class="list-group list-group-flush">
                                    @forelse ($resources as $resource)
                                        <a href="{{ route('resources.download', ['resourceId' => $resource->id]) }}" class="list-group-item list-group-item-action">
                                            <i class='bx bxs-file-pdf'></i> {{ $resource->title }}
                                            <i class='bx bx-download' style="float:right; color:cornflowerblue"></i>
                                        </a>
                                    @empty
                                        <p>No resources available for this course.</p>
                                    @endforelse
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
                                  
                                    @foreach ($lessons as $lesson)

                                        <div class="form-check d-flex align-items-center mb-3">
                                            <input class="form-check-input" type="checkbox" id="lesson_{{ $lesson->id }}" checked="">
                                            
                                            <label for="lesson_{{ $lesson->id }}" class="form-check-label ms-3">
                                                <span class="mb-0 h6">{{ $loop->iteration }}. {{ $lesson->title }}</span>
                                                <span class="text-muted d-block"> min</span>
                                            </label>
                                        </div>

                                    @endforeach

                                                         
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
                                <input class="form-control" type="file" id="formFileMultiple" name="files[]" multiple="" accept=".pdf">
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