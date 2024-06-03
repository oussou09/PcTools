@extends('ResSite.cart.AppCart')

@section('style')
<style>
/* Container */
.container {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    max-width: 80%; /* Adjust based on your layout's max width */
}

/* Utility styles */
.h-100 { height: 100%; }
.py-5 { padding-top: 3rem; padding-bottom: 3rem; }
.px-2 { padding-left: 0.5rem; padding-right: 0.5rem; }
.mb-0 { margin-bottom: 0; }
.mb-5 { margin-bottom: 3rem; }
.my-4 { margin-top: 1.5rem; margin-bottom: 1.5rem; }

/* Row and Column Grid System */
.row {
    display: flex;
    margin: -30px;

}

/* For simplification, assuming each col-** class denotes a full-width column at different breakpoints */
.col-12, .col-lg-8, .col-lg-4, .col-md-2, .col-md-3, .col-lg-3, .col-xl-2, .col-xl-3, .col-md-1 {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

/* Cards */
.card {
    background-color: #fff;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 15px;
}

.card-body {
    padding: 2rem;
}

/* Buttons */
.btn {
    background: #949494;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1.5rem;
    line-height: 1.7;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
     border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

}

.btn-link {
    color: #007bff;
    background-color: transparent;
    text-decoration: none;
}

.text-end {
    text-align: right;
}

/* Background colors */
.bg-grey { background-color: #eae8e8; }

/* Image responsiveness */
.img-fluid {
    max-width: 100%;
    height: auto;
}

.rounded-3 { border-radius: 0.3rem; }

/* Custom styles for specific uses */
.h-custom { height: 100vh; }

@media (min-width: 1025px) {
    .h-custom {
        height: 100vh; /* 100% of the viewport height */
    }
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
</style>
@endsection

@section('content')

@php
    $user = Auth::guard('user')->user();
@endphp

<section>
    <div class="container py-5 h-100" style="font-size: 18px">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8" style="margin: 15px 15px;">
                                <div style=" display: flex; flex-direction: column; gap: 10px; " class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted">{{ $CartItems->count() }} items</h6>
                                    </div>

                                    @foreach ($CartItems as $CartItem)


                                    <div style=" display: flex; align-items: center; " class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img style="width: 60px;height: 60px" src="{{ $CartItem->imageUrl ? $CartItem->imageUrl : assrt('images/no-image-icon-23494.png') }}"
                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h6 class="text-black mb-0">{{ $CartItem->gameName }}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex" style="display: flex;flex-direction: row;align-items: center;justify-content: center;">
                                            <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="0" name="quantity" value="1" type="number"
                                                class="form-control form-control-sm"
                                                style=" height: 60px; width: 60px; text-align: center; font-size: 30px; padding: 0px;"/>

                                            <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">€ {{ $CartItem->price }}</h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <form action="{{ route('cart.delete', ['productId' => $CartItem->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none; color: #007bff; font-size: xx-large;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <hr style="margin-top: 1.5rem;margin-bottom: 2.5rem;" >

                                    @endforeach

                                </div>
                            </div>
                            <div class="col-lg-4 bg-grey" style="border-radius: 0px 10px 10px 0px;border-left: 9px solid #62626282;padding-top: 15px;padding-bottom: 15px;width: 60%;">
                                <div style="font-size: 25px" class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items {{ $CartItems->count() }}</h5>
                                    </div>

                                    <h5 class="text-uppercase mb-3">Give Coupon Code</h5>

                                    <div class="mb-5">
                                        <input style=" height: 40px; width: 60%; border: solid 2px;font-size: x-large;" type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        @if($user->cart && !$user->cart->products->isEmpty())
                                            <h5>€ {{ $user->cart->products->first()->pivot->total_price }}</h5>
                                        @else
                                            <h5>€ 0.00</h5>
                                        @endif
                                    </div>

                                    <button style="cursor: pointer;" onclick="alert('Enter Card')" class="btn btn-dark btn-block btn-lg">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 20px" class="pt-5">
                    <h3 class="mb-0"><a style="text-decoration: none;color: white" href="javascript:history.back()" class="text-body">
                        <i style="padding-right: 5px" class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
