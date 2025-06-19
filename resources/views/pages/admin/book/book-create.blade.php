@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Add New Book</h6>
              <a href="{{ route('books.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Books
              </a>
            </div>
          </div>
          <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
              @csrf
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title" class="form-control-label">Title <span class="text-danger">*</span></label>
                    <input class="form-control @error('title') is-invalid @enderror" 
                           type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}" 
                           placeholder="Enter book title">
                    @error('title')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="publisher" class="form-control-label">Publisher <span class="text-danger">*</span></label>
                    <input class="form-control @error('publisher') is-invalid @enderror" 
                           type="text" 
                           name="publisher" 
                           id="publisher" 
                           value="{{ old('publisher') }}" 
                           placeholder="Enter publisher name">
                    @error('publisher')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="publication_year" class="form-control-label">Publication Year <span class="text-danger">*</span></label>
                    <input class="form-control @error('publication_year') is-invalid @enderror" 
                           type="date" 
                           name="publication_year" 
                           id="publication_year" 
                           value="{{ old('publication_year') }}">
                    @error('publication_year')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="description" class="form-control-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" 
                              id="description" 
                              rows="4" 
                              placeholder="Enter book description">{{ old('description') }}</textarea>
                    @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-save"></i> Create Book
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">
                      <i class="fa fa-times"></i> Cancel
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