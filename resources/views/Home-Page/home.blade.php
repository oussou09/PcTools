@extends('Home-Page.homeapp')

@section('content')

    @if(session('message'))
        <div style="text-align: center" class="alert alert-success">
            {!! session('message') !!}
        </div>
    @endif

    <div class="section">
        <div class="lamp-container">
            <img src="{{ asset('images/image-modern-RAM.png') }}"
            class="light" id="light">
        </div>

        <div class="text-container-v1">
            <h1>Premium <br> PC Tools Marketplace</h1>
            <p>Discover the ultimate selection of professional-grade PC tools tailored for demanding tasks and complex projects. Whether you're a developer or a graphic designer, our products meet the highest standards.</p>
            <a href="{{ route('product.index') }}">Start Shopping</a>
        </div>
    </div>
@endsection

