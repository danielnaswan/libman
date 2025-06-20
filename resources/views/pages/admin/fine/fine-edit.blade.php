@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Edit Fine #{{ $fine->id }}</h6>
                        <div>
                            <a href="{{ route('admin.fines.show', $fine) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.fines.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.fines.update', $fine) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="member_id" class="form-control-label">Member <span class="text-danger">*</span></label>
                                        <select class="form-control @error('member_id') is-invalid @enderror" 
                                                id="member_id" 
                                                name="member_id" 
                                                required>
                                            <option value="">Select a member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" 
                                                        {{ (old('member_id', $fine->member_id) == $member->id) ? 'selected' : '' }}>
                                                    {{ $member->user->name }} ({{ $member->user->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('member_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reserve_id" class="form-control-label">Reservation <span class="text-danger">*</span></label>
                                        <select class="form-control @error('reserve_id') is-invalid @enderror" 
                                                id="reserve_id" 
                                                name="reserve_id" 
                                                required>
                                            <option value="">Select a reservation</option>
                                            @foreach($reservations as $reservation)
                                                <option value="{{ $reservation->id }}" 
                                                        {{ (old('reserve_id', $fine->reserve_id) == $reservation->id) ? 'selected' : '' }}>
                                                    #{{ $reservation->id }} - {{ $reservation->book->title ?? 'N/A' }} ({{ $reservation->member->user->name ?? 'N/A' }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('reserve_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount" class="form-control-label">Fine Amount <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" 
                                                   class="form-control @error('amount') is-invalid @enderror" 
                                                   id="amount" 
                                                   name="amount" 
                                                   value="{{ old('amount', $fine->amount) }}"
                                                   step="0.01"
                                                   min="0.01"
                                                   max="9999.99"
                                                   placeholder="0.00"
                                                   required>
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="text-muted">Enter amount between $0.01 - $9,999.99</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="due_date" class="form-control-label">Due Date <span class="text-danger">*</span></label>
                                        <input type="date" 
                                               class="form-control @error('due_date') is-invalid @enderror" 
                                               id="due_date" 
                                               name="due_date" 
                                               value="{{ old('due_date', $fine->due_date->format('Y-m-d')) }}"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               required>
                                        @error('due_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Due date must be in the future</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Current Status Information -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border mt-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Current Fine Status</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Current Status:</strong><br>
                                                    @if($fine->isOverdue())
                                                        <span class="badge badge-lg bg-gradient-danger">Overdue</span>
                                                    @elseif($fine->getDaysUntilDue() <= 3)
                                                        <span class="badge badge-lg bg-gradient-warning">Due Soon</span>
                                                    @else
                                                        <span class="badge badge-lg bg-gradient-success">Active</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Days Until Due:</strong><br>
                                                    <span class="text-info">{{ $fine->getDaysUntilDue() }} days</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Created:</strong><br>
                                                    <span class="text-muted">{{ $fine->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Last Updated:</strong><br>
                                                    <span class="text-muted">{{ $fine->updated_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Amount Adjustment Section -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card border mt-3">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Quick Amount Adjustments</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="setAmount(5.00)">
                                                        Late Return - $5.00
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="setAmount(15.00)">
                                                        Lost Book - $15.00
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-outline-danger btn-sm w-100 mb-2" onclick="setAmount(25.00)">
                                                        Damaged Book - $25.00
                                                    </button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm w-100 mb-2" onclick="setAmount({{ $fine->amount }})">
                                                        Reset to Original
                                                    </button>
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
                                            <i class="fas fa-save"></i> Update Fine
                                        </button>
                                        <a href="{{ route('admin.fines.show', $fine) }}" class="btn btn-info ms-2">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('admin.fines.index') }}" class="btn btn-secondary ms-2">
                                            Cancel
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

<script>
function setAmount(amount) {
    document.getElementById('amount').value = amount.toFixed(2);
}

// Auto-filter reservations based on selected member
document.getElementById('member_id').addEventListener('change', function() {
    const memberId = this.value;
    const reservationSelect = document.getElementById('reserve_id');
    const reservations = @json($reservations);
    const currentReservationId = {{ $fine->reserve_id }};
    
    // Clear current options
    reservationSelect.innerHTML = '<option value="">Select a reservation</option>';
    
    if (memberId) {
        // Filter reservations for selected member
        const memberReservations = reservations.filter(res => res.member_id == memberId);
        
        memberReservations.forEach(reservation => {
            const option = document.createElement('option');
            option.value = reservation.id;
            option.textContent = `#${reservation.id} - ${reservation.book?.title || 'N/A'}`;
            if (reservation.id == currentReservationId) {
                option.selected = true;
            }
            reservationSelect.appendChild(option);
        });
    } else {
        // Show all reservations
        reservations.forEach(reservation => {
            const option = document.createElement('option');
            option.value = reservation.id;
            option.textContent = `#${reservation.id} - ${reservation.book?.title || 'N/A'} (${reservation.member?.name || 'N/A'})`;
            if (reservation.id == currentReservationId) {
                option.selected = true;
            }
            reservationSelect.appendChild(option);
        });
    }
});
</script>
@endsection