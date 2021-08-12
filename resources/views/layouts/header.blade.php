@extends('layouts.app')
@section('app')
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ route('campaign.index') }}">CVC Platform</a>
    <span class="navbar-organizer w-100">{{ Auth::user()->name }}</span>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" id="logout" href="{{ route('out') }}">Sign out</a>
        </li>
    </ul>
</nav>
@yield('header')
@endsection
