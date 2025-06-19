@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ auth()->user()->name ?? 'User Not Founnd' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm text-uppercase">
                            {{ auth()->user()->user_type }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#profile-tab" role="tab" aria-controls="profile" aria-selected="true">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="box-3d-50" transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z" id="Path"></path>
                                                        <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" id="Path" opacity="0.7"></path>
                                                        <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" id="Path" opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Profile') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#security-tab" role="tab" aria-controls="security" aria-selected="false">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>shield</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="shield" transform="translate(304.000000, 151.000000)">
                                                        <path class="color-background" d="M20,0 C8.95,0 0,8.95 0,20 C0,31.05 8.95,40 20,40 C31.05,40 40,31.05 40,20 C40,8.95 31.05,0 20,0 Z M20,35 C11.73,35 5,28.27 5,20 C5,11.73 11.73,5 20,5 C28.27,5 35,11.73 35,20 C35,28.27 28.27,35 20,35 Z" id="Path"></path>
                                                        <path class="color-background" d="M20,10 C14.48,10 10,14.48 10,20 C10,25.52 14.48,30 20,30 C25.52,30 30,25.52 30,20 C30,14.48 25.52,10 20,10 Z M18,25 L13,20 L14.41,18.59 L18,22.17 L25.59,14.58 L27,16 L18,25 Z" id="Path" opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="ms-1">{{ __('Security') }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid py-4">
        <div class="tab-content">
            {{-- Profile Information Tab --}}
            <div class="tab-pane fade show active" id="profile-tab" role="tabpanel">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="/user-profile" method="POST" role="form text-left">
                            @csrf
                            @if($errors->any())
                                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                                    <span class="alert-text text-white">
                                    {{$errors->first()}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="m-3 alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                                    <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                        <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                                @error('name')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                                @error('email')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                        <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="{{ auth()->user()->phone }}">
                                                @error('phone')
                                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                        <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="about">{{ 'About Me' }}</label>
                                <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Security Tab --}}
            <div class="tab-pane fade" id="security-tab" role="tabpanel">
                <div class="row">
                    {{-- Two-Factor Authentication Card --}}
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6>Two-Factor Authentication</h6>
                                <p class="text-sm mb-0">
                                    Add an extra layer of security to your account
                                </p>
                            </div>
                            <div class="card-body">
                                @if(auth()->user()->google2fa_secret)
                                    {{-- 2FA is enabled --}}
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon icon-shape icon-sm bg-gradient-success shadow text-center me-3">
                                            <i class="fas fa-shield-alt opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Two-Factor Authentication is <span class="text-success">Enabled</span></h6>
                                            <p class="text-xs text-secondary mb-0">Your account is protected with 2FA</p>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <strong>Great!</strong> Your account is secured with two-factor authentication.
                                        You'll need to enter a code from your authenticator app when signing in.
                                    </div>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#disable2faModal">
                                        <i class="fas fa-times me-1"></i>Disable 2FA
                                    </button>
                                    
                                @else
                                    {{-- 2FA is disabled --}}
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon icon-shape icon-sm bg-gradient-warning shadow text-center me-3">
                                            <i class="fas fa-shield-alt opacity-10" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Two-Factor Authentication is <span class="text-warning">Disabled</span></h6>
                                            <p class="text-xs text-secondary mb-0">Secure your account by enabling 2FA</p>
                                        </div>
                                    </div>

                                    <div class="alert alert-info text-white">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Recommended:</strong> Enable two-factor authentication to add an extra layer of security to your account. 
                                        You'll need an authenticator app like Google Authenticator or Microsoft Authenticator.
                                    </div>
                                    
                                    <a href="{{ route('2fa.setup') }}" class="btn bg-gradient-info btn-sm">
                                        <i class="fas fa-plus me-1"></i>Enable 2FA
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Security Tips Card --}}
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6>Security Tips</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-one-side">
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="fas fa-key text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Strong Password</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                Use a unique, complex password
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="fas fa-mobile-alt text-info text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">2FA Protection</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                Enable two-factor authentication
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="timeline-block mb-3">
                                        <span class="timeline-step">
                                            <i class="fas fa-eye text-warning text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">Monitor Activity</h6>
                                            <p class="text-secondary font-weight-normal text-xs mt-1 mb-0">
                                                Review login activity regularly
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Setup 2FA Modal --}}
@if(!auth()->user()->google2fa_secret)
<div class="modal fade" id="setup2faModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setup Two-Factor Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Instructions</h6>
                        
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="fas fa-mobile-alt text-success text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">1. Install App</h6>
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
                                        Click "Generate QR Code" and scan it with your app
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
                                        Enter the 6-digit code to verify setup
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="text-center">
                            <div id="qrcode-container" class="d-none">
                                <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">QR Code</h6>
                                <div class="bg-gray-100 p-3 rounded mb-3">
                                    <div id="qrcode-image"></div>
                                </div>
                                <div class="alert alert-info">
                                    <strong>Manual Setup:</strong><br>
                                    <small id="secret-key"></small>
                                </div>
                            </div>
                            
                            <button type="button" id="generate-qr" class="btn bg-gradient-info mb-3">
                                <i class="fas fa-qrcode me-2"></i>Generate QR Code
                            </button>
                        </div>
                        
                        <form id="enable-2fa-form" class="d-none">
                            @csrf
                            <input type="hidden" id="secret-input" name="secret">
                            
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
                            </div>
                            
                            <button type="submit" class="btn bg-gradient-success w-100">
                                <i class="fas fa-shield-alt me-2"></i>Enable 2FA
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Disable 2FA Modal --}}
@if(auth()->user()->google2fa_secret)
<div class="modal fade" id="disable2faModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Disable Two-Factor Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('2fa.disable') }}">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Disabling 2FA will make your account less secure.
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" 
                               class="form-control" 
                               name="password" 
                               required
                               placeholder="Enter your current password">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">2FA Code</label>
                        <input type="text" 
                               class="form-control text-center" 
                               name="code" 
                               placeholder="000000"
                               maxlength="6"
                               pattern="[0-9]{6}"
                               required>
                        <small class="text-muted">Enter the current 2FA code from your authenticator app</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Disable 2FA</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate QR Code functionality
    document.getElementById('generate-qr')?.addEventListener('click', function() {
        fetch('/api/generate-2fa-qr', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('qrcode-image').innerHTML = `<img src="data:image/png;base64,${data.qrcode}" alt="2FA QR Code" class="img-fluid" style="max-width: 200px;">`;
                document.getElementById('secret-key').innerHTML = `<code class="text-dark">${data.secret}</code>`;
                document.getElementById('secret-input').value = data.secret;
                
                document.getElementById('qrcode-container').classList.remove('d-none');
                document.getElementById('enable-2fa-form').classList.remove('d-none');
                this.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to generate QR code. Please try again.');
        });
    });

    // Enable 2FA form submission
    document.getElementById('enable-2fa-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('/2fa/enable', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to enable 2FA. Please check your code and try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to enable 2FA. Please try again.');
        });
    });

    // Only allow numbers in 2FA code inputs
    document.querySelectorAll('input[name="code"]').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter'].includes(e.key)) {
                e.preventDefault();
            }
        });
    });
});
</script>

@endsection