@extends('theme.campus-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      
      <div class="d-flex flex-wrap justify-content-between gap-3" style="padding-top:0">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Chapters & Zones </span></h4>

        @if(auth()->check() && auth()->user()->role === 'admin')
          <div>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalChapter">Add Chapter</button>
            <button type="button" class="btn btn-outline-primary mt-3 mb-4" data-bs-toggle="modal" data-bs-target="#modalZone">Add Zone</button>
          </div>  
        @endif

      </div>
      
      <div class="row">
        <div class="col-lg-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-chapter" aria-controls="navs-pills-top-student" aria-selected="false">Chapters</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-zone" aria-controls="navs-pills-top-chapter" aria-selected="false" tabindex="-1">Zones</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="navs-pills-top-chapter" role="tabpanel">
                        @if ($chapters->isEmpty())
                            <div class="alert alert-warning me-1" role="alert">
                                No chapters created yet.
                            </div>
                        @else
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($chapters as $chapter)
                                            <tr>
                                                <td>{{ $chapter->name }}</td>
                                                <td>
                                                    <span class="badge bg-label-{{ $chapter->status == 1 ? 'primary' : 'danger' }} me-1">
                                                        {{ $chapter->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start gap-2">
                                                        <div>
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditChapter_{{ $chapter->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                            <div class="modal fade" id="modalEditChapter_{{ $chapter->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle">Update Chapter</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form method="POST" action="{{ route('chapter.update', ['chapterId' => $chapter->id]) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                    
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="firstname" class="form-label">Name</label>
                                                                                    <input type="text" id="name" name="name" value="{{ $chapter->name }}" class="form-control" required placeholder="Enter chpater name">
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
                                                            <form method="POST" action="{{ route('chapter.delete', ['chapterId' => $chapter->id]) }}" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this chapter?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
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

                    <div class="tab-pane fade" id="navs-pills-top-zone" role="tabpanel">
                        @if ($zones->isEmpty())
                            <div class="alert alert-warning me-1" role="alert">
                                No zones created yet.
                            </div>
                        @else
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($zones as $zone)
                                            <tr>
                                                <td>{{ $zone->name }}</td>
                                                <td>
                                                    <span class="badge bg-label-{{ $zone->status == 1 ? 'primary' : 'danger' }} me-1">
                                                        {{ $zone->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start gap-2">
                                                        <div>
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditZone_{{ $zone->id }}"><i class="bx bx-edit-alt me-1"></i></button>
                                                            <div class="modal fade" id="modalEditZone_{{ $zone->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalCenterTitle">Update Zone</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form method="POST" action="{{ route('zone.update', ['zoneId' => $zone->id]) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                    
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="firstname" class="form-label">Name</label>
                                                                                    <input type="text" id="firstname" name="name" value="{{ $zone->name }}" class="form-control" required placeholder="Enter zone name">
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
                                                            <form method="POST" action="{{ route('zone.delete', ['zoneId' => $zone->id]) }}" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                
                                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this chapter?')"  class="btn btn-outline-danger"><i class="bx bx-trash me-1"></i></button>
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
      <div class="modal fade" id="modalChapter" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Chapter</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('chapter.store') }}" enctype="multipart/form-data">
              @csrf
          
              <div class="modal-body">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="firstname" class="form-label">Chapter Name</label>
                          <input type="text" id="firstname" name="name" class="form-control" required placeholder="Enter chapter name">
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

      <div class="modal fade" id="modalZone" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add a Zone</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('zone.store') }}" enctype="multipart/form-data">
              @csrf
          
              <div class="modal-body">
                  <div class="row">
                      <div class="col mb-3">
                          <label for="firstname" class="form-label">Zone Name</label>
                          <input type="text" id="firstname" name="name" class="form-control" required placeholder="Enter zone name">
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