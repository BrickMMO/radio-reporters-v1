@extends('layout.console')

@section('content')

<section class="w3-padding form-container">

    <h2>Edit Host</h2>

    <form method="post" action="/console/hosts/edit/{{$host->id}}" novalidate class="w3-margin-bottom">

        @csrf

        <div class="form-group">
            <label for="name" class="form-labels">Name:</label>
            <input type="text" name="name" id="name" value="{{old('name', $host->name)}}" required>

            @if ($errors->first('name'))
                <br>
                <span class="w3-text-red">{{$errors->first('name')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="gtts_name" class="form-labels">GTTS Name:</label>
            <input type="url" name="gtts_name" id="gtts_name" value="{{old('gtts_name', $host->gtts_name)}}">
            <br>
            <a href="https://cloud.google.com/text-to-speech/docs/voices" target="blank" alt="link to voices list">Click For List Of Voices.</a>
            @if ($errors->first('gtts_name'))
                <br>
                <span class="w3-text-red">{{$errors->first('gtts_name')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="personality" class="form-labels">Personality</label>
            <textarea name="personality" rows="5" cols="50">{{ old('personality', $host->personality ?: '') }}</textarea>

            @if ($errors->first('personality'))
                <br>
                <span class="w3-text-red">{{$errors->first('personality')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="bio" class="form-labels">Bio</label>
            <textarea name="bio" rows="5" cols="50">{{ old('bio', $host->bio ?: '') }}</textarea>

            @if ($errors->first('bio'))
                <br>
                <span class="w3-text-red">{{$errors->first('bio')}}</span>
            @endif
        </div>

        
    

        <button type="submit" class="w3-button w3-green">Edit Host</button>

    </form>

    <a href="/console/hosts/list" class="w3-button orange-background">Back to Hosts</a>

</section>

@endsection
