{{-- resources/views/admin/users/index.blade.php --}}

@extends('admin.adminBody')

@section('content')

<div class="container mx-auto px-4 py-8" style="display: flex;flex-direction: column;flex-wrap: nowrap;justify-content: center;align-items: center;gap: 200px;">

    <div class="container mx-auto px-4 py-8" style="text-align:center">
        @auth('admin')
            <h1>Hello {{ Auth::guard('admin')->user()->username }}</h1>  {{-- session('usernameinfo') --}}
        @else
            <h1>Hello Admin ..</h1>
        @endauth
    </div>

    <a style="color:black ;text-align: center;padding: 15px 30px;background-color: grey;text-decoration: none;font-size: medium;border: 3px solid black;border-radius: 7px;"
    href="{{route('admin.listusers')}}"> Show All Users </a>
</div>

@endsection
