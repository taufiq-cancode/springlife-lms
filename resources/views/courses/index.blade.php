@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Courses</span></h4>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalCenter">Add Course</button>
            @endif

        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gy-4 mb-4">

                            @foreach ($courses as $course)
                            
                                <div class="col-sm-6 col-lg-4">
                                    <div class="card p-2 h-100 shadow-none border">

                                        <div class="rounded-2 text-center mb-3">
                                            <a href="{{ route('courses.view', ['courseId' => $course->id]) }}"><img class="img-fluid" src="storage/{{ $course->cover_image ?? '../assets/img/online-learning.png' }}" alt="{{ $course->title }}"></a>
                                        </div>
                                        
                                        <div class="card-body p-3 pt-2">

                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <span class="badge bg-label-primary"><i class='bx bx-time'></i> 20 Hours</span>
                                                <span class="badge bg-label-secondary"><i class='bx bxs-videos'></i> 20 Lessons</span>
                                            </div>
                                            
                                            <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" class="h5">{{ $course->title }}</a>
                                            <p class="mt-2">{{ $course->description }}</p>
                                            
                                            @if(auth()->check() && auth()->user()->role === 'user')
                                                <p class="d-flex align-items-center"><i class="bx bx-time-five me-2"></i>30% Completed</p>
                                                <div class="progress mb-4" style="height: 8px">
                                                    <div class="progress-bar w-75" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">Continue Lessons <i class='bx bx-chevron-right'></i></a>
                                            @endif

                                            @if(auth()->check() && auth()->user()->role === 'admin')
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('courses.view', ['courseId' => $course->id]) }}" style="width: 100%;" class="btn btn-outline-primary">View</a>
                                                    
                                                    <form method="POST" action="{{ route('courses.delete', ['courseId' => $course->id]) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                    
                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this course?')" style="width: 100%;" class="btn btn-outline-danger">Delete</button>
                                                    </form> 
                                                       
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            
                            @endforeach

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
                <h5 class="modal-title" id="modalCenterTitle">Add a Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Course Title</label>
                            <input type="text" id="nameWithTitle" name="title" class="form-control" required placeholder="Enter Course Title">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Course Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" required rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">Course Resource Files</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="files[]" required multiple="" accept=".pdf">
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
                        <button type="submit" class="btn btn-primary">Upload course</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    @endif

    

    <div class="content-backdrop fade"></div>
    </div>
          
@endsection