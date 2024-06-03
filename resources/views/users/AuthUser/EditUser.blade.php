@extends('users.AppUsers')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profilestyle.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
@endsection

@section('title', 'Settings')

@section('content')


    <div class="page d-flex">
      <div class="sidebar p-20 p-relative">
        <ul>
          <li>
            <a class="d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.dashborduser') }}">
              <i class="fa-regular fa-chart-bar fa-fw"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a class="active d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.profileuser',['id' => Auth::guard('user')->user()->id])}}">
              <i class="fa-regular fa-user fa-fw"></i>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <a class="d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.edituser',['id' => Auth::guard('user')->user()->id]) }}">
              <i class="fa-solid fa-gear fa-fw"></i>
              <span>Settings</span>
            </a>
          </li>
          <li>
            <a class="d-flex align-center fs-14 rad-6 p-10" href="#">
              <i class="fa-solid fa-graduation-cap fa-fw"></i>
              <span>My Cart</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="content w-full">
        <h1 class="p-relative">Edit Profile</h1>
        <form action="{{ route('user.updateuser',$user->id) }}" method="POST">{{-- {{route('user.updateuser')}} --}}
            @csrf
            @method('PUT')
            <div class="profile-page m-20">
            <!-- Start Overview -->
                <div class="overview mb-20 rad-10 d-flex align-center">
                    <div class="avatar-box txt-c p-20">
                    <img class="rad-half mb-10" src="https://randompicturegenerator.com/img/people-generator/g1f3229025c3d5bfe285df1d4bad25c71ec473af8e98d80bb634561616ccd9788e5486c896768a6c1b04aeafa2fae4746_640.jpg" alt="" />
                    <h3 class="m-0 white-color">{{ $user->name }}</h3>
                    <p class="c-white mt-10"> ... </p>
                    </div>
                    <div class="info-box w-full txt-c-mobile">
                    <!-- Start Information Row -->
                    <div class="box p-20 d-flex align-center">
                        <h4 class="white-color fs-15 m-0 w-full">General Information</h4>
                        <div class="fs-14">
                        <label for="username">Username</label>
                        <input style="background: #ffffffe3;font-size: 20px;padding: 3px 2px 3px 10px;width: 300px;height: 30px;border-radius: 5px;border: none;margin: 7px 15px 3px 10px;" type="text" name="username" value="{{ $user->name }}" placeholder="Username">
                        </div>
                    </div>
                    <!-- End Information Row -->
                    <!-- Start Information Row -->
                    <div class="box p-20 d-flex align-center">
                            <h4 class="white-color w-full fs-15 m-0">Personal Information</h4>
                            <div class="fs-14">
                                <label for="email">Email</label>
                                <input style="background: #ffffffe3;font-size: 20px;padding: 3px 2px 3px 10px;width: 300px;height: 30px;border-radius: 5px;border: none;margin: 7px 15px 3px 10px;" type="text" name="email" value="{{ $user->email }}" placeholder="Email">
                            </div>
                            <div class="fs-14">
                                <span class="white-color">Phone:</span>
                                <span class="c-white">Null</span>
                            </div>
                    </div>
                    <!-- End Information Row -->
                    <!-- Start Information Row -->
                    <div class="box p-20 d-flex align-center">
                            <h4 class="white-color w-full fs-15 m-0">Job Information</h4>
                            <div class="fs-14">
                            <span class="white-color">Type Of Account:</span>
                            <span class="c-white">
                                @if ($user->account_type === 1)
                                Seller
                            @else
                                Buyer
                            @endif
                            </span>
                            </div>
                            <div class="fs-14">
                            <span class="white-color">How Many . :</span>
                            <span class="c-white"> ... </span>
                            </div>
                    </div>
                    <!-- End Information Row -->
                        <!-- Start Update Password -->
                        <div class="box p-20 d-flex align-center">
                            <h4 class="white-color w-full fs-15 m-0">Update Password</h4>
                            <div class="fs-14">
                                <span >Update Your Password? </span><a href="{{ route('user.updatepassuser', ['id' => $user->id]) }}" class="span-cadastre-se">Update-Now</a>
                            </div>
                        </div>
                        <!-- End Update Password -->
                    </div>
                </div>
                <!-- End Overview -->
                <button style="width: -webkit-fill-available" class="btn-login" type="submit">Submit</button>
            </div>
        </form>
      </div>
    </div>
@endsection
