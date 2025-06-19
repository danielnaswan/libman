@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Reservations Management</h6>
              <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add New Reservation
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Book</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Reserved Until</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($reservations as $reservation)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $reservation->member->user->name ?? 'N/A' }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $reservation->member->user->email ?? 'N/A' }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $reservation->book->title ?? 'N/A' }}</p>
                      <p class="text-xs text-secondary mb-0">{{ $reservation->book->publisher ?? 'N/A' }}</p>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $reservation->reserved_until->format('d/m/Y') }}
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      @if($reservation->isExpired())
                        <span class="badge badge-sm bg-gradient-danger">Expired</span>
                      @else
                        <span class="badge badge-sm bg-gradient-success">Active</span>
                      @endif
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">
                        {{ $reservation->created_at->format('d/m/Y') }}
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('reservations.show', $reservation) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('reservations.edit', $reservation) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this reservation?')">
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
                    <td colspan="6" class="text-center py-4">
                      <div class="text-secondary">
                        <i class="fa fa-book fa-3x mb-3 opacity-6"></i>
                        <p class="mb-0">No reservations found</p>
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-sm mt-2">Create Your First Reservation</a>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            
            @if($reservations->hasPages())
            <div class="px-3 py-3">
              <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-sm mb-0">
                    {{-- Previous Page Link --}}
                    @if ($reservations->onFirstPage())
                      <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                      </li>
                    @else
                      <li class="page-item">
                        <a class="page-link" href="{{ $reservations->previousPageUrl() }}" rel="prev">&laquo;</a>
                      </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($reservations->getUrlRange(1, $reservations->lastPage()) as $page => $url)
                      @if ($page == $reservations->currentPage())
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
                    @if ($reservations->hasMorePages())
                      <li class="page-item">
                        <a class="page-link" href="{{ $reservations->nextPageUrl() }}" rel="next">&raquo;</a>
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
                Showing {{ $reservations->firstItem() }} to {{ $reservations->lastItem() }} of {{ $reservations->total() }} results
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