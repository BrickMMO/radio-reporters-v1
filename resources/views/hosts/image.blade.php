@extends ('layout.console')

@section ('content')

<section class="w3-padding form-container">

    <h2>Host</h2>

    <div class="w3-margin-bottom">
        @if($host->image)
            <img src="{{asset('storage/'.$host->profile_pic)}}" width="200">
        @endif
    </div>

    <form method="post" action="/console/hosts/image/{{$host->id}}" novalidate class="w3-margin-bottom" enctype="multipart/form-data">

        @csrf

        <div class="w3-margin-bottom">
            <label for="profile_pic">Profile Pic</label>
            <input type="file" name="profile_pic" id="profile_pic" value="{{old('profile_pic')}}" required>
            
            @if ($errors->first('profile_pic'))
                <br>
                <span class="w3-text-red">{{$errors->first('profile_pic')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Profile Pic</button>

    </form>

    <a href="/console/hosts/list">Back to Hosts</a>

</section>

@endsection