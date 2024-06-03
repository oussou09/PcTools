@extends('users.AppUsers')

@section('title', 'LOGIN')

@section('content')
<div class="main-login">
    <div class="left-login">
        <iframe style="height:50vh;width:40vw;border: none;" src="https://lottie.host/embed/7751e33a-7f7e-4a0a-af25-618bb001af07/YAwZzIUHeZ.json"></iframe>
    </div>

    <div class="right-login">
        <div class="card-login">
            <form action="{{route('user.loginusereque')}}" method="POST" class="card-loginform">
                @csrf
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <button class="btn-login">Login</button>
                <div class="btn-plus" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                    <span >You Don't have Account? </span><a style="margin-left:7px;text-decoration:none" href="{{ route('user.registeruser') }}" class="span-cadastre-se">Register-Now</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
