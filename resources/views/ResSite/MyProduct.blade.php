@extends('ResSite.list')
@section('content')

<div class="itemsgames">

        @foreach ($user_products as $user_product)

          <div class="card">

            <div class="imgBox">
              <img src="{{$user_product['imageUrl']}}" alt="mouse corsair" class="mouse">
            </div>

            <div class="contentBox">
                <h3>
                    @if (strlen($user_product['gameName']) > 50)
                        {{ substr($user_product['gameName'], 0, 50) }}...
                    @else
                        {{ $user_product['gameName'] }}
                    @endif
                </h3>
              <h2 class="price">{{$user_product['price']}}<small> €</small></h2>
            </div>
            <div class="actions">
                <a href="{{route('product.show',$user_product['slug'])}}"><button type="submit">Show</button></a>
                <a href="{{route('product.edit',$user_product['id'])}}"><button type="submit">edit</button></a>
                <form action="{{route('product.destroy',$user_product['id'])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="#"><button type="submit" onclick="return confirm('Are you sure you want to delete {{$user_product['gameName']}}?')">delete</button></a>
                </form>
            </div>
            <div class="likeAction">
                @if (Auth::guard('user')->check())
                        @if ($user_product->likedBy()->count() > 0)
                            <span style="font-size: 20px; font-weight: 900; color: red;padding-left: 5px;">{{ $user_product->likedBy()->count() }} Like</span>
                        @endif
                @endif
            </div>

          </div>

        @endforeach

</div>

<div class="paginate">

  @if ($user_products->hasPages())
    <div class="pagination" style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
      {{-- Previous Button --}}
      @if ($user_products->onFirstPage())
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;"><i class="fas fa-chevron-left"></i> Previous</span>
      @else
          <a href="{{ $user_products->previousPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;"><i class="fas fa-chevron-left"></i> Previous</a>
      @endif

      <span class="page-info" style="margin: 0 10px;">Page {{ $user_products->currentPage() }} of {{ $user_products->lastPage() }}</span>

      {{-- Next Button --}}
      @if ($user_products->hasMorePages())
          <a href="{{ $user_products->nextPageUrl() }}" class="page-link" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s;">Next <i class="fas fa-chevron-right"></i></a>
      @else
          <span class="page-link disabled" style="display: inline-block; padding: 10px 15px; margin: 0 5px; border-radius: 4px; text-decoration: none; color: #333; background-color: #ffce00; border: 1px solid #ddd; transition: background-color 0.3s; pointer-events: none; opacity: 0.6;">Next <i class="fas fa-chevron-right"></i></span>
      @endif
    </div>
  @endif

</div>

@endsection
