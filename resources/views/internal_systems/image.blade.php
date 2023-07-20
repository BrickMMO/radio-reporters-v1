@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container">

    <h2>System Icon</h2>

    <div class="w3-margin-bottom">
        @if($internal_system->image)
            <img src="{{asset('storage/'.$internal_system->system_icon)}}" width="200">
        @endif
    </div>

    <form method="post" action="/console/internal_systems/image/{{$internal_system->id}}" novalidate class="w3-margin-bottom" enctype="multipart/form-data">

        @csrf

        <div class="w3-margin-bottom">
            <label for="system_icon">Icon:</label>
            <input type="file" name="system_icon" id="system_icon" value="{{old('system_icon')}}" required>
            
            @if ($errors->first('system_icon'))
                <br>
                <span class="w3-text-red">{{$errors->first('system_icon')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Icon</button>

    </form>

    <a href="/console/internal_systems/list">Back to Internal System List</a>

</section>

@endsection