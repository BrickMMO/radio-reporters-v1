<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Brick MMO Radio Reporter</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{url('app.css')}}">
        <script src="{{url('app.js')}}"></script>
        
    </head>
    <body>

    <header class="w3-padding header">

    <h1 class="big-titles frontend-title"><span class="red-text">BRICK</span><span class="orange-text">MMO</span> <span class="med-weight"><em>Reporter</em></span></h1>

    <div class="nav">
     
        <span>
        <h3 class="w3-text-blue"><a href="/console/logout">Log Out</a> | <a href="/console/dashboard">Dashboard</a> | <a href="/">Home Page</a></h3>
        </span>
          
    </div>

    </header>

        <div class="console-login-name">

            @if (Auth::check())
                You are logged in as {{auth()->user()->first}} {{auth()->user()->last}}
            @else
                <a href="/">Return to My Reporter</a>
            @endif

        </div>

        <hr>

        @if (session()->has('message'))
            <div class="w3-padding w3-margin-top w3-margin-bottom">
                <div class="w3-red w3-center w3-padding">{{session()->get('message')}}</div>
            </div>
        @endif

        @yield ('content')

    </body>
</html>