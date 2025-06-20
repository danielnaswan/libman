@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6>Browse Books</h6>
                                <p class="text-sm mb-0">Find and reserve books from our collection</p>
                            </div>
                        </div>
                        
                        <!-- Search and Filter Section -->
                        <div class="row g-2">
                            <div class="col-md-8">
                                <div class="input-group input-group-outline">
                                    <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="availability" class="form-control">
                                    <option value="">All Books</option>
                                    <option value="available" {{ request('availability') === 'available' ? 'selected' : '' }}>Available Only</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="submit" class="btn btn-primary btn-sm w-100 me-2">Search</button>
                                <a href="{{ route('member.books') }}" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        @if($books->count() > 0)
                            <div class="row px-3">
                                @foreach($books as $book)
                                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header p-0 position-relative">
                                            <div class="position-relative border-radius-lg bg-light" style="height: 40px;">
                                                <span class="badge {{ $book->availability_badge_class_attribute }} position-absolute top-0 end-0 m-2">
                                                    {{ $book->availability_status_attribute }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body p-3">
                                            <h6 class="mb-1">{{ $book->title }}</h6>
                                            <p class="text-sm text-secondary mb-2">
                                                <strong>Publisher:</strong> {{ $book->publisher }}<br>
                                                <strong>Year:</strong> {{ $book->publication_year }}
                                            </p>
                                            @if($book->description)
                                                <p class="mb-3 text-sm">{{ Str::limit($book->description, 100) }}</p>
                                            @endif
                                            
                                            @if($book->isReserved())
                                                @php
                                                    $currentReservation = $book->getCurrentReservation();
                                                @endphp
                                                <div class="alert alert-warning text-white mb-2 p-2">
                                                    <small>
                                                        <strong>Reserved until:</strong> {{ $currentReservation->reserved_until->format('M d, Y') }}
                                                    </small>
                                                </div>
                                                <button class="btn btn-outline-secondary btn-sm w-100 mb-0" disabled>
                                                    <i class="fas fa-ban"></i>&nbsp;&nbsp;Already Reserved
                                                </button>
                                            @else
                                                <form action="{{ route('member.books.reserve', $book) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm w-100 mb-0" onclick="return confirm('Are you sure you want to reserve this book?')">
                                                        <i class="fas fa-bookmark"></i>&nbsp;&nbsp;Reserve Book
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($books->hasPages())
                            <div class="px-3 py-3">
                                <div class="d-flex justify-content-center">
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm mb-0">
                                            {{-- Previous Page Link --}}
                                            @if ($books->onFirstPage())
                                                <li class="page-item disabled">
                                                    <span class="page-link">&laquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $books->previousPageUrl() }}" rel="prev">&laquo;</a>
                                                </li>
                                            @endif

                                            {{-- Pagination Elements --}}
                                            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                                @if ($page == $books->currentPage())
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
                                            @if ($books->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $books->nextPageUrl() }}" rel="next">&raquo;</a>
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
                                    Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-search fa-3x mb-3 opacity-6" style="color: #ccc;"></i>
                                <h6 class="text-muted mt-2">No Books Found</h6>
                                <p class="text-muted text-sm">No books match your search criteria.</p>
                                <a href="{{ route('member.books') }}" class="btn btn-outline-primary btn-sm">Show All Books</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection