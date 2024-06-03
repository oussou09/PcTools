

@extends('admin.adminBody')

@section('content')
    
<div id="mainsection">
    <div id="section0">
        <div class="logo">
            <img src="{{asset('css/admin/newlogo.png')}}">
        </div>
    </div>
    <div class="SessionInfo">
        @if (session('LogoutSuccess'))
            <h1 class="alert alert-success">{{ session('LogoutSuccess') }}</h1>
            {{ session()->forget('LogoutSuccess') }}
        @endif
    </div>
    <div id="section1">
        <div class="login-block">
            <h1>Admin Login</h1>
            <form action="{{route('admin.loginAdminRequ')}}" method="POST">
                @csrf
                <input type="text" placeholder="Username" id="username" name="username"/>
                <input type="password" placeholder="Password" id="password" name="password"/>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <div id="section3">
         <div class="container">
                <div class="row">
                    <div class="col-lg-12" style="margin-top:3px;" >
                    <div class="col-lg-6">
                        <ul class="list-inline">
                            <li>
                                <a href="#">About us</a>
                            </li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li>
                                <a href="#about">Request a Quote</a>
                            </li>
                            <li class="footer-menu-divider">&sdot;</li>
                            <li>
                                <a href="#projects">Privacy Policy</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="col-lg-6" >
                        <span style="float:right" class="copyright text-muted small">&copy; Copyright 2024 &copy; PCTOOLS. All Rights Reserved</span>
                    </div>
                        
                        
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
