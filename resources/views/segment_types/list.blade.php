@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container glass-effect">

    <h2 class="med-titles">Manage Segment Types</h2>

    <table class="w3-table w3-margin-bottom">
        <tr class="table-top">
            <th>Name</th>
            <th>ID</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($segment_types as $segment_type): ?>
            <tr>
                <td>{{$segment_type->type_name}}</td>
                <td>{{$segment_type->id}}</td>
                <td><a class="w3-button-no-marg orange-background" href="/console/segment_types/edit/{{$segment_type->id}}">Edit</a></td>
                <td><a class="w3-button-no-marg red-background" href="/console/segment_types/delete/{{$segment_type->id}}">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="/console/segment_types/add" class="w3-padding form-container w3-button w3-green">New Segment Type</a>

</section>

@endsection