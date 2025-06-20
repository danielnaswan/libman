@extends('layouts.app')

@section('auth')
    @if(auth()->user()->user_type === 'admin')
        @include('layouts.navbars.auth.sidebar')
    @else
        @include('layouts.navbars.member.sidebar')
    @endif
    
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        @include('layouts.navbars.auth.nav')
        <div class="container-fluid py-4">
            @yield('content')
            @include('layouts.footers.auth.footer')
        </div>
    </main>
    @include('components.fixed-plugin')
@endsection