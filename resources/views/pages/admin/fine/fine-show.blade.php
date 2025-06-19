@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Fine Details #{{ $fine->id }}</h6>
                        <div>
                            <a href="{{ route('fines.edit', $fine) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('fines.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Member Information -->
                            <div class="col-md-6">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-user"></i> Member Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Name:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->member->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Email:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->member->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                        @if(isset($fine->member->phone))
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Phone:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->member->phone }}
                                            </div>
                                        </div>
                                        @endif
                                        @if(isset($fine->member->membership_id))
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Member ID:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->member->membership_id }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Reservation & Book Information -->
                            <div class="col-md-6">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-book"></i> Reservation & Book Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Reservation ID:</strong>
                                            </div>
                                            <div class="col-8">
                                                <a href="{{ route('reservations.show', $fine->reservation) }}" class="text-primary">
                                                    #{{ $fine->reserve_id }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Book Title:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->reservation->book->title ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Book Author:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->reservation->book->author ?? 'N/A' }}
                                            </div>
                                        </div>
                                        @if(isset($fine->reservation->book->isbn))
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>ISBN:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->reservation->book->isbn }}
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Reserved Until:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $fine->reservation->reserved_until->format('F d, Y') }}
                                                @if($fine->reservation->isExpired())
                                                    <span class="badge badge-sm bg-gradient-danger ms-2">Expired</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fine Details -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-dollar-sign"></i> Fine Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Fine Amount:</strong><br>
                                                    <span class="text-primary h5">{{ $fine->formatted_amount }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Due Date:</strong><br>
                                                    <span class="text-info">{{ $fine->due_date->format('l, F d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Status:</strong><br>
                                                    @if($fine->isOverdue())
                                                        <span class="badge badge-lg bg-gradient-danger">Overdue</span>
                                                    @elseif($fine->getDaysUntilDue() <= 3)
                                                        <span class="badge badge-lg bg-gradient-warning">Due Soon</span>
                                                    @else
                                                        <span class="badge badge-lg bg-gradient-success">Active</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Days Until Due:</strong><br>
                                                    @if($fine->isOverdue())
                                                        <span class="text-danger">{{ abs($fine->getDaysUntilDue()) }} days overdue</span>
                                                    @else
                                                        <span class="text-success">{{ $fine->getDaysUntilDue() }} days remaining</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Status Alerts -->
                                        @if($fine->isOverdue())
                                            <div class="alert alert-danger mt-3" role="alert">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <strong>Overdue Notice:</strong> This fine was due on {{ $fine->due_date->format('F d, Y') }} and is now {{ abs($fine->getDaysUntilDue()) }} days overdue.
                                            </div>
                                        @elseif($fine->getDaysUntilDue() <= 3)
                                            <div class="alert alert-warning mt-3" role="alert">
                                                <i class="fas fa-clock"></i>
                                                <strong>Due Soon:</strong> This fine is due in {{ $fine->getDaysUntilDue() }} {{ $fine->getDaysUntilDue() == 1 ? 'day' : 'days' }}.
                                            </div>
                                        @elseif($fine->getDaysUntilDue() <= 7)
                                            <div class="alert alert-info mt-3" role="alert">
                                                <i class="fas fa-info-circle"></i>
                                                <strong>Reminder:</strong> This fine is due in {{ $fine->getDaysUntilDue() }} days.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timeline Information -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-clock"></i> Timeline Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <strong>Fine Created:</strong><br>
                                                    <span class="text-muted">{{ $fine->created_at->format('F d, Y \a\t H:i') }}</span><br>
                                                    <small class="text-muted">{{ $fine->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <strong>Last Updated:</strong><br>
                                                    <span class="text-muted">{{ $fine->updated_at->format('F d, Y \a\t H:i') }}</span><br>
                                                    <small class="text-muted">{{ $fine->updated_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <strong>Reservation Date:</strong><br>
                                                    <span class="text-muted">{{ $fine->reservation->created_at->format('F d, Y') }}</span><br>
                                                    <small class="text-muted">{{ $fine->reservation->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('fines.edit', $fine) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit Fine
                                        </a>
                                        <a href="{{ route('reservations.show', $fine->reservation) }}" class="btn btn-info ms-2">
                                            <i class="fas fa-book"></i> View Reservation
                                        </a>
                                        <a href="{{ route('fines.index') }}" class="btn btn-secondary ms-2">
                                            <i class="fas fa-list"></i> All Fines
                                        </a>
                                    </div>
                                    <div>
                                        @if($fine->isOverdue())
                                            <button class="btn btn-success me-2" onclick="markAsPaid()">
                                                <i class="fas fa-check"></i> Mark as Paid
                                            </button>
                                        @endif
                                        <form action="{{ route('fines.destroy', $fine) }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this fine? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Delete Fine
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function markAsPaid() {
    if (confirm('Mark this fine as paid? This will remove it from overdue status.')) {
        // You can implement the mark as paid functionality here
        // This might involve creating a new status field or deleting the fine
        alert('Feature coming soon! You can edit the fine to extend the due date for now.');
    }
}
</script>
@endsection