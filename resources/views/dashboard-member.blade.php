@extends('layouts.user_type.member')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Reservations</p>
                            <h5 class="font-weight-bolder mb-0">{{ $activeReservations }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="ni ni-calendar-grid-58 text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Reservations</p>
                            <h5 class="font-weight-bolder mb-0">{{ $totalReservations }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-books text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Account Status</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span class="badge {{ $member->getStatusBadgeClass() }}">
                                    {{ ucfirst($member->status) }}
                                </span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="ni ni-single-02 text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Remaining Slots</p>
                            <h5 class="font-weight-bolder mb-0">{{ 3 - $activeReservations }}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="ni ni-collection text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card h-100 p-3">
            <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
                <span class="mask bg-gradient-dark"></span>
                <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                    <h5 class="text-white font-weight-bolder mb-4 pt-2">Membaca Jambatan Ilmu</h5>
                    <p class="text-white">أَفْضَلُ عِبَادَةِ أُمَّتِي قِرَاءَةُ الْقُرْآنِ<br/>Maksudnya :" Sebaik-baik ibadat umatku adalah membaca al-Quran.<br/>Riwayat al-Baihaqi (1865) di dalam Syu'ab al-Iman"</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>My Active Reservations</h6>
                <p class="text-sm">
                    <i class="ni ni-books text-primary"></i>
                    <span class="font-weight-bold">Your current book reservations</span>
                </p>
            </div>
            <div class="card-body p-3">
                @if($myReservations->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Book</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Reserved Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Due Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myReservations as $reservation)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $reservation->book->title }}</h6>
                                                <p class="text-xs text-secondary mb-0">by {{ $reservation->book->author }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->created_at->format('M d, Y') }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $reservation->reserved_until->format('M d, Y') }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($reservation->isExpired())
                                            <span class="badge badge-sm bg-gradient-danger">Expired</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if(!$reservation->isExpired())
                                            <form action="{{ route('member.reservations.cancel', $reservation) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="ni ni-books" style="font-size: 48px; color: #ccc;"></i>
                        <h5 class="text-muted mt-2">No Active Reservations</h5>
                        <p class="text-muted">You don't have any active book reservations at the moment.</p>
                        <a href="{{ route('member.books') }}" class="btn bg-gradient-primary">Browse Books</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection