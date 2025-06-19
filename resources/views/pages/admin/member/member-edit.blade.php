@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Edit Member: {{ $member->user->name }}</h6>
              <a href="{{ route('members.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Members
              </a>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('members.update', $member) }}" method="POST">
              @csrf
              @method('PUT')
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label">User Information</label>
                    <div class="card">
                      <div class="card-body">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-sm rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center me-3">
                            <i class="fa fa-user text-white text-sm"></i>
                          </div>
                          <div>
                            <h6 class="mb-0">{{ $member->user->name }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $member->user->email }}</p>
                            @if($member->user->phone)
                              <p class="text-xs text-secondary mb-0">{{ $member->user->phone }}</p>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status" class="form-control-label">Status <span class="text-danger">*</span></label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                      @foreach($statuses as $key => $value)
                        <option value="{{ $key }}" {{ old('status', $member->status) == $key ? 'selected' : '' }}>
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
                  <div class="card">
                    <div class="card-header pb-0">
                      <h6>Member Statistics</h6>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="text-center">
                            <h4 class="text-primary mb-0">{{ $member->created_at->diffForHumans() }}</h4>
                            <p class="text-sm mb-0">Member Since</p>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="text-center">
                            <h4 class="text-info mb-0">{{ $member->reservations->count() ?? 0 }}</h4>
                            <p class="text-sm mb-0">Total Reservations</p>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="text-center">
                            <h4 class="text-warning mb-0">{{ $member->fines->count() ?? 0 }}</h4>
                            <p class="text-sm mb-0">Total Fines</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-save"></i> Update Member
                    </button>
                    <a href="{{ route('members.show', $member) }}" class="btn btn-info ms-2">
                      <i class="fa fa-eye"></i> View Member
                    </a>
                    <a href="{{ route('members.index') }}" class="btn btn-secondary ms-2">
                      <i class="fa fa-times"></i> Cancel
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection