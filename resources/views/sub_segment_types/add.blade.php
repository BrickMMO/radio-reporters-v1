@extends('layout.console')

@section('content')

<section class="w3-padding form-container">

    <h2>Add Sub-Segment Type</h2>

    <form method="post" action="/console/sub_segment_types/add" novalidate class="w3-margin-bottom">

        @csrf

        <div class="form-group">
            <label for="sub_segment_name" class="form-labels">Sub-Segment Name:</label>
            <input type="text" name="sub_segment_name" id="sub_segment_name" value="{{old('sub_segment_name')}}" required>
            
            @if ($errors->first('sub_segment_name'))
                <br>
                <span class="w3-text-red">{{$errors->first('sub_segment_name')}}</span>
            @endif
        </div>
    
        <div class="form-group">
            <label for="segment_type_id" class="form-labels">Segment Type:</label>
            <select name="segment_type_id" id="segment_type_id">
                <option></option>
                @foreach ($segment_type_id as $segmentType)
                    <option value="{{$segmentType->id}}"
                        {{$segmentType->id == old('segment_type_id') ? 'selected' : ''}}>
                        {{$segmentType->type_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('segment_type_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_type_id')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Sub-Segment Type</button>

    </form>

    <a href="/console/sub_segment_types/list" class="w3-button orange-background">Back to Sub-Segment Types</a>

</section>

@endsection
