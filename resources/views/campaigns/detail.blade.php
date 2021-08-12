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
                        <div class="btn-group mr-2">
                            <a href="{{ route('campaign.edit',$campaign) }}" class="btn btn-sm btn-outline-secondary">Edit campaign</a>
                        </div>
                    </div>
                </div>
                <span class="h6">{{ date('F j, Y',strtotime($campaign->date)) }}</span>
            <div class="text-center">{{ session('message') }}</div>
            <!-- Tickets -->
            <div id="tickets" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Tickets</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('ticket.create',$campaign) }}" class="btn btn-sm btn-outline-secondary">
                                Create new ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row tickets">
                @foreach ($campaign->ticket as $ticket)
                <div class="col-md-4">

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->name }}</h5>
                            <p class="card-text">{{ $ticket->cost }}</p>
                            {{ $ticket->special() }}
                            {{-- {{ dd($ticket) }} --}}
                            <p class="card-text">{{ $ticket->description }}&nbsp;</p>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>

            <!-- Sessions -->
            <div id="sessions" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Sessions</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('session.create',$campaign) }}" class="btn btn-sm btn-outline-secondary">
                                Create new session
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive sessions">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Time</th>
                        <th>Type</th>
                        <th class="w-100">Title</th>
                        <th>Participant</th>
                        <th>Area</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($campaign->area as $area)
                     @foreach ($area->session as $session)
                    <tr>
                        <td class="text-nowrap">{{ date('H:i',strtotime($session->start)) }} - {{ date('H:i',strtotime($session->end)) }}</td>
                        <td>{{ $session->type }}</td>
                        <td><a href="{{ route('session.edit',[$campaign,$session]) }}">{{ $session->title }}</a></td>
                        <td class="text-nowrap">{{ $session->vaccinator }}</td>
                        <td class="text-nowrap">{{ $area->name  }} / {{ $session->place->name }}</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
                </table>
            </div>

            <!-- Areas -->
            <div id="channels" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Areas</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('area.create',$campaign) }}" class="btn btn-sm btn-outline-secondary">
                                Create new area
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row channels">
                @foreach ($campaign->area as $area)

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $area->name }}</h5>
                            <p class="card-text">{{ $area->session->count() }} session{{ $area->session->count()>1?'s':'' }}, {{ $area->place->count() }} place{{ $area->place->count()>1?'s':'' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Palces -->
            <div id="rooms" class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Places</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="{{ route('place.create',$campaign) }}" class="btn btn-sm btn-outline-secondary">
                                Create new place
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive rooms">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Capacity</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($campaign->place as $place)
                    <tr>
                        <td>{{ $place->name }}</td>
                        <td>{{ $place->capacity }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

@endsection
