@extends('theme.theme-master')
@section('content')

<style>
    .form-check {
        padding-left: 3.7em;
    }
    .card-body {
        padding: 0rem 1.5rem;
    }
    
</style>

    <div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12">
                @if ($status == 'success')
                    <div class="text-center mt-4">
                        <img src="{{ asset('assets/img/congratulations.png') }}" alt="Success Image" class="img-fluid" width="200px">
                        <br>
                        <h3 style="margin-top: 50px">Congratulations! You have scored {{ $percentage }}%.</h3>
                        <p class="mt-3">Head to the <a href="{{ route('certificates.index') }}">certificates</a> section to get your certificate.</p>
                    </div>
                @else
                    <div class="text-center mt-4">
                        <img src="{{ asset('assets/img/sad.png') }}" alt="Success Image" class="img-fluid" width="200px">
                        <h3 style="margin-top: 50px">Sorry, you have scored {{ $percentage }}%. Please try again.</h3>
                        <p class="mt-3">You need a minimum of 70% to pass the assessment.</p>
                    </div>
                @endif
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


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
         
@endsection