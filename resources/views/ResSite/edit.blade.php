@extends('ResSite.list')
@section('content')
    <div class="form simplified">

        <h1>You edit Item id {{$product['id']}}</h1>
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-group">
                <label for="product-name">Product Name</label>
                <input type="text" id="product-name" name="productName" value="{{$product['gameName']}}" placeholder="Product name">
            </div>
            {{-- start handle error Product Name  --}}
            @if ($errors->has('productName'))
                <div class="alert alert-danger">
                    <ul style="list-style:none">
                        @foreach ($errors->get('productName') as $error)
                            <li style="color:red"><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- start handle error Product Name  --}}

            <div class="input-group">
                <label for="product-url">Product URL or Image URL</label>
                <input type="text" id="product-url" name="productUrl" value="{{$product['imageUrl']}}" placeholder="Product URL or Image URL">
            </div>
            {{-- end handle error Image URL  --}}
            @if ($errors->has('productUrl'))
                <div>
                    <ul style="list-style:none">
                        @foreach ($errors->get('productUrl') as $error)
                            <li style="color:red"><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- end handle error Image URL  --}}

            <div class="input-group">
                <label for="product-price">Price</label>
                <input type="number" id="product-price" name="productPrice" value="{{$product['price']}}" placeholder="Price">
            </div>
            {{-- start handle error Price  --}}
            @if ($errors->has('productPrice'))
            <div class="alert alert-danger">
                    <ul style="list-style:none">
                        @foreach ($errors->get('productPrice') as $error)
                            <li style="color:red"><strong>{{ $error }}</strong></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- end handle error Product Price  --}}

            <div class="buttons">
                <button type="submit" class="btn" id="add-btn">Edit Product</button>
            </div>
        </form>
    </div>
@endsection
