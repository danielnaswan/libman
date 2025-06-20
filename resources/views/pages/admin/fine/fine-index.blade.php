@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Fines</p>
                                <h5 class="font-weight-bolder mb-0">
                                    ${{ number_format($totalFines, 2) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Overdue Amount</p>
                                <h5 class="font-weight-bolder mb-0 text-danger">
                                    ${{ number_format($overdueFines, 2) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Fines</p>
                                <h5 class="font-weight-bolder mb-0 text-success">
                                    {{ $activeFines }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Overdue Count</p>
                                <h5 class="font-weight-bolder mb-0 text-warning">
                                    {{ $overdueCount }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow text-center border-radius-md">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Fines Management</h6>
              <div>
                <a href="{{ route('admin.fines.overdue') }}" class="btn btn-danger btn-sm me-2">
                    <i class="fas fa-exclamation-triangle"></i> Overdue
                </a>
                <a href="{{ route('admin.fines.due-soon') }}" class="btn btn-warning btn-sm me-2">
                    <i class="fas fa-clock"></i> Due Soon
                </a>
                <a href="{{ route('admin.fines.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add Fine
                </a>
              </div>
            </div>
          </div>
          
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Book/Reservation</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
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
                      <span class="text-secondary font-weight-bold">
                        {{ $fine->formatted_amount }}
                      </span>
                    </td>
                    <td class="align-middle text-center text-s">
                      <span class="text-secondary text-xs font-weight-bold">{{ $fine->due_date->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      @if($fine->isOverdue())
                          <span class="badge badge-sm bg-gradient-danger">Overdue</span>
                      @elseif($fine->getDaysUntilDue() <= 3)
                          <span class="badge badge-sm bg-gradient-warning">Due Soon</span>
                      @else
                          <span class="badge badge-sm bg-gradient-success">Active</span>
                      @endif
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.fines.show', $fine) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.fines.edit', $fine) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.fines.destroy', $fine) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this fine?')">
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
                        <i class="fa fa-money-bill-wave fa-3x mb-3 opacity-6"></i>
                        <p class="mb-0">No fines found</p>
                        <a href="{{ route('admin.fines.create') }}" class="btn btn-primary btn-sm mt-2">Add Your First Fine</a>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection