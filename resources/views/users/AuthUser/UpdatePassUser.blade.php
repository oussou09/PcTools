
@extends('users.AppUsers')

@section('title', 'Update Password')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profilestyle.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
@endsection

@section('content')


<div class="page d-flex">
    <div class="sidebar p-20 p-relative">
        <ul>
          <li>
            <a class="d-flex align-center fs-14 rad-6 p-10" href="index.html">
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
            <a class="d-flex align-center fs-14 rad-6 p-10" href="courses.html">
              <i class="fa-solid fa-graduation-cap fa-fw"></i>
              <span>My Cart</span>
            </a>
          </li>
        </ul>
    </div>

    <div class="content w-full">
        <h1 class="p-relative">Update Password</h1>
        <form action="{{ route('user.updatepassusereq',['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="profile-page m-20">
                <div class="overview mb-20 rad-10 d-flex align-center">
                    <div class="avatar-box txt-c p-20">
                        <img class="rad-half mb-10" src="https://randompicturegenerator.com/img/people-generator/g1f3229025c3d5bfe285df1d4bad25c71ec473af8e98d80bb634561616ccd9788e5486c896768a6c1b04aeafa2fae4746_640.jpg" alt="" />
                        <h3 class="m-0 white-color">{{ $user->name }}</h3>
                        <p class="c-white mt-10"> ... </p>
                    </div>
                    <div class="info-box w-full txt-c-mobile">
                    <!-- Start Old Password Row -->
                        <div style="flex-direction: column;align-items: baseline;" class="box p-20 d-flex align-center">
                            <h2>Hello <span class="span-cadastre-se">{{ $user->name }}</span></h2>
                            <div class="myprofile">
                                <h2 style="margin-left: 15px">Update Your Password</h2>
                            </div>
                        </div>
                    <!-- End Old Password Row -->
                    <!-- Start Old Password Row -->
                    <div class="box p-20 d-flex align-center flex-column align-items-baseline">
                        <div class="myprofile">
                            <label class="labelstyle" for="oldpassword">Old Password :</label>
                            <input class="inputstyle" type="password" name="oldpassword" id="oldpassword" required minlength="10">
                        </div>
                        <br>
                        @if ($errors->has('oldpassword'))
                            <div class="error-message">{{ $errors->first('oldpassword') }}</div>
                        @endif
                    </div>
                    <!-- End Old Password Row -->
                    <!-- Start New Password Row -->
                    <div class="box p-20 d-flex align-center flex-column align-items-baseline">
                        <div class="myprofile">
                            <label class="labelstyle" for="newpassword">New Password:</label>
                            <input class="inputstyle" type="password" name="newpassword" id="newpassword" required minlength="10">
                        </div>
                        <br>
                        @if ($errors->has('newpassword'))
                            <div style="display: block" class="error-message">{{ $errors->first('newpassword') }}</div>
                        @endif
                    </div>
                    <!-- End New Password Row -->
                    <!-- Start New Password Row -->
                    <div class="box p-20 d-flex align-center flex-column align-items-baseline">
                        <div class="myprofile">
                            <label class="labelstyle" for="newpassword_confirmation">Confirm New Password :</label>
                            <input class="inputstyle" type="password" name="newpassword_confirmation" id="newpassword_confirmation" required minlength="10">
                        </div>
                        <br>
                        @if ($errors->has('newpassword_confirmation'))
                            <div class="error-message">{{ $errors->first('newpassword_confirmation') }}</div>
                        @endif
                    </div>
                    <!-- End New Password Row -->
                    </div>
                    <!-- End Overview -->
                </div>
                <button style="width: -webkit-fill-available" class="btn-login" type="submit">Submit</button>
                <div class="overview mb-20 rad-10 d-flex align-center">
                    <div class="box p-20 d-flex align-center flex-column align-items-baseline">
                            <h1 style="text-align: center;margin: 20px 20px 20px;">Update Password By Email Is Coming Soon</h1>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
