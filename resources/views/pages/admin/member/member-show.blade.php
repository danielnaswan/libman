@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Member Details</h6>
              <div>
                <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-primary btn-sm me-2">
                  <i class="fa fa-edit"></i> Edit Member
                </a>
                <a href="{{ route('admin.members.index') }}" class="btn btn-secondary btn-sm">
                  <i class="fa fa-arrow-left"></i> Back to Members
                </a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <div class="card">
                  <div class="card-body">
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Name:</strong>
                      </div>
                      <div class="col-sm-9">
                        <h5 class="mb-0">{{ $member->user->name }}</h5>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Email:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $member->user->email }}</p>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Phone:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $member->user->phone ?? 'Not provided' }}</p>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Location:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $member->user->location ?? 'Not provided' }}</p>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>User Type:</strong>
                      </div>
                      <div class="col-sm-9">
                        <span class="badge badge-sm bg-gradient-info">{{ $member->user->user_type ?? 'User' }}</span>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Status:</strong>
                      </div>
                      <div class="col-sm-9">
                        <span class="badge badge-sm {{ $member->getStatusBadgeClass() }}">{{ ucfirst($member->status) }}</span>
                      </div>
                    </div>
                    
                    @if($member->user->about_me)
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>About:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $member->user->about_me }}</p>
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6>Member Information</h6>
                  </div>
                  <div class="card-body">
                    <div class="text-center mb-3">
                      <div class="avatar avatar-xl rounded-circle bg-gradient-primary d-flex align-items-center justify-content-center mx-auto">
                        <i class="fa fa-user text-white text-2xl"></i>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">Joined:</small>
                      </div>
                      <div class="col-6">
                        <small>{{ $member->created_at->format('d M Y') }}</small>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">Updated:</small>
                      </div>
                      <div class="col-6">
                        <small>{{ $member->updated_at->format('d M Y') }}</small>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">User Since:</small>
                      </div>
                      <div class="col-6">
                        <small>{{ $member->user->created_at->format('d M Y') }}</small>
                      </div>
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="text-center mb-3">
                      <div class="row">
                        <div class="col-4">
                          <h4 class="text-primary mb-0">{{ $member->reservations->count() ?? 0 }}</h4>
                          <small class="text-muted">Reservations</small>
                        </div>
                        <div class="col-4">
                          <h4 class="text-warning mb-0">{{ $member->fines->count() ?? 0 }}</h4>
                          <small class="text-muted">Fines</small>
                        </div>
                        <div class="col-4">
                          <h4 class="text-info mb-0">{{ $member->created_at->diffInDays() }}</h4>
                          <small class="text-muted">Days</small>
                        </div>
                      </div>
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="d-flex justify-content-between">
                      <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                          <i class="fa fa-trash"></i> Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Recent Activity Section -->
            @if($member->reservations->count() > 0 || $member->fines->count() > 0)
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6>Recent Activity</h6>
                  </div>
                  <div class="card-body pt-0">
                    <ul class="list-group list-group-flush">
                      @if($member->reservations->count() > 0)
                        @foreach($member->reservations->take(5) as $reservation)
                        <li class="list-group-item px-0">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h6 class="mb-1">Reservation #{{ $reservation->id }}</h6>
                              <p class="text-sm mb-0">Book: {{ $reservation->book->title }}</p>
                              <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }} - 
                                {{ \Carbon\Carbon::parse($reservation->return_date)->format('M d, Y') }}
                              </p>
                            </div>
                            <div class="text-end">
                              <span class="badge badge-sm {{ $reservation->status === 'active' ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                {{ ucfirst($reservation->status) }}
                              </span>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      @endif

                      @if($member->fines->count() > 0)
                        @foreach($member->fines->take(5) as $fine)
                        <li class="list-group-item px-0">
                          <div class="d-flex justify-content-between">
                            <div>
                              <h6 class="mb-1">Fine #{{ $fine->id }}</h6>
                              <p class="text-sm mb-0">Amount: ${{ number_format($fine->amount, 2) }}</p>
                              <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-calendar me-1"></i>
                                {{ $fine->created_at->format('M d, Y') }}
                                @if($fine->paid_at)
                                  | Paid on: {{ $fine->paid_at->format('M d, Y') }}
                                @endif
                              </p>
                            </div>
                            <div class="text-end">
                              <span class="badge badge-sm {{ $fine->paid_at ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                                {{ $fine->paid_at ? 'Paid' : 'Unpaid' }}
                              </span>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      @endif

                      @if($member->reservations->count() === 0 && $member->fines->count() === 0)
                        <li class="list-group-item px-0">
                          <div class="text-center py-4">
                            <i class="fa fa-info-circle fa-2x text-secondary mb-3"></i>
                            <p class="mb-0">No recent activity found for this member</p>
                          </div>
                        </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection