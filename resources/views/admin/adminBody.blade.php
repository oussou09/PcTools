<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/admin/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome CDN -->
    <title>Admin Web Page</title>
</head>
<body>
    <nav>
        <main>
            <header>
                <img class="HeaderAdminImg" src="{{asset('css/admin/newlogo.png')}}" alt="logo" />
                <i class="fa fa-bars" aria-hidden="true"></i>
            </header>
            <ul class="menu">
                <li><a href="{{ route('admin.homeadmin') }}" style="font-size: 20px;letter-spacing: 3px;">Home</a></li>
                @if (auth()->guard('admin')->check())
                    <li><a href="{{ route('admin.listusers') }}" style="font-size: 20px;letter-spacing: 3px;">List Users</a></li>
                    <li><a href="{{ route('admin.listcontact') }}" style="font-size: 20px;letter-spacing: 3px;">Messages Center</a></li>
                    <li>
                        <form action="{{ route('admin.logoutAdmin') }}" method="post">
                            @csrf
                            <button class="logoutadmin" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('admin.loginAdmin') }}" style="font-size: 20px; letter-spacing: 3px;">Log-in</a></li>
                @endif
            </ul>
        </main>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{asset('css/admin/jquery-1.11.3.min.js')}}"></script>
    <script src="{{asset('css/admin/bootstrap.min.js')}}"></script>
    <script>
        "use strict";
        const bar = document.querySelector(".fa-bars");
        const menu = document.querySelector(".menu");
        const showMenu = bar.addEventListener("click", () =>
            menu.classList.toggle("show-menu")
        );
    </script>
</body>
</html>
