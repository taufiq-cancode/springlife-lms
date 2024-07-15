@extends('theme.campus-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Coordinators </span></h4>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalTutor">Add Coordinator</button>
          </div>  
        @endif

      </div>
      
      <div class="row">
        <div class="col-lg-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
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
      <div class="modal fade" id="modalTutor" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Coordinator</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('coordinator.store') }}" enctype="multipart/form-data">
              @csrf
          
              <div class="modal-body">
                  <div class="row">
                      <div class="col-6 mb-3">
                          <label for="firstname" class="form-label">Firstname</label>
                          <input type="text" id="firstname" name="firstname" class="form-control" required placeholder="Enter firstname">
                      </div>
                      <div class="col-6 mb-3">
                          <label for="lastname" class="form-label">Lastname</label>
                          <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="Enter lastname">
                      </div>
                  </div>
          
                  <div class="row">
                      <div class="col mb-3">
                          <label for="email" class="form-label">Email Address</label>
                          <input type="text" id="email" name="email" class="form-control" required placeholder="Enter email address">
                      </div>
                  </div>

                  <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Gender</label>
                        <select id="defaultSelect" class="form-select" name="gender" required>
                          <option>Select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                    </div>
                  </div>
          
                  <div class="row">
                      <div class="col mb-3">
                          <label for="role" class="form-label">Role</label>
                          <select id="role" name="role" class="form-select">
                            <option value="">Select role</option>
                            <option value="chapter_coordinator">Chapter Coordinator</option>
                            <option value="zonal_coordinator">Zonal Coordinator</option>
                            <option value="regional_coordinator">Regional Coordinator</option>
                            <option value="national_coordinator">National Coordinator</option>
                          </select>
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

      <div class="modal fade" id="modalAdmin" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add an Admin</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
              @csrf

              <div class="modal-body">
                  <div class="row">
                    <div class="col-6 mb-3">
                        <label for="nameWithTitle" class="form-label">Firstname</label>
                        <input type="text" id="nameWithTitle" name="firstname" class="form-control" required placeholder="Enter firstname">
                    </div>
                    <div class="col-6 mb-3">
                      <label for="nameWithTitle" class="form-label">Lastname</label>
                      <input type="text" id="nameWithTitle" name="lastname" class="form-control" required placeholder="Enter lastname">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col mb-3">
                        <label for="nameWithTitle" class="form-label">Email Address</label>
                        <input type="text" id="nameWithTitle" name="email" class="form-control" required placeholder="Enter email address">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Gender</label>
                        <select id="defaultSelect" class="form-select" name="gender" required>
                          <option>Select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
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
    @endif  

    <div class="content-backdrop fade"></div>
    </div>
          
@endsection