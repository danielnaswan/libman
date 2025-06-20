@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Add New Member</h6>
              <a href="{{ route('admin.members.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Members
              </a>
            </div>
          </div>
          <div class="card-body">
            @if($availableUsers->isEmpty())
              <div class="alert alert-warning">
                <strong>No Available Users!</strong> All existing users are already members. You need to create new users first before adding them as members.
              </div>
            @else
              <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="user_id" class="form-control-label">Select User <span class="text-danger">*</span></label>
                      <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                        <option value="">Choose a user...</option>
                        @foreach($availableUsers as $user)
                          <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                          </option>
                        @endforeach
                      </select>
                      @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                      <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                        <option value="">Choose status...</option>
                        @foreach($statuses as $key => $value)
                          <option value="{{ $key }}" {{ old('status', 'active') == $key ? 'selected' : '' }}>
                            {{ $value }}
                          </option>
                        @endforeach
                      </select>
                      @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-12">
                    <div class="form-group mt-3">
                      <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Create Member
                      </button>
                      <a href="{{ route('admin.members.index') }}" class="btn btn-secondary ms-2">
                        <i class="fa fa-times"></i> Cancel
                      </a>
                    </div>
                  </div>
                </div>
              </form>
            @endif
          </div>
        </div>
      </div>
    </div>
    
    @if($availableUsers->isNotEmpty())
    <!-- User Preview Card -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h6>Selected User Preview</h6>
          </div>
          <div class="card-body" id="userPreview" style="display: none;">
            <div class="row">
              <div class="col-md-3">
                <div class="avatar avatar-xl rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center">
                  <i class="fa fa-user text-white text-2xl"></i>
                </div>
              </div>
              <div class="col-md-9">
                <div id="previewContent">
                  <!-- User details will be populated here via JavaScript -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</main>

@if($availableUsers->isNotEmpty())
<script>
document.getElementById('user_id').addEventListener('change', function() {
    const userId = this.value;
    const previewCard = document.getElementById('userPreview');
    const previewContent = document.getElementById('previewContent');
    
    if (userId) {
        // Find selected user data
        const users = @json($availableUsers);
        const selectedUser = users.find(user => user.id == userId);
        
        if (selectedUser) {
            previewContent.innerHTML = `
                <h6 class="mb-2">${selectedUser.name}</h6>
                <p class="text-sm mb-1"><strong>Email:</strong> ${selectedUser.email}</p>
                <p class="text-sm mb-1"><strong>User Type:</strong> ${selectedUser.user_type || 'N/A'}</p>
                <p class="text-sm mb-1"><strong>Phone:</strong> ${selectedUser.phone || 'N/A'}</p>
                <p class="text-sm mb-0"><strong>Location:</strong> ${selectedUser.location || 'N/A'}</p>
            `;
            previewCard.style.display = 'block';
        }
    } else {
        previewCard.style.display = 'none';
    }
});
</script>
@endif

@endsection