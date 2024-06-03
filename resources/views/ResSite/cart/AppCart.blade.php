<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>product list</title>

    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    @yield('style')


    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  </head>
  <body>
    {{-- nav-bar --}}
    <div class="containerNav">
        <div class="logo">
          <img style="height:80px;width:250px;" class="HeaderAdminImg" src="{{asset('css/admin/newlogo.png')}}" alt="logo" />
        </div>
          <div class="menu">
              <nav>
                  <ul id="menu">
                      <li class="link"><a style="display: flex;align-items: center;" href="{{ route('product.index') }}">Home <img class="svgimg" style="height: 37px;width: 37px;margin-left:10px" src = "{{ asset('images/home.svg') }}" alt="user SVG"/></a></li>
                      @if (Auth::guard('user')->check())
                          @if (Auth::guard('user')->user()->isSeller())
                              <li class="link">
                                  <a style="display: flex;align-items: center;cursor: pointer;" >Manage Product <img class="svgimg" style="height: 30px;width: 30px;margin-left:10px" src = "{{ asset('images/box-open.svg') }}" alt="user SVG"/></a>
                                  <ul class="sous_menu">
                                    <li><a href="{{ route('product.create') }}">Add Product</a></li>
                                    <li><a href="{{ route('product.index') }}">All Products</a></li>
                                    <li><a href="{{ route('product.myproduct',['id' => Auth::guard('user')->user()->id]) }}">All My Products</a></li>
                                </ul>
                              </li>
                          @elseif(Auth::guard('user')->user()->isBuyer())
                              <li class="link">
                                  <a href="#">Product</a>
                                  <ul class="sous_menu">
                                      <li><a href="{{ route('product.index') }}">Buy Product</a></li>
                                  </ul>
                              </li>
                          @endif
                          <li class="link">
                            <a style="display: flex;align-items: center;" href="{{ route('user.profileuser',['id' => Auth::guard('user')->user()->id])}}">Profile <img class="svgimg" style="height: 40px;width: 40px;margin-left:10px" src = "{{ asset('images/user.svg') }}" alt="user SVG"/></a>
                            <ul class="sous_menu">
                                <li><a href="{{ route('user.edituser',['id' => Auth::guard('user')->user()->id]) }}">Edit Profile</a></li>
                            </ul>
                        </li>
                          <li class="link">
                              <form style="display: flex;align-items: center;" action="{{ route('user.logoutuser') }}" method="POST">
                                  @csrf
                                  <input type="submit" value="Logout" style="padding: 1rem 0.5rem; display: block; color: #ffffff; cursor: pointer; background: none; border: 0; width: 100%; font-size: 22px;">
                                  <img class="svgimg" style="height: 30px;width: 30px;margin-left:10px;cursor: pointer;" src = "{{ asset('images/sign-out-alt.svg') }}" alt="sign-out SVG"/>
                              </form>
                          </li>
                      @else
                          <li class="link"><a href="/user/login">Login</a></li>
                          <li class="link"><a href="#">Contact</a></li>
                      @endif
                  </ul>
              </nav>
          </div>
      </div>


    {{-- section ( Body ) --}}



      @yield('content')



    {{-- Footer page --}}

  </body>
</html>
