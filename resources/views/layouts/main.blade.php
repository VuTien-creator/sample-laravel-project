@extends('layouts.header')
@section('header')
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route('campaign.index') }}">Manage Campaigns</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>{{ $campaign->name }}</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('campaign.show',$campaign) }}">Overview</a></li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('place.index',$campaign) }}">Palce capacity</a></li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2 event-title">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{ $campaign->organizer->name }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">

                    </div>
                </div>
                <span class="h6">{{ date('F j, Y',strtotime($campaign->date)) }}</span>
                @yield('main')
            </div>
        </main>
    </div>
</div>
@endsection
