@extends('layout.console')

@section('content')
<section class="w3-padding form-container">

    <h2>Add Internal System</h2>

    <form method="post" action="/console/internal_systems/add" novalidate class="w3-margin-bottom">

        @csrf

        <div class="w3-margin-bottom form-group">
            <label for="system_name" class="form-labels">System Name:</label>
            <input type="text" name="system_name" id="system_name" value="{{old('system_name')}}" required>
            
            @if ($errors->first('system_name'))
                <br>
                <span class="w3-text-red">{{$errors->first('system_name')}}</span>
            @endif
        </div>

        <div class="w3-margin-bottom form-group">
            <label for="request_api_url" class="form-labels">API Request URL:</label>
            <input type="url" name="request_api_url" id="request_api_url" value="{{old('request_api_url')}}">

            @if ($errors->first('request_api_url'))
                <br>
                <span class="w3-text-red">{{$errors->first('request_api_url')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Internal System</button>

    </form>

    <a href="/console/internal_systems/list" class="w3-button orange-background">Back to Internal Systems</a>

</section>

@endsection
