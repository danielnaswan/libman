@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Books Management</h6>
              <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add New Book
              </a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            @if(session('success'))
              <div class="alert alert-success mx-3 mt-3">
                {{ session('success') }}
              </div>
            @endif
            
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Book</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Publisher</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publication Year</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($books as $book)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $book->title }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ Str::limit($book->description, 50) }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $book->publisher }}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($book->publication_year)->format('Y') }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $book->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center text-s">
                      <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.books.show', $book) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-danger border-0 bg-transparent p-0" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center py-4">
                      <div class="text-secondary">
                        <i class="fa fa-book fa-3x mb-3 opacity-6"></i>
                        <p class="mb-0">No books found</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm mt-2">Add Your First Book</a>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            
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
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection