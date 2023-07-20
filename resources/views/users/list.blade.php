@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container glass-effect">

    <h2 class="med-titles">Manage Users</h2>

    <table class="w3-table w3-margin-bottom">
        <tr class="table-top">
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($users as $user): ?>
            <tr>
                <td>{{$user->first}} {{$user->last}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->created_at->format('M j, Y')}}</td>
                <td><a class="w3-button-no-marg orange-background" href="/console/users/edit/{{$user->id}}">Edit</a></td>
                <td><a class="w3-button-no-marg red-background" href="/console/users/delete/{{$user->id}}">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="/console/users/add" class="w3-padding form-container w3-button w3-green">New User</a>

</section>

@endsection
