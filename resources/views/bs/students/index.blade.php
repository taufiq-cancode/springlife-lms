@extends('theme.bible-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Students</span></h4>
      </div>
      
        <div class="row">
          <div class="col-lg-12">
            <div class="nav-align-top mb-4">
              <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Completed Lessons</th>
                      {{-- <th>Progress</th> --}}
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                      <tr>
                        @php
                            $completedLessons = $user->progress->where('is_completed', true)->count();
                            $progressPercentage = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
                        @endphp

                        <td>
                          <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($user->firstname) }}+{{ Illuminate\Support\Str::title($user->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                          <span class="fw-medium">{{ $user->firstname }} {{ $user->lastname }}</span>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $completedLessons }}/{{ $totalLessons }}</td>
                        <td>
                          <div class="d-flex justify-content-start gap-2">
                            <a href="mailto:{{ $user->email }}" target="_blank" class="btn btn-info"><i class="fa fa-envelope me-1"></i></a>
                            <a href="https://wa.me/{{ $user->phone }}" target="_blank" class="btn btn-success"><i class="fa fa-whatsapp me-1"></i></a>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
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