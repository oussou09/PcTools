@extends('users.AppUsers')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/profilestyle.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
@endsection

@section('title', 'Profile')

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
            <a class="active d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.profileuser',['id' => Auth::guard('user')->user()->id]) }}">
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
        <h1 class="p-relative">Profile</h1>
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
                  <span class="white-color">Full Name:</span>
                  <span class="c-white">{{ $user->name }}</span>
                </div>
                <div class="fs-14">
                  <span class="white-color">Gender:</span>
                  <span class="c-white">Null</span>
                </div>
                <div class="fs-14">
                  <span class="white-color">Country:</span>
                  <span class="c-white">Null</span>
                </div>
              </div>
              <!-- End Information Row -->
              <!-- Start Information Row -->
              <div class="box p-20 d-flex align-center">
                    <h4 class="white-color w-full fs-15 m-0">Personal Information</h4>
                    <div class="fs-14">
                        <span class="white-color">Email:</span>
                        <span class="c-white">{{ $user->email }}</span>
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
            </div>
          </div>
          <!-- End Overview -->
          <!-- Start Other Data -->
          <div class="other-data d-flex gap-20 rad-10">
            <div class="activities p-20 rad-10 mt-20">
              <h2 class="mt-0 mb-10">Latest Post I Like</h2>

                @foreach ($likedProducts as $likedProduct)

                    <div class="activity d-flex align-center txt-c-mobile">
                        <img src="{{ $likedProduct->imageUrl }}" alt="{{ $likedProduct->gameName }}" />
                        <div class="info">
                            <span class="d-block mb-10 white-color">{{ $likedProduct->price }}</span>
                            <span class="c-white">{{ $likedProduct->gameName }}</span>
                        </div>
                        <div class="date">
                            <span class="d-block mb-10 white-color">{{ $likedProduct->created_at->format('H:i') }}</span>
                            <span class="c-white">{{ $likedProduct->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                @endforeach

            </div>
          </div>
          <!-- End Other Data -->
        </div>
      </div>
    </div>

@endsection
