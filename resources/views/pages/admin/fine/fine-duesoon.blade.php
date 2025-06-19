@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-warning">Fines Due Soon</h6>
                                <p class="text-sm mb-0">Fines due within the next 7 days</p>
                            </div>
                            <div>
                                <a href="{{ route('fines.overdue') }}" class="btn btn-danger btn-sm me-2">
                                    <i class="fas fa-exclamation-triangle"></i> Overdue
                                </a>
                                <a href="{{ route('fines.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> All Fines
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($fines->count() > 0)
                            <div class="alert alert-warning mx-3" role="alert">
                                <i class="fas fa-clock"></i>
                                <strong>Reminder:</strong> {{ $fines->count() }} fine(s) are due within the next 7 days. Consider sending payment reminders.
                            </div>
                        @endif
                        
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Book/Reservation</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Days Left</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fines as $fine)
                                        @php
                                            $daysLeft = $fine->getDaysUntilDue();
                                            $urgencyBadge = '';
                                            $urgencyText = '';
                                            
                                            if ($daysLeft <= 1) {
                                                $urgencyBadge = 'bg-gradient-danger';
                                                $urgencyText = 'Critical';
                                            } elseif ($daysLeft <= 3) {
                                                $urgencyBadge = 'bg-gradient-warning';
                                                $urgencyText = 'High';
                                            } else {
                                                $urgencyBadge = 'bg-gradient-info';
                                                $urgencyText = 'Medium';
                                            }
                                        @endphp
                                        
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $fine->member->user->name ?? 'N/A' }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $fine->member->user->email ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $fine->reservation->book->title ?? 'N/A' }}</p>
                                                <p class="text-xs text-secondary mb-0">Reservation #{{ $fine->reserve_id }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-secondary font-weight-bold">
                                                    {{ $fine->formatted_amount }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-s">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $fine->due_date->format('d/m/Y') }}</span>
                                                <br>
                                                <small class="text-muted">{{ $fine->due_date->format('l') }}</small>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{ $urgencyBadge }}">
                                                    {{ $daysLeft }} {{ $daysLeft == 1 ? 'day' : 'days' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm {{ $urgencyBadge }}">
                                                    {{ $urgencyText }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('fines.show', $fine) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('fines.edit', $fine) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="text-primary border-0 bg-transparent p-0"
                                                            onclick="sendReminder({{ $fine->id }}, '{{ $fine->member->email ?? '' }}')"
                                                            data-toggle="tooltip" title="Send reminder">
                                                        <i class="fa fa-bell"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-center">
                                                    <i class="fas fa-calendar-check text-success" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                                    <h5 class="text-success">No Urgent Fines!</h5>
                                                    <p class="text-sm text-secondary mb-0">No fines are due in the next 7 days.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($fines->hasPages())
                        <div class="px-3 py-3">
                            <div class="d-flex justify-content-center">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($fines->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">&laquo;</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $fines->previousPageUrl() }}" rel="prev">&laquo;</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($fines->getUrlRange(1, $fines->lastPage()) as $page => $url)
                                            @if ($page == $fines->currentPage())
                                                <li class="page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($fines->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $fines->nextPageUrl() }}" rel="next">&raquo;</a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">&raquo;</span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                            <div class="text-center text-sm text-secondary mt-2">
                                Showing {{ $fines->firstItem() }} to {{ $fines->lastItem() }} of {{ $fines->total() }} results
                            </div>
                        </div>
                        @endif
                        
                        @if($fines->count() > 0)
                        <div class="mx-3 mt-3">
                            <div class="row">
                                <!-- Priority Breakdown -->
                                <div class="col-md-6 mb-3">
                                    <div class="card border-warning">
                                        <div class="card-header bg-warning text-white">
                                            <h6 class="mb-0 text-white">Priority Breakdown</h6>
                                        </div>
                                        <div class="card-body">
                                            @php
                                                $critical = $fines->filter(function($fine) { return $fine->getDaysUntilDue() <= 1; });
                                                $high = $fines->filter(function($fine) { return $fine->getDaysUntilDue() > 1 && $fine->getDaysUntilDue() <= 3; });
                                                $medium = $fines->filter(function($fine) { return $fine->getDaysUntilDue() > 3; });
                                            @endphp
                                            
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <span class="badge badge-lg bg-gradient-danger">{{ $critical->count() }}</span>
                                                    <p class="mb-0 text-sm">Critical</p>
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge badge-lg bg-gradient-warning">{{ $high->count() }}</span>
                                                    <p class="mb-0 text-sm">High</p>
                                                </div>
                                                <div class="col-4">
                                                    <span class="badge badge-lg bg-gradient-info">{{ $medium->count() }}</span>
                                                    <p class="mb-0 text-sm">Medium</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Financial Summary -->
                                <div class="col-md-6 mb-3">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <h6 class="mb-0 text-white">Financial Summary</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-6 text-center">
                                                    <p class="mb-1 text-sm">Total Amount</p>
                                                    <h6 class="text-info">${{ number_format($fines->sum('amount'), 2) }}</h6>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <p class="mb-1 text-sm">Average Fine</p>
                                                    <h6 class="text-info">${{ number_format($fines->avg('amount'), 2) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="card border-primary">
                                <div class="card-body text-center">
                                    <button class="btn btn-primary me-2" onclick="sendBulkReminders()">
                                        <i class="fas fa-envelope"></i> Send All Reminders
                                    </button>
                                    <button class="btn btn-info me-2" onclick="exportDueSoon()">
                                        <i class="fas fa-download"></i> Export List
                                    </button>
                                    <a href="{{ route('fines.create') }}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Add New Fine
                                    </a>
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

<script>
function sendReminder(fineId, email) {
    if (confirm(`Send payment reminder to ${email}?`)) {
        // Implement reminder functionality here
        // This could be an AJAX call to send email reminder
        alert('Reminder functionality coming soon! You can manually contact the member for now.');
        
        /*
        fetch(`/fines/${fineId}/send-reminder`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                alert('Reminder sent successfully!');
            }
        });
        */
    }
}

function sendBulkReminders() {
    if (confirm('Send payment reminders to all members with fines due soon?')) {
        alert('Bulk reminder functionality coming soon!');
    }
}

function exportDueSoon() {
    alert('Export functionality coming soon!');
    // window.location.href = '/fines/export?filter=due-soon';
}
</script>
@endsection