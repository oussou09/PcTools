
@extends('users.AppUsers')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/dashbordstyle.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/user/profilestyle.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet" />
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;900&display=swap"
        rel="stylesheet"/>
    <!-- Material Icon -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
@endsection

@section('title', 'Dashboard')

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
          <a class="active d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.profileuser',['id' => $user->id]) }}">
            <i class="fa-regular fa-user fa-fw"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a class="d-flex align-center fs-14 rad-6 p-10" href="{{ route('user.edituser',['id' => $user->id]) }}">
            <i class="fa-solid fa-gear fa-fw"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="content w-full" style="display: flex;flex-direction: column;justify-content: center;">
        <main>
            <h2 class="h2 article-title">Welcome to Dashboard!</h2>
            <article class="container article">
                <section class="home">
                    <div class="card profile-card" style="height: 70%;width: 40%;">

                        <div class="profile-card-wrapper">
                            <figure class="card-avatar">
                                <img src="https://randompicturegenerator.com/img/people-generator/g1f3229025c3d5bfe285df1d4bad25c71ec473af8e98d80bb634561616ccd9788e5486c896768a6c1b04aeafa2fae4746_640.jpg"
                                alt="Angela Ronaldo" width="48" height="48"/>
                            </figure>
                            <div>
                                <p class="card-title">{{ $user->name }}</p>
                                <p class="card-subtitle">
                                    @if ($user->account_type === 1)
                                        Seller
                                    @else
                                        Buyer
                                    @endif
                                </p>
                            </div>
                        </div>
                        <ul class="contact-list">
                            <li>
                                <a href="mailto:pranav@jrpanav.com"class="contact-link icon-box">
                                    <span class="material-symbols-rounded icon">mail</span>
                                    <p class="text">{{ $user->email }}</p>
                                </a>
                            </li>
                            <li>
                                <a href="tel:00123456789" class="contact-link icon-box">
                                    <span class="material-symbols-rounded icon">call</span>
                                    <p class="text">+Null</p>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-wrapper">
                        <a href="{{ route('product.ShowAllProductLiked', ['id' => $user->id]) }}">
                            <div class="card task-card">
                                <div class="card-icon icon-box green">
                                    <span class="material-symbols-rounded icon">task_alt</span>
                                </div>
                                <div>
                                    <data class="card-data" value="{{ $user->likes()->count() }}">
                                        {{ $user->likes()->count() }}
                                    </data>
                                    <p class="card-text">Liked Product</p>
                                </div>
                            </div>
                        </a>
                        @if ($user->isBuyer())
                            <a href="{{ route('cart.show',['id' => $user->id ]) }}">
                                <div class="card task-card">
                                    <div class="card-icon icon-box blue">
                                        <span class="material-symbols-rounded icon">drive_file_rename_outline</span>
                                    </div>

                                    <div>
                                        <data class="card-data" value="{{ $user->cart ? $user->cart->products()->count() : '0' }}">
                                            {{ $user->cart ? $user->cart->products()->count() : '0' }}
                                        </data>
                                        <p class="card-text">My Cart</p>
                                    </div>
                                </div>
                            </a>
                        @else
                        <a href="{{ route('product.myproduct', ['id' => $user->id]) }}">
                            <div class="card task-card">
                                <div class="card-icon icon-box blue">
                                    <span class="material-symbols-rounded icon">drive_file_rename_outline</span>
                                </div>

                                <div>
                                    <data class="card-data" value="{{ $user->products()->count() }}">{{ $user->products()->count() }}</data>
                                    <p class="card-text">My Products</p>
                                </div>
                            </div>
                        </a>
                        @endif
                    </div>
                </section>
            </article>
        </main>
    </div>
  </div>


@endsection
