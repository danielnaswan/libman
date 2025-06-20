@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Reservations</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ number_format($stats['today_reservations']) }}
                  <span class="text-{{ $stats['reservation_growth'] >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                    {{ $stats['reservation_growth'] >= 0 ? '+' : '' }}{{ $stats['reservation_growth'] }}%
                  </span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
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
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Active Members</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ number_format($stats['active_members']) }}
                  <span class="text-{{ $stats['member_growth'] >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                    {{ $stats['member_growth'] >= 0 ? '+' : '' }}{{ $stats['member_growth'] }}%
                  </span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
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
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Books</p>
                <h5 class="font-weight-bolder mb-0">
                  {{ number_format($stats['total_books']) }}
                  <span class="text-{{ $stats['book_growth'] >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                    {{ $stats['book_growth'] >= 0 ? '+' : '' }}{{ $stats['book_growth'] }}%
                  </span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
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
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Fines</p>
                <h5 class="font-weight-bolder mb-0">
                  ${{ number_format($stats['total_fines'], 2) }}
                  <span class="text-{{ $stats['fine_growth'] >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                    {{ $stats['fine_growth'] >= 0 ? '+' : '' }}{{ $stats['fine_growth'] }}%
                  </span>
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
    <div class="col-lg-5 mb-lg-0 mb-4">
      <div class="card z-index-2">
        <div class="card-body p-3">
          <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
          <h6 class="ms-2 mt-4 mb-0">Library Activity</h6>
          <p class="text-sm ms-2">Monthly statistics overview</p>
          <div class="container border-radius-lg">
            <div class="row">
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Members</p>
                </div>
                <h4 class="font-weight-bolder">{{ number_format($stats['active_members']) }}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark" style="width: {{ min(($stats['active_members'] / max($stats['active_members'], 100)) * 100, 100) }}%" role="progressbar"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Books</p>
                </div>
                <h4 class="font-weight-bolder">{{ number_format($stats['total_books']) }}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark" style="width: {{ min(($stats['total_books'] / max($stats['total_books'], 100)) * 100, 100) }}%" role="progressbar"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Overdue</p>
                </div>
                <h4 class="font-weight-bolder">{{ $stats['overdue_reservations'] }}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark" style="width: {{ $stats['overdue_reservations'] > 0 ? min(($stats['overdue_reservations'] / max($stats['overdue_reservations'], 10)) * 100, 100) : 0 }}%" role="progressbar"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Fines</p>
                </div>
                <h4 class="font-weight-bolder">${{ number_format($stats['total_fines']) }}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark" style="width: {{ $stats['total_fines'] > 0 ? min(($stats['total_fines'] / max($stats['total_fines'], 1000)) * 100, 100) : 0 }}%" role="progressbar"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Monthly Overview</h6>
          <p class="text-sm">
            <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">Library activity trends</span> over time
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats Row -->
  <div class="row mt-4">
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-warning shadow mx-auto">
            <i class="ni ni-time-alarm text-lg opacity-10"></i>
          </div>
          <h5 class="mt-3">{{ $stats['overdue_reservations'] }}</h5>
          <p class="text-sm">Overdue Reservations</p>
          <a href="{{ route('admin.reservations.index') }}" class="btn btn-warning btn-sm">Manage</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-danger shadow mx-auto">
            <i class="ni ni-money-coins text-lg opacity-10"></i>
          </div>
          <h5 class="mt-3">{{ $stats['overdue_fines'] }}</h5>
          <p class="text-sm">Overdue Fines</p>
          <a href="{{ route('admin.fines.overdue') }}" class="btn btn-danger btn-sm">View</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card">
        <div class="card-body text-center">
          <div class="icon icon-shape icon-lg bg-gradient-success shadow mx-auto">
            <i class="ni ni-check-bold text-lg opacity-10"></i>
          </div>
          <h5 class="mt-3">{{ $stats['active_fines'] }}</h5>
          <p class="text-sm">Active Fines</p>
          <a href="{{ route('admin.fines.index') }}" class="btn btn-success btn-sm">Manage</a>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('dashboard')
  <script>
    window.onload = function() {
      // Chart data from backend
      const chartData = @json($chartData);
      
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: chartData.months,
          datasets: [{
            label: "Reservations",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: chartData.reservations,
            maxBarThickness: 6
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: Math.max(...chartData.reservations) + 10,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });

      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: chartData.months,
          datasets: [{
              label: "New Members",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: chartData.members,
              maxBarThickness: 6
            },
            {
              label: "New Books",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: chartData.books,
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush