@extends('theme.bible-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y"> 
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                    <p class="mb-4">
                                        You have administrative privileges. You can manage lessons and users.
                                    </p>    
                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">Manage Lessons</a>
                                </div>
                            @elseif(auth()->check() && auth()->user()->role !== 'admin')
                                @if(session('first_time_registered'))
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                        <p class="mb-4">
                                            We are glad you made it here. Get started by exploring our amazing study courses!
                                        </p>
                                        <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">View Lessons</a>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">Welcome Back, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                        <p class="mb-4">
                                            We love to have you back. Keep it up and get your certificates!
                                        </p>
                                        <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary">Continue Lessons</a>
                                    </div>
                                @endif

                            @endif
                        </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">

                            @if(auth()->check())
                                @if(auth()->user()->gender === 'male')
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" />
                                @else
                                    <img src="../assets/img/illustrations/woman-with-laptop.png" height="140" />
                                @endif
                            @endif

                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">

                    @if(auth()->check() && auth()->user()->role === 'admin')

                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/playlist.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Lessons</span>
                                <h5 class="card-title mb-2">{{ $totalLessons }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/video-lesson.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Students</span>
                                <h5 class="card-title text-nowrap mb-1">{{ $totalLessons }}</h5>
                                </div>
                            </div>
                        </div>

                    @else

                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/webinar.png" alt="chart success" class="rounded"/>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Completed Lessons</span>
                                <h5 class="card-title mb-2">{{ $completedLessonsCount }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/video-lesson.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Lessons</span>
                                <h5 class="card-title text-nowrap mb-1">{{ $totalLessons }}</h5>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                   
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="d-flex mb-2 gap-2">
                                <h5>Lessons</h5>  @if(auth()->check() && auth()->user()->role === 'user') | <span> {{ $completedLessonsCount }}/{{ $totalLessonsCount }} Completed</span> @endif
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
                                                    <strong>{{ $loop->iteration }}. {{ $lesson->title }}</strong>
                                                        @if (in_array($lesson->id, $completedLessons))
                                                            <span style="color: green;">&nbsp;&#x25CF&nbsp;Completed</span>
                                                        @endif
                                                </button>
                                            </h2>
                                    
                                            <div id="accordionStyle1-{{ $lesson->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionStyle1" style="">
                                                <div class="accordion-body">
                                                    @if ($lesson->video_id)
                                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $lesson->video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                    @else
                                                        <div class="alert alert-warning" role="alert">
                                                            No video available for this lesson
                                                        </div>
                                                    @endif
                                                                                                    
                                                    <div class="list-group list-group-flush">
                                                        <div class="d-flex gap-2">
                                                            @if ($lesson->bsPdfs->isNotEmpty())
                                                                @foreach ($lesson->bsPdfs as $pdf)
                                                                        <a href="{{ asset('storage/' . $pdf->file_path) }}" target="_blank" class="list-group-item list-group-item-action py-3 resource" style="color: black">
                                                                            <i class='bx bxs-file-pdf' style='color:darkblue'></i> Lesson Resource PDF
                                                                            <i class='bx bx-download' style="float:right; color:darkblue"></i>
                                                                        </a>
                                                                @endforeach
                                                            @else
                                                                <p>No PDFs available for this lesson.</p>
                                                            @endif
    
                                                            <a href="{{ route('bs.quiz.view', ['bsLessonId' => $lesson->id]) }}" class="btn btn-primary py-3" style="width:100%">Attempt Quiz</a>
                                                        </div>
    
                                                    </div> 
                                                    
                                                    @if(auth()->check() && (auth()->user()->role === 'admin'))
                                                        <div class="d-flex gap-2 my-2">
                                                            <div>
                                                                <a href="{{ route('bs.quiz.view', ['bsLessonId' => $lesson->id]) }}" class="btn btn-outline-primary">Upload Quiz</a>
                                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditLesson_{{ $lesson->id }}">Edit Lesson</button>
                                                                <div class="modal fade" id="modalEditLesson_{{ $lesson->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="modalCenterTitle">Edit Lesson</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            
                                                                            <div class="modal-body">
                                                        
                                                                                <form method="POST" action="{{ route('bs.lessons.update', ['bsLessonId' => $lesson]) }}" enctype="multipart/form-data">
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
                                                                
                                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this lesson?')" style="width: 100%;" class="btn btn-outline-danger">Delete Lesson</button>
                                                                </form> 
                                                            </div>
                                                        </div>                                                    
                                                    @endif
                                                </div>
                                            </div>
    
                                        </div>
                                    @endforeach
                                @endif
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