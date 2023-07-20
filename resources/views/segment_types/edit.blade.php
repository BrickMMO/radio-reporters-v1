@extends('layout.console')

@section('content')

<section class="w3-padding form-container">

    <h2>Edit Segment Type</h2>

    <form method="post" action="/console/segment_types/edit/{{$segment_type->id}}" novalidate class="w3-margin-bottom">

        @csrf

        <div class="form-group">
            <label for="type_name" class="form-labels">Type Name:</label>
            <input type="text" name="type_name" id="type_name" value="{{old('type_name', $segment_type->type_name)}}" required>
            
            @if ($errors->first('type_name'))
                <br>
                <span class="w3-text-red">{{$errors->first('type_name')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Edit Segment Type</button>

    </form>

    <a href="/console/segment_types/list" class="w3-button orange-background">Back to Segment Type List</a>

</section>

@endsection
