@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Resources</span>  </h4>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gy-4 mb-4">
                            @if ($courses->isEmpty())
                                <div class="alert alert-warning me-1" style="margin-bottom: -15px;" role="alert">
                                    @if(auth()->check() && auth()->user()->role === 'tutor')
                                        No courses assigned yet, check back later.
                                    @else
                                        No courses uploaded yet, check back later.
                                    @endif
                                </div>
                            @else
                                @foreach ($courses as $course)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card h-100">
                                            <img class="img-fluid" src="{{ asset('storage/' . ($course->cover_image ?? 'assets/img/online-learning.png')) }}" alt="{{ $course->title }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $course->title }}</h5>
                                                <a href="{{ route('resources.view', ['courseId' => $course->id]) }}" target="_blank" class="btn btn-outline-primary">View Resource <i class='bx bx-download'></i></a>
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