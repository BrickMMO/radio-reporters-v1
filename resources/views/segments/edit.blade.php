@extends ('layout.console')

@section ('content')

<!-- these views arent in use, see segment_forms -->

<section class="w3-padding form-container">

    <h2>Edit Segment</h2>

    <form method="post" action="/console/segments/edit/{{$segment->id}}" novalidate class="w3-margin-bottom">

        @csrf

        <div class="w3-margin-bottom">
            <label for="title">Title:</label>
            <input type="title" name="title" id="title" value="{{old('title', $segment->title)}}" required>
            
            @if ($errors->first('title'))
                <br>
                <span class="w3-text-red">{{$errors->first('title')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom">
            <label for="segment_data">Segment Data:</label>
            <textarea name="segment_data" id="segment_data" required>{{old('segment_data', $segment->segment_data)}}  rows="5" cols="50"</textarea>

            @if ($errors->first('segment_data'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_data')}}</span>
            @endif
        </div>

            <!-- Segment Type -->
        <div class="w3-margin-bottom">
            <label for="segment_type_id">Segment Type:</label>
            <select name="segment_type_id" id="segment_type_id">
                <option></option>
                @foreach($segmentTypes as $segmentType)
                    <option value="{{$segmentType->id}}"
                        {{$segmentType->id == old('segment_type_id', $segment->segment_type_id) ? 'selected' : ''}}>
                        {{$segmentType->type_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('segment_type_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_type_id')}}</span>
            @endif
        </div>

        <!-- User -->
        <div class="w3-margin-bottom">
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id">
                <option></option>
                @foreach($users as $user)
                    <option value="{{$user->id}}"
                        {{$user->id == old('user_id', $segment->user_id) ? 'selected' : ''}}>
                        {{$user->first . " " . $user->last}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('user_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('user_id')}}</span>
            @endif
        </div>

        <!-- Internal System -->
        <div class="w3-margin-bottom">
            <label for="internal_system_id">Internal System:</label>
            <select name="internal_system_id" id="internal_system_id">
                <option></option>
                @foreach($internalSystems as $internalSystem)
                    <option value="{{$internalSystem->id}}"
                        {{$internalSystem->id == old('internal_system_id', $segment->internal_system_id) ? 'selected' : ''}}>
                        {{$internalSystem->system_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('internal_system_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('internal_system_id')}}</span>
            @endif
        </div>


        <button type="submit" class="w3-button w3-green">Edit Segment</button>

    </form>

    <a href="/console/segments/list">Back to Segment List</a>

</section>

@endsection
