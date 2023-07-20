@extends('layout.console')

@section('content')

<section class="w3-padding form-container">

    <h2>Edit User</h2>

    <form method="post" action="/console/users/edit/{{$user->id}}" novalidate class="w3-margin-bottom">

        @csrf

        <div class="form-group">
            <label for="first" class="form-labels">First Name:</label>
            <input type="text" name="first" id="first" value="{{old('first', $user->first)}}" required>
            
            @if ($errors->first('first'))
                <br>
                <span class="w3-text-red">{{$errors->first('first')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="last" class="form-labels">Last Name:</label>
            <input type="text" name="last" id="last" value="{{old('last', $user->last)}}" required>
            
            @if ($errors->first('last'))
                <br>
                <span class="w3-text-red">{{$errors->first('last')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="form-labels">Email:</label>
            <input type="email" name="email" id="email" value="{{old('email', $user->email)}}">

            @if ($errors->first('email'))
                <br>
                <span class="w3-text-red">{{$errors->first('email')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="password" class="form-labels">Password:</label>
            <input type="password" name="password" id="password">

            @if ($errors->first('password'))
                <br>
                <span class="w3-text-red">{{$errors->first('password')}}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="role" class="form-labels">Role:</label>
            <select name="role" id="role" required>
                <option value="">Select a role</option>
                <option value="Reporter" {{ old('role') == 'Reporter' || $user->role == 'Reporter' ? 'selected' : '' }}>Reporter</option>
                <option value="Producer" {{ old('role') == 'Producer' || $user->role == 'Producer' ? 'selected' : '' }}>Producer</option>
                <option value="Admin" {{ old('role') == 'Admin' || $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
            </select>

            @if ($errors->first('role'))
                <br>
                <span class="w3-text-red">{{$errors->first('role')}}</span>
            @endif
        </div>


        <button type="submit" class="w3-button w3-green">Edit User</button>

    </form>

    <a href="/console/users/list" class="w3-button orange-background">Back to User List</a>

</section>

@endsection
