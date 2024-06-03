<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- custom css link -->
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    @yield('style')
    <!-- google fonts link  -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>
<body>

    <div class="hero">
            <nav>
                <img src="{{ asset('css/admin/newlogo.png') }}" class="logo">
                <ul>
                    <li><a href="{{ route('home.home') }}">Home</a></li>
                    <li><a href="{{ route('home.about') }}">About</a></li>
                    <li><a href="{{ route('home.contact') }}">Contact</a></li>
                    @if (Auth::guard('user')->check())
                        <li><a href="{{ route('user.dashborduser') }}">dashboard</a></li>
                    @else
                        <li><a href="{{ route('user.loginuser') }}">Login</a></li>
                    @endif
                </ul>
            </nav>





        <div class="sectionone">

            @yield('content')

        </div>


    </div>

</body>
</html>
