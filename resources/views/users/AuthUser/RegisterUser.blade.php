@extends('users.AppUsers')

@section('title', 'Register')

@section('content')
<div class="main-login">
    <div class="left-login">
        <iframe style="height:50vh;width:40vw;border: none;" src="https://lottie.host/embed/7751e33a-7f7e-4a0a-af25-618bb001af07/YAwZzIUHeZ.json"></iframe>
    </div>

    <div class="right-login">
        <div class="card-login">
            <form action="{{route('user.storeuser')}}" method="POST" class="card-loginform">
                @csrf
                <h1>Register</h1>
                <div class="textfield">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="as">Role: As a?</label>
                    <select id="as" name="account_type">
                        <option value="0">Buyer</option>
                        <option value="1">Seller</option>
                    </select>
                </div>
                <div class="textfield">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <button class="btn-login" type="submit">Submit</button>
                <div class="btn-plus" style="display: flex; flex-direction: row; align-items: center; justify-content: center;">
                    <span >You Already have Account? </span><a  style="margin-left:7px;text-decoration:none" href="{{ route('user.loginuser') }}" class="span-cadastre-se">Login-Now</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
