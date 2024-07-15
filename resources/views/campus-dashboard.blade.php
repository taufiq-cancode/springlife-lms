@extends('theme.campus-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        @if(auth()->check() && auth()->user()->role !== 'admin' && auth()->user()->role !== 'tutor' && auth()->user()->role !== 'user')
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                    <p class="mb-4">
                                        You have coordinator privileges. You can view and manage reports.
                                    </p>    
                                    <a href="{{ route('reports.index') }}" class="btn btn-sm btn-outline-primary">Manage Reports</a>
                                </div>
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
            </div>
        @elseif(auth()->check() && auth()->user()->role === 'admin')
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Welcome, {{ Illuminate\Support\Str::title(auth()->user()->firstname) }}!👋🏻</h5>
                                    <p class="mb-4">
                                        You have admin privileges. You can manage coordinators and reports.
                                    </p>    
                                    <a href="{{ route('coordinator.index') }}" class="btn btn-sm btn-outline-primary">Manage Coordinators</a>
                                </div>
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
            </div>
        @endif

        @if(auth()->check() && auth()->user()->role !== 'admin' && auth()->user()->role !== 'tutor' && auth()->user()->role !== 'user')
            <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Reports</span></h4>

                @if(auth()->check() && auth()->user()->role !== 'admin' &&  auth()->user()->role !== 'national_coordinator')
                    <a href="{{ route('reports.create') }}" class="btn btn-outline-primary mt-3 mb-4" >Add Report</a>
                @endif

            </div>
            
            <div class="row">
                <div class="col-lg-12">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">

                    @if(auth()->check() && auth()->user()->role !== 'national_coordinator' && auth()->user()->role !== 'admin')
                        <li class="nav-item" role="presentation">
                        <button type="button"class="nav-link {{ auth()->check() && auth()->user()->role !== 'admin' ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-all" aria-controls="navs-pills-top-all" aria-selected="false" tabindex="-1">My Reports</button>
                        </li>
                    @endif

                    @if(auth()->check() && auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'admin' )
                        <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link {{ auth()->check() && auth()->user()->role === 'admin' ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-student" aria-controls="navs-pills-top-student" aria-selected="true">Student Reports</button>
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
                        <button type="button" class="nav-link {{ auth()->check() && auth()->user()->role === 'national_coordinator' ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="true">Regional Reports</button>
                        </li>
                    @endif

                    </ul>
                    <div class="tab-content">
                    @if(auth()->check() && auth()->user()->role !== 'national_coordinator' && auth()->user()->role !== 'admin')
                        <div class="tab-pane fade {{ auth()->check() && auth()->user()->role !== 'admin' ? 'active show' : '' }}" id="navs-pills-top-all" role="tabpanel">
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
                                    @elseif(auth()->check() && auth()->user()->role === 'student_coordinator')
                                    Name of Chapter
                                    @endif
                                </th>
                                <th>Date of Report</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if($userReports !== null)
                                    @foreach ($userReports as $userReport)
                                        <tr>
                                        <td>
                                            @if(auth()->check() && auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'mission_coordinator')
                                            {{ $userReport->name_of_your_institution }}
                                            @elseif(auth()->check() && auth()->user()->role === 'zonal_coordinator')
                                            {{ $userReport->name_of_your_zone }}
                                            @elseif(auth()->check() && auth()->user()->role === 'regional_coordinator')
                                            {{ $userReport->name_of_your_region }}
                                            @elseif(auth()->check() && auth()->user()->role === 'student_coordinator')
                                            {{ $userReport->chapter_name }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($userReport->date_of_the_report)->format('jS F, Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start gap-3">
                                            <div>
                                                <a href="{{ route('report.view', ['id' => $userReport->id, 'role' => auth()->user()->role]) }}" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></a>
                                            </div>
                                            <div>
                                                <form method="POST" action="" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this report?')"  class="btn btn-outline-danger"> Delete <i class="bx bx-trash me-1"></i></button>
                                                </form> 
                                            </div>
                                            </div>
                                        </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            </table>
                        </div>
                        </div>
                    @endif
                    
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
                                            <a href="{{ route('report.view', ['id' => $chapterReport->id, 'role' => 'chapter_coordinator' ]) }}" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></a>
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

                    @if(auth()->check() && auth()->user()->role === 'chapter_coordinator' || auth()->user()->role === 'admin' )
                        <div class="tab-pane fade {{ auth()->check() && auth()->user()->role === 'admin' ? 'active show' : '' }}" id="navs-pills-top-student" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                            <thead>
                                <tr>
                                <th>Name of Chapter</th>
                                <th>Date of Report</th>
                                <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($studentReports as $studentReport)
                                <tr>
                                    <td>{{ $studentReport->chapter_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($studentReport->date_of_the_report)->format('jS F, Y') }}</td>
                                    <td>
                                    <div class="d-flex justify-content-start gap-3">
                                        <div>
                                            <a href="{{ route('report.view', ['id' => $studentReport->id, 'role' => 'student_coordinator' ]) }}" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></a>
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
                                            <a href="{{ route('report.view', ['id' => $zonalReport->id, 'role' => 'zonal_coordinator' ]) }}" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></a>
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
                        <div class="tab-pane fade  {{ auth()->check() && auth()->user()->role === 'national_coordinator' ? 'active show' : '' }}" id="navs-pills-top-regional" role="tabpanel">
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
                                            <a href="{{ route('report.view', ['id' => $regionalReport->id, 'role' => 'regional_coordinator' ]) }}" class="btn btn-outline-primary">View <i class="fa-regular fa-eye me-1"></i></a>
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
        @endif

        @if(auth()->check() && auth()->user()->role === 'admin')
            <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:20px">
                <h4 class="mb-4"><span class="text-muted fw-light">Coordinators </span></h4>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="nav-align-top mb-4">
                        
                        <ul class="nav nav-pills mb-3" role="tablist">
                            {{-- <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-all" aria-controls="navs-pills-top-all" aria-selected="true" tabindex="-1">All coordinators</button>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-student" aria-controls="navs-pills-top-student" aria-selected="false">Student Coordinators</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-chapter" aria-controls="navs-pills-top-chapter" aria-selected="false" tabindex="-1">Chapter Coordinators</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-zonal" aria-controls="navs-pills-top-zonal" aria-selected="false" tabindex="-1">Zonal Coordinators</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-regional" aria-controls="navs-pills-top-regional" aria-selected="false" tabindex="-1">Regional Coordinators</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-national" aria-controls="navs-pills-top-national" aria-selected="false" tabindex="-1">National Coordinators</button>
                            </li>
                        </ul>
        
                        <div class="tab-content">
                            {{-- <div class="tab-pane fade" id="navs-pills-top-all" role="tabpanel">
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($coordinators as $coordinator)
                                                <tr>
                                                    <td>
                                                        <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                        <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                    </td>
                                                    <td>{{ $coordinator->email }}</td>
                                                    <td>{{ Illuminate\Support\Str::title($coordinator->role) }}</td>
                                                    <td>
                                                        <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                            {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                        
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-6 mb-3">
                                                                                        <label for="firstname" class="form-label">Firstname</label>
                                                                                        <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                    </div>
                                                                                    <div class="col-6 mb-3">
                                                                                        <label for="lastname" class="form-label">Lastname</label>
                                                                                        <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                    </div>
                                                                                </div>
                                                                        
                                                                                <div class="row">
                                                                                    <div class="col mb-3">
                                                                                        <label for="email" class="form-label">Email Address</label>
                                                                                        <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                    
                                                            <div>
                                                                <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                    
                                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            
                            <div class="tab-pane fade active show" id="navs-pills-top-student" role="tabpanel">
                                @if ($studentCoordinators->isEmpty())
                                    <div class="alert alert-warning me-1" role="alert">
                                        No student coordinators created yet.
                                    </div>
                                @else
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($studentCoordinators as $coordinator)
                                                    <tr>
                                                        <td>
                                                            <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                            <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                        </td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ Illuminate\Support\Str::title(str_replace('_', ' ', $coordinator->role)) }}
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                                {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                    <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                            
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="firstname" class="form-label">Firstname</label>
                                                                                            <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                        </div>
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="lastname" class="form-label">Lastname</label>
                                                                                            <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                                    <div class="row">
                                                                                        <div class="col mb-3">
                                                                                            <label for="email" class="form-label">Email Address</label>
                                                                                            <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <div>
                                                                    <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                        
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="navs-pills-top-chapter" role="tabpanel">
                                @if ($chapterCoordinators->isEmpty())
                                    <div class="alert alert-warning me-1" role="alert">
                                        No chapter coordinators created yet.
                                    </div>
                                @else
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($chapterCoordinators as $coordinator)
                                                    <tr>
                                                        <td>
                                                            <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                            <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                        </td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ Illuminate\Support\Str::title(str_replace('_', ' ', $coordinator->role)) }}
                                                            <td>
                                                            <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                                {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                    <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                            
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="firstname" class="form-label">Firstname</label>
                                                                                            <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                        </div>
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="lastname" class="form-label">Lastname</label>
                                                                                            <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                                    <div class="row">
                                                                                        <div class="col mb-3">
                                                                                            <label for="email" class="form-label">Email Address</label>
                                                                                            <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <div>
                                                                    <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                        
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="navs-pills-top-zonal" role="tabpanel">
                                @if ($zonalCoordinators->isEmpty())
                                    <div class="alert alert-warning me-1" role="alert">
                                        No zonal coordinators created yet.
                                    </div>
                                @else
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($zonalCoordinators as $coordinator)
                                                    <tr>
                                                        <td>
                                                            <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                            <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                        </td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ Illuminate\Support\Str::title(str_replace('_', ' ', $coordinator->role)) }}
                                                            <td>
                                                            <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                                {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                    <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                            
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="firstname" class="form-label">Firstname</label>
                                                                                            <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                        </div>
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="lastname" class="form-label">Lastname</label>
                                                                                            <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                                    <div class="row">
                                                                                        <div class="col mb-3">
                                                                                            <label for="email" class="form-label">Email Address</label>
                                                                                            <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <div>
                                                                    <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                        
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="navs-pills-top-regional" role="tabpanel">
                                @if ($regionalCoordinators->isEmpty())
                                    <div class="alert alert-warning me-1" role="alert">
                                        No regional coordinators created yet.
                                    </div>
                                @else
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($regionalCoordinators as $coordinator)
                                                    <tr>
                                                        <td>
                                                            <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                            <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                        </td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ Illuminate\Support\Str::title(str_replace('_', ' ', $coordinator->role)) }}</td>
                                                        <td>
                                                            <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                                {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                    <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                            
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="firstname" class="form-label">Firstname</label>
                                                                                            <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                        </div>
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="lastname" class="form-label">Lastname</label>
                                                                                            <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                                    <div class="row">
                                                                                        <div class="col mb-3">
                                                                                            <label for="email" class="form-label">Email Address</label>
                                                                                            <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <div>
                                                                    <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                        
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="navs-pills-top-national" role="tabpanel">
                                @if ($nationalCoordinators->isEmpty())
                                    <div class="alert alert-warning me-1" role="alert">
                                        No national coordinators created yet.
                                    </div>
                                @else
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                @foreach ($nationalCoordinators as $coordinator)
                                                    <tr>
                                                        <td>
                                                            <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($coordinator->firstname) }}+{{ Illuminate\Support\Str::title($coordinator->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                                            <span class="fw-medium">{{ $coordinator->firstname }} {{ $coordinator->lastname }}</span>
                                                        </td>
                                                        <td>{{ $coordinator->email }}</td>
                                                        <td>{{ Illuminate\Support\Str::title(str_replace('_', ' ', $coordinator->role)) }}</td>
                                                        <td>
                                                            <span class="badge bg-label-{{ $coordinator->status == 1 ? 'primary' : 'danger' }} me-1">
                                                                {{ $coordinator->status == 1 ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $coordinator->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                                    <div class="modal fade" id="modalEditTutor_{{ $coordinator->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="modalCenterTitle">Update Coordinator</h5>
                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <form method="POST" action="{{ route('coordinator.update', ['coordinatorId' => $coordinator->id]) }}" enctype="multipart/form-data">
                                                                                @csrf
                                                                                @method('PUT')
                                                                            
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="firstname" class="form-label">Firstname</label>
                                                                                            <input type="text" id="firstname" name="firstname" value="{{ $coordinator->firstname }}" class="form-control" required placeholder="Enter coordinator's firstname">
                                                                                        </div>
                                                                                        <div class="col-6 mb-3">
                                                                                            <label for="lastname" class="form-label">Lastname</label>
                                                                                            <input type="text" id="lastname" name="lastname" value="{{ $coordinator->lastname }}" class="form-control" required placeholder="Enter coordinator's lastname">
                                                                                        </div>
                                                                                    </div>
                                                                            
                                                                                    <div class="row">
                                                                                        <div class="col mb-3">
                                                                                            <label for="email" class="form-label">Email Address</label>
                                                                                            <input type="text" id="email" name="email" value="{{ $coordinator->email }}" class="form-control" required placeholder="Enter coordinator's email address">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                        
                                                                <div>
                                                                    <form method="POST" action="{{ route('coordinator.delete', ['coordinatorId' => $coordinator->id]) }}" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                        
                                                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this coordinator?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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