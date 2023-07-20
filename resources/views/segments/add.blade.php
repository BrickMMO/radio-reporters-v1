@extends ('layout.console')

@section ('content')

<!-- these views arent in use, see segment_forms -->

<section class="w3-padding form-container">

    <h2>Add Segment</h2>

    <form method="post" action="/console/segments/add" novalidate class="w3-margin-bottom">

        @csrf

        <div class="w3-margin-bottom">
            <label for="title">Title:</label>
            <input type="title" name="title" id="title" value="{{old('title')}}" required>
            
            @if ($errors->first('title'))
                <br>
                <span class="w3-text-red">{{$errors->first('title')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom">
            <label for="segment_data">Segment Data:</label>
            <textarea name="segment_data" id="segment_data" rows="5" cols="50"></textarea>

            @if ($errors->first('segment_data'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_data')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom">
            <label for="segment_type_id">Segment Type:</label>
            <select name="segment_type_id" id="segment_type_id">
                <option></option>
                @foreach ($segment_type_id as $segment_type_id)
                    <option value="{{$segment_type_id->id}}"
                        {{$segment_type_id->id == old('segment_type_id') ? 'selected' : ''}}>
                        {{$segment_type_id->type_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('segment_type_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('segment_type_id')}}</span>
            @endif
        </div>


        <div class="w3-margin-bottom">
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id">
                <option></option>
                @foreach ($user_id as $user_id)
                    <option value="{{$user_id->id}}"
                        {{$user_id->id == old('user_id') ? 'selected' : ''}}>
                        {{$user_id->first . ' ' . $user_id->last}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('user_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('user_id')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom">
            <label for="internal_system_id">Internal System:</label>
            <select name="internal_system_id" id="internal_system_id">
                <option></option>
                @foreach ($internal_system_id as $internal_system_id)
                    <option value="{{$internal_system_id->id}}"
                        {{$internal_system_id->id == old('internal_system_id') ? 'selected' : ''}}>
                        {{$internal_system_id->system_name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->first('internal_system_id'))
                <br>
                <span class="w3-text-red">{{$errors->first('internal_system_id')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Segment</button>

    </form>

    <a href="/console/segments/list">Back to Segment List</a>

</section>

@endsection