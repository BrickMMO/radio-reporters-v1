@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container glass-effect">

    <h2 class="med-titles">Manage Hosts</h2>

    <table class="w3-table w3-margin-bottom">
        <tr class="table-top">
            <th></th>
            <th>Name</th>
            <th>GTTS Name</th>
            <th>Personality</th>
            <th>Bio</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($hosts as $host)
            <tr>
                <td>
                    @if ($host->profile_pic)
                        <img src="{{asset('storage/'.$host->profile_pic)}}" width="200">
                    @endif
                </td>
                <td>{{$host->name}}</td>
                <td>{{$host->gtts_name}}</td>
                <td class="host-personality">
                    <div class="content">
                        {{$host->personality}}
                    </div>
                </td>

                <td>{{$host->bio}}</td>
                <td><a class="w3-button-no-marg w3-green" href="/console/hosts/image/{{$host->id}}">Image</a></td>
                <td><a class="w3-button-no-marg orange-background" href="/console/hosts/edit/{{$host->id}}">Edit</a></td>
                <td><a class="w3-button-no-marg red-background" href="/console/hosts/delete/{{$host->id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <a href="/console/hosts/add" class="w3-padding form-container w3-button w3-green">New Host</a>

</section>

@endsection