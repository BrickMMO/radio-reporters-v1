@extends('layout.console')

@section('content')

<section class="w3-padding dashboard-list">
    <ul id="dashboard">
        @if(auth()->user()->role == 'Reporter')
            <li><a href="/console/segment_forms/list">Manage Segments</a></li>
        @else
            <!-- <li><a href="/console/segments/list">Manage Segments (Admin)</a></li> -->
            <li><a href="/console/segment_forms/list"> Manage Segments</a></li>
            <li><a href="/console/segment_types/list"> Manage Segment Types</a></li>
            <li><a href="/console/sub_segment_types/list"> Manage Sub-Segment Types</a></li>
            <li><a href="/console/segment_fields/list"> Manage Segment Fields</a></li>
            <li><a href="/console/users/list"> Manage Users</a></li>
            <li><a href="/console/internal_systems/list"> Manage Internal Systems</a></li>
            <li><a href="/console/hosts/list"> Manage Hosts</a></li>
        @endif
        <li><a href="/console/logout"> Log Out</a></li>
    </ul>
</section>

@endsection
