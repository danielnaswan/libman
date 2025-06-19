@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card">
        <div class="card-header pb-0">
          <h4 class="font-weight-bolder text-info text-gradient">Setup Two-Factor Authentication</h4>
          <p class="mb-0">Secure your account with 2FA using an authenticator app</p>
        </div>
        <div class="card-body">
          <div class="row">
            <!-- Instructions Column -->
            <div class="col-md-6">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Instructions</h6>
              
              <div class="timeline timeline-one-side">
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="fas fa-mobile-alt text-success text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">1. Install Authenticator App</h6>
                    <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                      Download Microsoft Authenticator, Google Authenticator, or any TOTP app
                    </p>
                  </div>
                </div>
                
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="fas fa-qrcode text-info text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">2. Scan QR Code</h6>
                    <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                      Use your authenticator app to scan the QR code
                    </p>
                  </div>
                </div>
                
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    <i class="fas fa-key text-warning text-gradient"></i>
                  </span>
                  <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">3. Enter Code</h6>
                    <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                      Enter the 6-digit code from your app to verify setup
                    </p>
                  </div>
                </div>
              </div>
              
              <div class="alert alert-info text-white">
                <strong>Manual Setup:</strong><br>
                If you can't scan the QR code, manually enter this secret key:<br>
                <code class="text-dark">{{ $secret }}</code>
              </div>
            </div>
            
            <!-- QR Code and Form Column -->
            <div class="col-md-6">
              <div class="text-center mb-4">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">QR Code</h6>
                <div class="bg-gray-100 p-3 rounded">
                  <img src="data:image/png;base64,{{ $qrCodeImage }}" 
                       alt="2FA QR Code" 
                       class="img-fluid"
                       style="max-width: 200px;">
                </div>
              </div>
              
              <form method="POST" action="{{ route('2fa.enable') }}">
                @csrf
                <input type="hidden" name="secret" value="{{ $secret }}">
                
                <div class="mb-3">
                  <label class="form-label">Verification Code</label>
                  <input type="text" 
                         class="form-control text-center" 
                         name="code" 
                         placeholder="000000" 
                         maxlength="6"
                         pattern="[0-9]{6}"
                         required
                         autocomplete="off">
                  <small class="text-muted">Enter the 6-digit code from your authenticator app</small>
                  @error('code')
                    <div class="text-danger text-xs mt-1">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="d-grid gap-2">
                  <button type="submit" class="btn bg-gradient-success">
                    <i class="fas fa-shield-alt me-2"></i>Enable 2FA
                  </button>
                  <a href="{{ url('dashboard') }}" class="btn btn-outline-secondary">
                    Cancel
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Only allow numbers in the code input
  document.querySelector('input[name="code"]').addEventListener('keypress', function(e) {
    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key)) {
      e.preventDefault();
    }
  });
</script>

@endsection