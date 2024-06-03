@extends('ResSite.list')
@section('content')

@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="itemsgames">

        @foreach ($products as $product)

            <div class="card">

                <div class="imgBox">
                <img src="{{$product['imageUrl']}}" alt="mouse corsair" class="mouse">
                </div>

                <div class="contentBox">
                <h3>
                    @if (strlen($product['gameName']) > 50)
                        {{ substr($product['gameName'], 0, 50) }}...
                    @else
                        {{ $product['gameName'] }}
                    @endif
                </h3>
                <h2 class="price">{{$product['price']}}<small> €</small></h2>
                    <form class="buy" action="{{ route('cart.add',['productId' => $product->id]) }}" method="POST">
                        @csrf
                        <button style="background: none; border: none; outline: none;" type="submit">Add to Cart</button>
                    </form>
                </div>
                <div class="actions">
                    <a href="{{ route('product.show',['slug' => $product->slug]) }}"><button type="submit">Show</button></a>
                    @if (Auth::guard('user')->user()->isSeller() && Auth::guard('user')->user()->id === $product['user_id'] )
                        <a href="{{route('product.edit',$product['id'])}}"><button type="submit">edit</button></a>
                        <form action="{{route('product.destroy',$product['id'])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a><button type="submit" onclick="return confirm('Are you sure you want to delete {{$product['gameName']}}?')">delete</button></a>
                        </form>
                    @endif
                </div>
                <div class="likeAction">
                    @if (Auth::guard('user')->check())
                        @php
                            $user = Auth::guard('user')->user();
                        @endphp
                        @if (!($user->isSeller() && $user->id === $product['user_id']))
                            <form class="formlikes" method="POST" action="{{ route('product.StoreReaction', $product->id) }}">
                                @csrf
                                <button type="submit" style="background: none; border: none;">
                                    @if ($user->likes->contains($product->id))
                                        <img style="width: 30px; height: 30px;" src="{{ asset('images/like-svgrepo-com.svg') }}" alt="Dislike">
                                    @else
                                        <img style="width: 30px; height: 30px;" src="{{ asset('images/heart-like-favorite-svgrepo-com.svg') }}" alt="Like">
                                    @endif
                                </button>
                                @if ($product->likedBy()->count() > 0)
                                    <span style="font-size: 25px; font-weight: 900; color: red;padding-left: 5px;">{{ $product->likedBy()->count() }}</span>
                                @endif
                            </form>
                        @endif
                    @endif
                </div>


            </div>

        @endforeach

</div>

<div class="paginate">

  @if ($products->hasPages())
    <div class="pagination" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
      {{-- Previous Button --}}
      @if ($products->onFirstPage())
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;"><i class="fas fa-chevron-left"></i> Previous</span>
      @else
          <a href="{{ $products->previousPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;"><i class="fas fa-chevron-left"></i> Previous</a>
      @endif

      <span class="page-info" style="margin: 0 10px;">Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>

      {{-- Next Button --}}
      @if ($products->hasMorePages())
          <a href="{{ $products->nextPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;">Next <i class="fas fa-chevron-right"></i></a>
      @else
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;">Next <i class="fas fa-chevron-right"></i></span>
      @endif
    </div>
  @endif

</div>

@endsection
