@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Book Details</h6>
              <div>
                <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary btn-sm me-2">
                  <i class="fa fa-edit"></i> Edit Book
                </a>
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary btn-sm">
                  <i class="fa fa-arrow-left"></i> Back to Books
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
                        <strong>Title:</strong>
                      </div>
                      <div class="col-sm-9">
                        <h5 class="mb-0">{{ $book->title }}</h5>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Publisher:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $book->publisher }}</p>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Publication Year:</strong>
                      </div>
                      <div class="col-sm-9">
                        <span class="badge badge-sm bg-gradient-info">{{ \Carbon\Carbon::parse($book->publication_year)->format('Y') }}</span>
                      </div>
                    </div>
                    
                    <div class="row mb-3">
                      <div class="col-sm-3">
                        <strong>Description:</strong>
                      </div>
                      <div class="col-sm-9">
                        <p class="mb-0">{{ $book->description }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header pb-0">
                    <h6>Book Information</h6>
                  </div>
                  <div class="card-body">
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">Created:</small>
                      </div>
                      <div class="col-6">
                        <small>{{ $book->created_at->format('d M Y') }}</small>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">Updated:</small>
                      </div>
                      <div class="col-6">
                        <small>{{ $book->updated_at->format('d M Y') }}</small>
                      </div>
                    </div>
                    
                    <div class="row mb-2">
                      <div class="col-6">
                        <small class="text-muted">Status:</small>
                      </div>
                      <div class="col-6">
                        <span class="badge badge-sm bg-gradient-success">Active</span>
                      </div>
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="d-flex justify-content-between">
                      <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-edit"></i> Edit
                      </a>
                      <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this book?')">
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
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection