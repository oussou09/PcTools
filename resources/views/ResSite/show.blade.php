@extends('ResSite.list')
@section('content')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="card">

    <div class="imgBox">
      <img src="{{$Vshow['imageUrl']}}" alt="mouse corsair" class="mouse">
    </div>

    <div class="contentBox">
        <h3>
            @if (strlen($Vshow['gameName']) > 50)
                {{ substr($Vshow['gameName'], 0, 50) }}...
            @else
                {{ $Vshow['gameName'] }}
            @endif
        </h3>
      <h2 class="price">{{$Vshow['price']}}<small> €</small></h2>
      <form class="buy" action="{{ route('cart.add',['productId' => $Vshow->id]) }}" method="POST">
        @csrf
        <button style="background: none; border: none; outline: none;" type="submit">Add to Cart</button>
    </form>
    </div>
    <div class="ProductActions" style="display: flex; flex-direction: row; flex-wrap: wrap;">

    @if (Auth::guard('user')->user()->isSeller() && Auth::guard('user')->user()->id === $Vshow['user_id'] )
        <div class="actions">
            <a href="{{route('product.edit',$Vshow['id'])}}"><button type="submit">edit</button></a>
            <form action="{{route('product.destroy',$Vshow['id'])}}" method="POST">
            @csrf
            @method('DELETE')
            <a href="#"><button type="submit" onclick="return confirm('Are you sure you want to delete {{$Vshow['gameName']}}?')">delete</button></a>
            </form>
        </div>
    @endif
    @if (Auth::guard('user')->check())
        @php
            $user = Auth::guard('user')->user();
        @endphp
    <form class="formlikes" method="POST" action="{{ route('product.StoreReaction', $Vshow->id) }}">
        @csrf
        <button type="submit" style="background: none; border: none;">
            @if ($user->likes->contains($Vshow->id))
                <img style="width: 30px; height: 30px;" src="{{ asset('images/like-svgrepo-com.svg') }}" alt="Dislike">
            @else
                <img style="width: 30px; height: 30px;" src="{{ asset('images/heart-like-favorite-svgrepo-com.svg') }}" alt="Like">
            @endif
        </button>
        @if ($Vshow->likedBy()->count() > 0)
        <span style="font-size: 30px; font-weight: 900; color: red;padding-left: 5px;">{{ $Vshow->likedBy()->count() }}</span>
        @endif
    </form>
    @endif


    </div>

</div>


@endsection
