@extends('layout.console')

@section('content')

<section class="w3-padding">
    <h2 class="crud-titles">Register Reporter</h2>

    <form method="post" action="/console/reporter/add" novalidate class="w3-margin-bottom">

        @csrf

        <div class="w3-margin-bottom">
            <label for="first">First Name:</label>
            <input type="text" name="first" id="first" value="{{ old('first') }}" required>
            @error('first')
                <br>
                <span class="w3-text-red">{{ $message }}</span>
            @enderror
        </div>

        <div class="w3-margin-bottom">
            <label for="last">Last Name:</label>
            <input type="text" name="last" id="last" value="{{ old('last') }}" required>
            @error('last')
                <br>
                <span class="w3-text-red">{{ $message }}</span>
            @enderror
        </div>

        <div class="w3-margin-bottom">
            <label for="email">Email:</label>
           
            <input type="email" name="email" id="email" value="{{ old('email') }}" required pattern="/^[a-zA-Z0-9._%+-]+@humbermail\.ca$/" title="Only valid Humber email addresses are allowed">
            <br>
            <p class="w3-text-red">Reporters must register with a valid humbermail.ca email account</p>
            @error('email')
                <br>
                <span class="w3-text-red">{{ $message }}</span>
            @enderror
        </div>

        <div class="w3-margin-bottom">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @error('password')
                <br>
                <span class="w3-text-red">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" name="role" value="Reporter">

        <button type="submit" class="w3-button w3-green">Register Reporter</button>
    </form>

    <a href="/">Back to Home Page</a>
</section>

@endsection
