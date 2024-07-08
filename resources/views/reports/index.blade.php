@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Reports</span></h4>

            {{-- @if(auth()->check() && auth()->user()->role === 'admin') --}}
                <a href="{{ route('reports.create') }}" class="btn btn-outline-primary mt-3 mb-4" >Add Report</a>
            {{-- @endif --}}

        </div>
        
        <div class="row">
            <div class="col-lg-12">
              <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">

                  @if(auth()->check() && auth()->user()->role !== 'national_coordinator')
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-all" aria-controls="navs-pills-top-all" aria-selected="false" tabindex="-1">My Reports</button>
                    </li>
                  @endif

                  @if(auth()->check() && auth()->user()->role === 'zonal_coordinator' || auth()->user()->role === 'admin' )
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-chapter" aria-controls="navs-pills-top-chapter" aria-selected="true">Chapter Reports</button>
                    </li>
                  @endif

                  @if(auth()->check() && auth()->user()->role === 'regional_coordinator' || auth()->user()->role === 'admin' )
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-zonal" aria-controls="navs-pills-top-zonal" aria-selected="true">Zonal Reports</button>
                    </li>
                  @endif

                  @if(auth()->check() && auth()->user()->role === 'national_coordinator' || auth()->user()->role === 'admin' )
                    <li class="nav-item" role="presentation">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="true">Regional Reports</button>
                    </li>
                  @endif

                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade active show" id="navs-pills-top-all" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>
                              @if(auth()->check() && auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'mission_coordinator')
                                Name of Institution
                              @elseif(auth()->check() && auth()->user()->role === 'zonal_coordinator')
                                Name of Zone
                              @elseif(auth()->check() && auth()->user()->role === 'regional_coordinator')
                                Name of Region
                              @endif
                            </th>
                            <th>Date of Report</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                          @foreach ($userReports as $userReport)
                            <tr>
                              <td>
                                @if(auth()->check() && auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'mission_coordinator')
                                  {{ $userReport->name_of_your_institution }}
                                @elseif(auth()->check() && auth()->user()->role === 'zonal_coordinator')
                                  {{ $userReport->name_of_your_zone }}
                                @elseif(auth()->check() && auth()->user()->role === 'regional_coordinator')
                                  {{ $userReport->name_of_your_region }}
                                @endif
                              </td>
                              <td>{{ $userReport->date_of_the_report }}</td>
                              <td>
                                <div class="d-flex justify-content-start gap-3">
                                  <div>
                                      <button type="button" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></button>
                                  </div>
                                  <div>
                                      <form method="POST" action="" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" onclick="return confirm('Are you sure you want to delete this tutor?')"  class="btn btn-outline-danger"> Delete <i class="bx bx-trash me-1"></i></button>
                                      </form> 
                                  </div>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  @if(auth()->check() && auth()->user()->role === 'zonal_coordinator' || auth()->user()->role === 'admin' )
                    <div class="tab-pane fade" id="navs-pills-top-chapter" role="tabpanel">
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name of Institution</th>
                              <th>Date of Report</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach ($chapterReports as $chapterReport)
                              <tr>
                                <td>{{ $chapterReport->name_of_your_institution }}</td>
                                <td>{{ \Carbon\Carbon::parse($chapterReport->date_of_the_report)->format('jS F, Y') }}</td>
                                <td>
                                  <div class="d-flex justify-content-start gap-3">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></button>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif

                  @if(auth()->check() && auth()->user()->role === 'regional_coordinator' || auth()->user()->role === 'admin' )
                    <div class="tab-pane fade" id="navs-pills-top-zonal" role="tabpanel">
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name of Zone</th>
                              <th>Date of Report</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach ($zonalReports as $zonalReport)
                              <tr>
                                <td>{{ $zonalReport->name_of_your_zone }}</td>
                                <td>{{ $zonalReport->date_of_the_report }}</td>
                                <td>
                                  <div class="d-flex justify-content-start gap-3">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></button>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif

                  @if(auth()->check() && auth()->user()->role === 'national_coordinator' || auth()->user()->role === 'admin' )
                    <div class="tab-pane fade" id="navs-pills-top-regional" role="tabpanel">
                      <div class="table-responsive text-nowrap">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Name of Region</th>
                              <th>Date of Report</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @foreach ($regionalReports as $regionalReport)
                              <tr>
                                <td>{{ $regionalReport->name_of_your_region }}</td>
                                <td>{{ $regionalReport->date_of_the_report }}</td>
                                <td>
                                  <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary"><i class="bx bx-view-alt me-1"></i></button>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endif

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
          
@endsection