@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Users </span></h4>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalTutor">Add Tutor</button>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalAdmin">Add Admin</button>
          </div>  
        @endif

      </div>
      
        <div class="row">
          <div class="col-lg-12">
            <div class="nav-align-top mb-4">
              
              <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false" tabindex="-1">Tutors</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="true">Admins</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="false" tabindex="-1">Students</button>
                </li>
              </ul>

              <div class="tab-content">
                <div class="tab-pane fade active show" id="navs-pills-top-profile" role="tabpanel">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Course Assigned</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                          @foreach ($tutors as $tutor)
                              <tr>
                                  <td>
                                      <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($tutor->firstname) }}+{{ Illuminate\Support\Str::title($tutor->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                                      <span class="fw-medium">{{ $tutor->firstname }} {{ $tutor->lastname }}</span>
                                  </td>
                                  <td>{{ $tutor->email }}</td>
                                  <td>
                                      @if($tutor->courses->isNotEmpty())
                                          @foreach($tutor->courses as $course)
                                              {{ $course->title }}@if(!$loop->last),<br>@endif
                                          @endforeach
                                      @else
                                          No courses assigned
                                      @endif
                                  </td>
                                  <td>
                                      <span class="badge bg-label-{{ $tutor->status == 1 ? 'primary' : 'danger' }} me-1">
                                          {{ $tutor->status == 1 ? 'Active' : 'Inactive' }}
                                      </span>
                                  </td>
                                  <td>
                                      <div class="d-flex justify-content-between">
                                          <div>
                                              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditTutor_{{ $tutor->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                              <div class="modal fade" id="modalEditTutor_{{ $tutor->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title" id="modalCenterTitle">Update Tutor</h5>
                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <form method="POST" action="{{ route('tutor.update', ['tutorId' => $tutor->id]) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                        
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6 mb-3">
                                                                        <label for="firstname" class="form-label">Firstname</label>
                                                                        <input type="text" id="firstname" name="firstname" value="{{ $tutor->firstname }}" class="form-control" required placeholder="Enter tutor's firstname">
                                                                    </div>
                                                                    <div class="col-6 mb-3">
                                                                        <label for="lastname" class="form-label">Lastname</label>
                                                                        <input type="text" id="lastname" name="lastname" value="{{ $tutor->lastname }}" class="form-control" required placeholder="Enter tutor's lastname">
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="email" class="form-label">Email Address</label>
                                                                        <input type="text" id="email" name="email" value="{{ $tutor->email }}" class="form-control" required placeholder="Enter tutor's email address">
                                                                    </div>
                                                                </div>
                                                        
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="course_id" class="form-label">Course</label>
                                                                        <select id="course_id" name="course_id" class="form-select">
                                                                            <option value="">No course assigned</option>
                                                                            @foreach($courses as $course)
                                                                                <option value="{{ $course->id }}">
                                                                                    {{ $course->title }} - 
                                                                                    {{ $course->tutors->first() ? $course->tutors->first()->firstname . ' ' . $course->tutors->first()->lastname : 'Not assigned' }}
                                                                                </option>
                                                                            @endforeach
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
                                          </div>
                  
                                          <div>
                                              <form method="POST" action="{{ route('tutor.delete', ['tutorId' => $tutor->id]) }}" class="d-inline">
                                                  @csrf
                                                  @method('DELETE')
                  
                                                  <button type="submit" onclick="return confirm('Are you sure you want to delete this tutor?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
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
                
                <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @foreach ($admins as $admin)
                          <tr>
                            <td>
                              <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($admin->firstname) }}+{{ Illuminate\Support\Str::title($admin->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                              <span class="fw-medium">{{ $admin->firstname }} {{ $admin->lastname }}</span>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                              <span class="badge bg-label-{{ $admin->status == 1 ? 'primary' : 'danger' }} me-1">
                                {{ $admin->status == 1 ? 'Active' : 'Inactive' }}
                              </span>
                            </td>
                            <td>
                              <div class="d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditAdmin_{{ $admin->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                    <div class="modal fade" id="modalEditAdmin_{{ $admin->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modalCenterTitle">Update Admin</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('admin.update', ['adminId' => $admin->id]) }}" enctype="multipart/form-data">
                                              @csrf
                                              @method('PUT')
                                
                                              <div class="modal-body">
                                                  <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="nameWithTitle" class="form-label">Firstname</label>
                                                        <input type="text" id="nameWithTitle" name="firstname" value="{{ $admin->firstname }}" class="form-control" required placeholder="Enter firstname">
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Lastname</label>
                                                      <input type="text" id="nameWithTitle" name="lastname" value="{{ $admin->lastname }}" class="form-control" required placeholder="Enter lastname">
                                                    </div>
                                                  </div>
                                
                                                  <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameWithTitle" class="form-label">Email Address</label>
                                                        <input type="text" id="nameWithTitle" name="email" value="{{ $admin->email }}" class="form-control" required placeholder="Enter admin's email address">
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
                                    <form method="POST" action="{{ route('admin.delete', ['adminId' => $admin->id]) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this admin?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
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
                
                <div class="tab-pane fade" id="navs-pills-top-home" role="tabpanel">
                  <div class="table-responsive text-nowrap">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Status</th>
                          {{-- <th>Actions</th> --}}
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                          <tr>
                            <td>
                              <img src="https://ui-avatars.com/api/?name={{ Illuminate\Support\Str::title($user->firstname) }}+{{ Illuminate\Support\Str::title($user->lastname) }}&background=a5a6ff&color=fff" alt class="w-px-30 h-auto rounded-circle" />
                              <span class="fw-medium">{{ $user->firstname }} {{ $user->lastname }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                              <span class="badge bg-label-{{ $user->status == 1 ? 'primary' : 'danger' }} me-1">
                                {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                              </span>
                            </td>
                            {{-- <td>
                              <div class="d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditUser_{{ $user->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                    <div class="modal fade" id="modalEditUser_{{ $user->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="modalCenterTitle">Update User</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('user.update', ['userId' => $user->id]) }}" enctype="multipart/form-data">
                                              @csrf
                                              @method('PUT')
                                
                                              <div class="modal-body">
                                                  <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="nameWithTitle" class="form-label">Firstname</label>
                                                        <input type="text" id="nameWithTitle" name="firstname" value="{{ $user->firstname }}" class="form-control" required placeholder="Enter user's firstname">
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Lastname</label>
                                                      <input type="text" id="nameWithTitle" name="lastname" value="{{ $user->lastname }}" class="form-control" required placeholder="Enter user's lastname">
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Email Address</label>
                                                      <input type="text" id="nameWithTitle" name="email" value="{{ $user->email }}" class="form-control" required placeholder="Enter user's email address">
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Phone Number</label>
                                                      <input type="text" id="nameWithTitle" name="phone" value="{{ $user->phone }}" class="form-control" required placeholder="Enter user's phone number">
                                                    </div>
                                                  </div>
                                
                                                  <div class="row">
                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Gender</label>
                                                      <select id="gender" required name="gender" class="select2 form-select">
                                                          <option value="">Select Gender</option>
                                                          <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                                          <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                                      </select>
                                                    </div>

                                                    <div class="col-6 mb-3">
                                                      <label for="nameWithTitle" class="form-label">Date of Birth</label>
                                                      <input type="date" id="dobBackdrop" name="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control">
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
                                    <form method="POST" action="{{ route('user.delete', ['userId' => $user->id]) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
                                    </form> 
                                </div>
                              </div>
                            </td> --}}
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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
      <div class="modal fade" id="modalTutor" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Tutor</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('tutor.store') }}" enctype="multipart/form-data">
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
                          <label for="course_id" class="form-label">Course</label>
                          <select id="course_id" name="course_id" class="form-select">
                              <option value="">Select course</option>
                              @foreach($courses as $course)
                                  <option value="{{ $course->id }}">
                                      {{ $course->title }} - 
                                      {{ $course->tutors->first() ? $course->tutors->first()->firstname . ' ' . $course->tutors->first()->lastname : 'Not assigned' }}
                                  </option>
                              @endforeach
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