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
                                <h6 class="text-danger">Overdue Fines</h6>
                                <p class="text-sm mb-0">Fines that have passed their due date</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.fines.due-soon') }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-clock"></i> Due Soon
                                </a>
                                <a href="{{ route('admin.fines.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> All Fines
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($fines->count() > 0)
                            <div class="alert alert-danger mx-3" role="alert">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>Attention Required:</strong> {{ $fines->count() }} fine(s) are overdue and require immediate action.
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Days Overdue</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($fines as $fine)
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
                                                <span class="text-danger font-weight-bold">
                                                    {{ $fine->formatted_amount }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center text-s">
                                                <span class="text-danger text-xs font-weight-bold">{{ $fine->due_date->format('d/m/Y') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-danger">
                                                    {{ abs($fine->getDaysUntilDue()) }} days
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.fines.show', $fine) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.fines.edit', $fine) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="text-success border-0 bg-transparent p-0" 
                                                            onclick="markAsPaid({{ $fine->id }})"
                                                            data-toggle="tooltip" title="Mark as paid">
                                                        <i class="fa fa-check-circle"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-center">
                                                    <i class="fas fa-check-circle text-success" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                                                    <h5 class="text-success">No Overdue Fines!</h5>
                                                    <p class="text-sm text-secondary mb-0">All fines are up to date.</p>
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
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h6 class="mb-0 text-white">Overdue Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Total Overdue Fines:</strong><br>
                                            <span class="text-danger h5">${{ number_format($fines->sum('amount'), 2) }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Number of Fines:</strong><br>
                                            <span class="text-danger h5">{{ $fines->count() }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Average Days Overdue:</strong><br>
                                            <span class="text-danger h5">
                                                {{ $fines->count() > 0 ? round($fines->avg(function($fine) { return abs($fine->getDaysUntilDue()); })) : 0 }} days
                                            </span>
                                        </div>
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

<script>
function markAsPaid(fineId) {
    if (confirm('Mark this fine as paid? This action will remove it from the system.')) {
        // For now, redirect to edit page - you can implement actual payment processing later
        window.location.href = `/fines/${fineId}/edit`;
        
        // Or you could implement an AJAX call to mark as paid:
        /*
        fetch(`/fines/${fineId}/mark-paid`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                location.reload();
            }
        });
        */
    }
}
</script>
@endsection