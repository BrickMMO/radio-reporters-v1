@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container glass-effect">

    <h2 class="med-titles">Manage Segment Form Fields</h2>

    <table class="w3-table w3-margin-bottom">
        <tr class="table-top">
            <th>Field Name</th>
            <th>Field Label</th>
            <th>Field Data Type</th>
            <th>Segment Type Name</th>
            <!-- <th>Created</th> -->
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($segment_fields as $segment_field)
            <tr>       
                <td>{{$segment_field->field_name}}</td>  
                <td>{{$segment_field->field_label}}</td>  
                <td>{{$segment_field->field_data_type}}</td>  
                <td>{{$segment_field->segmentType->type_name}}</td>
                <td><a class="w3-button-no-marg orange-background" href="/console/segment_fields/edit/{{$segment_field->id}}">Edit</a></td>
                <td><a class="w3-button-no-marg red-background" href="/console/segment_fields/delete/{{$segment_field->id}}">Delete</a></td>
            </tr>
        @endforeach
    </table>

    <a href="/console/segment_fields/add" class="w3-padding form-container w3-button w3-green">New Segment Fields</a>

</section>

@endsection
