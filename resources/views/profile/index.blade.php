@extends('theme.theme-master')
@section('content')

    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Profile</span>
      </h4>
        <div class="row">
          <div class="col-md-12">

            <div class="card mb-4">
              <h5 class="card-header">Profile Details</h5>
              <!-- Account -->
              <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                  <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                  <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                      <span class="d-none d-sm-block">Upload new photo</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                    </label>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button>
        
                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                  </div>
                </div>
              </div>
              <hr class="my-0">
              <div class="card-body">
                <form id="formAccountSettings" method="POST" onsubmit="return false">
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus="">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input class="form-control" type="text" name="lastName" id="lastName" value="Doe">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">E-mail</label>
                      <input class="form-control" type="text" id="email" name="email" value="john.doe@example.com" placeholder="john.doe@example.com">
                    </div>
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="phoneNumber">Phone Number</label>
                      <div class="input-group input-group-merge">
                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="202 555 0111">
                      </div>
                    </div>

                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="country">Gender</label>
                      <select id="country" class="select2 form-select">
                        <option value="">Select</option>
                        <option value="Australia">Male</option>
                        <option value="Bangladesh">Female</option>
                      </select>  
                    </div>

                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="country">Date of Birth</label>
                      <input type="date" id="dobBackdrop" class="form-control">
                    </div>
                    
                    <div class="mb-3 col-md-6">
                      <label class="form-label" for="country">Country</label>
                      <select id="country" class="select2 form-select">
                        <option value="">Select</option>
                        <option value="Australia">Australia</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Canada">Canada</option>
                        <option value="China">China</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Japan">Japan</option>
                        <option value="Korea">Korea, Republic of</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Russia">Russian Federation</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                      </select>
                    </div>

                    <div class="mb-3 col-md-6">
                      <label for="state" class="form-label">State</label>
                      <input class="form-control" type="text" id="state" name="state" placeholder="California">
                    </div>

                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
        
        
                  </div>


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