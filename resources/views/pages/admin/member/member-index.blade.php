@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <h6>Members Management</h6>
              <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add New Member
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
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($members as $member)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $member->user->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $member->user->user_type ?? 'Member' }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ $member->user->email }}</p>
                      @if($member->user->phone)
                        <p class="text-xs text-secondary mb-0">{{ $member->user->phone }}</p>
                      @endif
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm {{ $member->getStatusBadgeClass() }}">
                        {{ ucfirst($member->status) }}
                      </span>
                    </td>
                    <td class="align-middle text-center text-s">
                      <span class="text-secondary text-xs font-weight-bold">{{ $member->created_at->format('d/m/Y') }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.members.show', $member) }}" class="text-info me-2" data-toggle="tooltip" title="View">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.members.edit', $member) }}" class="text-warning me-2" data-toggle="tooltip" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this member?')">
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
                        <i class="fa fa-users fa-3x mb-3 opacity-6"></i>
                        <p class="mb-0">No members found</p>
                        <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm mt-2">Add Your First Member</a>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            
            @if($members->hasPages())
            <div class="px-3 py-3">
              <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-sm mb-0">
                    {{-- Previous Page Link --}}
                    @if ($members->onFirstPage())
                      <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                      </li>
                    @else
                      <li class="page-item">
                        <a class="page-link" href="{{ $members->previousPageUrl() }}" rel="prev">&laquo;</a>
                      </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($members->getUrlRange(1, $members->lastPage()) as $page => $url)
                      @if ($page == $members->currentPage())
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
                    @if ($members->hasMorePages())
                      <li class="page-item">
                        <a class="page-link" href="{{ $members->nextPageUrl() }}" rel="next">&raquo;</a>
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
                Showing {{ $members->firstItem() }} to {{ $members->lastItem() }} of {{ $members->total() }} results
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