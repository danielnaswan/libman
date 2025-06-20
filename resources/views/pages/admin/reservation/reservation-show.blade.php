@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Reservation Details #{{ $reservation->id }}</h6>
                        <div>
                            <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary btn-sm">
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
                                                {{ $reservation->member->user->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Email:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $reservation->member->user->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                        @if(isset($reservation->member->user->phone))
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Phone:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $reservation->member->user->phone }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Book Information -->
                            <div class="col-md-6">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-book"></i> Book Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Title:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $reservation->book->title ?? 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>Author:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $reservation->book->publisher ?? 'N/A' }}
                                            </div>
                                        </div>
                                        @if(isset($reservation->book->isbn))
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <strong>ISBN:</strong>
                                            </div>
                                            <div class="col-8">
                                                {{ $reservation->book->isbn }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Reservation Details -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card border mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="fas fa-calendar"></i> Reservation Details</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Reserved Until:</strong><br>
                                                    <span class="text-primary">{{ $reservation->reserved_until->format('l, F d, Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Status:</strong><br>
                                                    @if($reservation->isExpired())
                                                        <span class="badge badge-lg bg-gradient-danger">Expired</span>
                                                    @else
                                                        <span class="badge badge-lg bg-gradient-success">Active</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Created:</strong><br>
                                                    <span class="text-muted">{{ $reservation->created_at->format('M d, Y H:i') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <strong>Last Updated:</strong><br>
                                                    <span class="text-muted">{{ $reservation->updated_at->format('M d, Y H:i') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if($reservation->isExpired())
                                            <div class="alert alert-danger mt-3" role="alert">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                <strong>Warning:</strong> This reservation has expired on {{ $reservation->reserved_until->format('F d, Y') }}.
                                            </div>
                                        @else
                                            @php
                                                $daysLeft = $reservation->reserved_until->diffInDays(now());
                                            @endphp
                                            @if($daysLeft <= 3)
                                                <div class="alert alert-warning mt-3" role="alert">
                                                    <i class="fas fa-clock"></i>
                                                    <strong>Notice:</strong> This reservation will expire in {{ $daysLeft }} {{ $daysLeft == 1 ? 'day' : 'days' }}.
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit Reservation
                                        </a>
                                        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary ms-2">
                                            <i class="fas fa-list"></i> All Reservations
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this reservation? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i> Delete Reservation
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
@endsection