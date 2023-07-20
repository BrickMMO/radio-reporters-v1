<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MY REPORTER | {{$title}}    </title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="{{url('app.css')}}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <script src="{{url('app.js')}}"></script>

    <script src="{{url('app.js')}}"></script>
    
</head>
<body class="w3-padding">

<header class="w3-padding header">

    <h1 class="big-titles frontend-title"><span class="red-text">BRICK</span><span class="orange-text">MMO</span> <span class="med-weight"><i>Reporter</i></span></h1>

    <div class="nav">
        <p class="user-name-display">
        @if (Auth::check())
        You are logged in as {{auth()->user()->first}} {{auth()->user()->last}}
        </p>
   
        <span>
        <h3 class="w3-text-blue"><a href="/console/logout">Log Out</a> | <a href="/console/dashboard">Dashboard</a></h3>
        </span>
         
    @else
        <span>
        <h3 class="w3-text-blue"><a href="/console/reporter_reg">Register</a> | <a href="/console/login">Login</a></h3>
        </span>
  
       
        
    @endif  

    </div>

</header>

<hr>

@yield('content')



<footer class="w3-padding">

    @if (Auth::check())
        You are logged in as {{auth()->user()->first}} {{auth()->user()->last}}  
        <span>
        <h2 class="w3-text-blue"><a href="/console/logout">Log Out</a> | <a href="/console/dashboard">Dashboard</a></h2>
        </span>
         
    @else
        <span>
        <h2 class="w3-text-blue"><a href="/console/reporter_reg">Register</a> | <a href="/console/login">Login</a></h2>
        </span>
  
       
        
    @endif    

    Copyright {{date('Y')}}
    <!-- <a href="#">Facebook</a> | 
    <a href="#">Instagram</a> -->

    <br>



</footer>

</body>
</html>