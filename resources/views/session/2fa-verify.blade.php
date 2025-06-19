@extends('layouts.user_type.guest')

@section('content')

<main class="main-content mt-0">
  <section>
    <div class="page-header min-vh-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Two-Factor Authentication</h3>
                <p class="mb-0">Enter the 6-digit code from your authenticator app</p>
              </div>
              <div class="card-body">
                <form role="form" method="POST" action="{{ route('2fa.verify') }}">
                  @csrf
                  
                  <div class="text-center mb-4">
                    <i class="fas fa-mobile-alt fa-3x text-info"></i>
                  </div>
                  
                  <label>Authentication Code</label>
                  <div class="mb-3">
                    <input type="text" 
                           class="form-control text-center" 
                           name="code" 
                           id="code" 
                           placeholder="000000" 
                           maxlength="6"
                           pattern="[0-9]{6}"
                           autocomplete="off"
                           aria-label="2FA Code" 
                           aria-describedby="code-addon"
                           autofocus>
                    @error('code')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                    @error('error')
                      <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                      Verify Code
                    </button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  <a href="/login" class="text-info text-gradient font-weight-bold">← Back to Login</a>
                </p>
                <small class="text-muted">
                  Open your authenticator app (Google Authenticator, Microsoft Authenticator, etc.) 
                  and enter the 6-digit code for {{ config('app.name') }}.
                </small>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" 
                   style="background-image:url('../assets/img/uthm/uthm_ptta_center.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
  // Auto-submit when 6 digits are entered
  document.getElementById('code').addEventListener('input', function(e) {
    if (e.target.value.length === 6) {
      // Small delay to allow user to see the complete code
      setTimeout(() => {
        e.target.closest('form').submit();
      }, 500);
    }
  });
  
  // Only allow numbers
  document.getElementById('code').addEventListener('keypress', function(e) {
    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key)) {
      e.preventDefault();
    }
  });
</script>

@endsection