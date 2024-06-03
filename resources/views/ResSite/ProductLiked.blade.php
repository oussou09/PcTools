@extends('ResSite.list')
@section('content')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="itemsgames">

    @if ($likedProducts->isEmpty())

        <h1 style="transition: border-bottom 0.3s ease-in-out;cursor: default;" onmouseover="this.style.borderBottom='3px solid white'" onmouseout="this.style.borderBottom='none'">
            You Don't Like Any Product
        </h1>

    @else

        @foreach ($likedProducts as $likedProduct)
        <div class="card">
            <div class="imgBox">
            <img src="{{$likedProduct['imageUrl']}}" alt="mouse corsair" class="mouse">
            </div>
            <div class="contentBox">
            <h3>
                @if (strlen($likedProduct['gameName']) > 50)
                    {{ substr($likedProduct['gameName'], 0, 50) }}...
                @else
                    {{ $likedProduct['gameName'] }}
                @endif
            </h3>
            <h2 class="price">{{$likedProduct['price']}}<small> €</small></h2>
                <form class="buy" action="{{ route('cart.add',['productId' => $likedProduct->id]) }}" method="POST">
                    @csrf
                    <button style="background: none; border: none; outline: none;" type="submit">Add to Cart</button>
                </form>
            </div>
            <div class="actions">
                <a href="{{ route('product.show',['slug' => $likedProduct->slug]) }}"><button type="submit">Show</button></a>
                @if (Auth::guard('user')->user()->isSeller() && Auth::guard('user')->user()->id === $likedProduct['user_id'] )
                    <a href="{{route('product.edit',$likedProduct['id'])}}"><button type="submit">edit</button></a>
                    <form action="{{route('product.destroy',$likedProduct['id'])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a><button type="submit" onclick="return confirm('Are you sure you want to delete {{$likedProduct['gameName']}}?')">delete</button></a>
                    </form>
                @endif
            </div>
            <div class="likeAction">
                @if (Auth::guard('user')->check())
                    @php
                        $user = Auth::guard('user')->user();
                    @endphp
                    @if (!($user->isSeller() && $user->id === $likedProduct['user_id']))
                        <form class="formlikes" method="POST" action="{{ route('product.StoreReaction', $likedProduct->id) }}">
                            @csrf
                            <button type="submit" style="background: none; border: none;">
                                @if ($user->likes->contains($likedProduct->id))
                                    <img style="width: 30px; height: 30px;" src="{{ asset('images/like-svgrepo-com.svg') }}" alt="Dislike">
                                @else
                                    <img style="width: 30px; height: 30px;" src="{{ asset('images/heart-like-favorite-svgrepo-com.svg') }}" alt="Like">
                                @endif
                            </button>
                            @if ($likedProduct->likedBy()->count() > 0)
                            <span style="font-size: 25px; font-weight: 900; color: red;padding-left: 5px;">{{ $likedProduct->likedBy()->count() }}</span>
                            @endif
                        </form>
                    @endif
                @endif
            </div>
        </div>

        @endforeach
    @endif

</div>

<div class="paginate">

  @if ($likedProducts->hasPages())
    <div class="pagination" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
      {{-- Previous Button --}}
      @if ($likedProducts->onFirstPage())
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;"><i class="fas fa-chevron-left"></i> Previous</span>
      @else
          <a href="{{ $likedProducts->previousPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;"><i class="fas fa-chevron-left"></i> Previous</a>
      @endif

      <span class="page-info" style="margin: 0 10px;">Page {{ $likedProducts->currentPage() }} of {{ $likedProducts->lastPage() }}</span>

      {{-- Next Button --}}
      @if ($likedProducts->hasMorePages())
          <a href="{{ $likedProducts->nextPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;">Next <i class="fas fa-chevron-right"></i></a>
      @else
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;">Next <i class="fas fa-chevron-right"></i></span>
      @endif
    </div>
  @endif

</div>

@endsection
