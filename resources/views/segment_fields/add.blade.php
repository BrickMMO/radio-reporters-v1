@extends('layout.console')

@section('content')

<section class="w3-padding form-container">

    <h2>Add Segment Field</h2>

    <form method="post" action="/console/segment_fields/add" novalidate class="w3-margin-bottom">

        @csrf

        <div class="form-group">
            <label for="field_name" class="form-labels">Field Name:</label>
            <input type="text" name="field_name" id="field_name" value="{{old('field_name')}}" required>
            
            @if ($errors->first('field_name'))
                <br>
                <span class="w3-text-red">{{$errors->first('field_name')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="field_label" class="form-labels">Field Label:</label>
            <input type="text" name="field_label" id="field_label" value="{{old('field_label')}}" required>
            
            @if ($errors->first('field_label'))
                <br>
                <span class="w3-text-red">{{$errors->first('field_label')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="field_data_type" class="form-labels">Field Data Type:</label>
            <input type="text" name="field_data_type" id="field_data_type" value="{{old('field_data_type')}}" required>
            
            @if ($errors->first('field_data_type'))
                <br>
                <span class="w3-text-red">{{$errors->first('field_data_type')}}</span>
            @endif
        </div>
    
        <div class="form-group">
            <label for="segment_type_id" class="form-labels">Segment Type:</label>
            <select name="segment_type_id" id="segment_type_id">
                <option></option>
                @foreach ($segment_type_id as $segment_type)
                    <option value="{{$segment_type->id}}"
                        {{$segment_type->id == old('segment_type_id') ? 'selected' : ''}}>
                        {{$segment_type->type_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('segment_type_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_type_id')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Segment Field</button>

    </form>

    <a href="/console/segment_fields/list" class="w3-button orange-background">Back to Segment Fields</a>

</section>

@endsection
