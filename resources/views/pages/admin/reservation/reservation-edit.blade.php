@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Edit Reservation #{{ $reservation->id }}</h6>
                        <div>
                            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('reservations.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reservations.update', $reservation) }}" method="POST">
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
                                                        {{ (old('member_id', $reservation->member_id) == $member->id) ? 'selected' : '' }}>
                                                    {{ $member->name }} ({{ $member->email }})
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
                                        <label for="book_id" class="form-control-label">Book <span class="text-danger">*</span></label>
                                        <select class="form-control @error('book_id') is-invalid @enderror" 
                                                id="book_id" 
                                                name="book_id" 
                                                required>
                                            <option value="">Select a book</option>
                                            @foreach($books as $book)
                                                <option value="{{ $book->id }}" 
                                                        {{ (old('book_id', $reservation->book_id) == $book->id) ? 'selected' : '' }}>
                                                    {{ $book->title }} - {{ $book->author }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('book_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reserved_until" class="form-control-label">Reserved Until <span class="text-danger">*</span></label>
                                        <input type="date" 
                                               class="form-control @error('reserved_until') is-invalid @enderror" 
                                               id="reserved_until" 
                                               name="reserved_until" 
                                               value="{{ old('reserved_until', $reservation->reserved_until->format('Y-m-d')) }}"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               required>
                                        @error('reserved_until')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Current Status</label>
                                        <div class="form-control-plaintext">
                                            @if($reservation->isExpired())
                                                <span class="badge badge-sm bg-gradient-danger">Expired</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Reservation
                                        </button>
                                        <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info ms-2">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary ms-2">
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
@endsection