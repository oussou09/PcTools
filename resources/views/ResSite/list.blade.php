<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>product list</title>

    <link rel="stylesheet" href="{{asset('css/list.css')}}">
    <link rel="stylesheet" href="{{asset('css/create.css')}}">

    <script src="https://kit.fontawesome.com/66aa7c98b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @yield('style')
  </head>
  <body>
    {{-- nav-bar --}}
    <div class="containerNav">
        <div class="logo">
          <img style="height: 70px;width: 215px;" class="HeaderAdminImg" src="{{asset('css/admin/newlogo.png')}}" alt="logo" />
        </div>
          <div class="menu">
              <nav>
                  <ul id="menu">
                      @if (Auth::guard('user')->check())
                          <li class="link"><a style="display: flex;align-items: center;" href="{{ route('user.dashborduser') }}">Home <img class="svgimg" style="height: 37px;width: 37px;margin-left:10px" src = "{{ asset('images/home.svg') }}" alt="user SVG"/></a></li>
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
                                  <a style="display: flex;align-items: center;cursor: pointer;" >Product <img class="svgimg" style="height: 30px;width: 30px;margin-left:10px" src = "{{ asset('images/box-open.svg') }}" alt="user SVG"/></a>
                                  <ul class="sous_menu">
                                      <li><a href="{{ route('product.index') }}">Buy Product</a></li>
                                  </ul>
                              </li>
                          @endif
                          <li class="link">
                              <a style="display: flex;align-items: center;" href="{{ route('user.dashborduser') }}">Profile <img class="svgimg" style="height: 40px;width: 40px;margin-left:10px" src = "{{ asset('images/user.svg') }}" alt="user SVG"/></a>
                              <ul class="sous_menu">
                                  <li><a href="{{ route('user.edituser',['id' => Auth::guard('user')->user()->id])}}">Edit Profile</a></li>
                                  <li>
                                      <form style="display: flex;align-items: center;" action="{{ route('user.logoutuser') }}" method="POST">
                                          @csrf
                                          <input type="submit" value="Logout" style="padding: 1rem 0.5rem; display: block; color: #ffffff; cursor: pointer; background: none; border: 0; width: 100%; font-size: 22px;">
                                          <img class="svgimg" style="height: 30px;width: 30px;margin-left:10px;cursor: pointer;" src = "{{ asset('images/sign-out-alt.svg') }}" alt="sign-out SVG"/>
                                      </form>
                                  </li>
                              </ul>
                          </li>
                          @if (Auth::guard('user')->user()->isBuyer())
                              <li class="link" style="padding: 0px 15px;">
                                  <a href="{{ route('cart.show',['id' => Auth::guard('user')->user()->id]) }}" style="display: flex; flex-direction: row; justify-content: center; position: relative;padding-right: 30px;">
                                      <img style="height: 35px;width: 35px;margin-left:10px" src="{{ asset('images/cart.svg') }}" alt="cart">
                                      <span style="position: absolute;bottom: 0px;left: 50px;border-radius: 100%;border: solid #f85e5e 3px;padding: 1px 7px;background-color: #fc4040;font-size: 15px;font-weight: bolder;color: white;">
                                        {{ Auth::guard('user')->user()->cart ? Auth::guard('user')->user()->cart->products()->count() : '0' }}
                                      </span>
                                  </a>
                              </li>
                          @endif
                      @else
                          @guest
                              @if(request()->routeIs('user.loginuser'))
                                  <li class="link"><a href="{{ route('user.registeruser') }}">Register</a></li>
                              @elseif(request()->routeIs('user.registeruser'))
                                  <li class="link"><a href="{{ route('user.loginuser') }}">Login</a></li>
                              @endif
                          @endguest
                      @endif
                  </ul>
              </nav>
          </div>
      </div>


    {{-- section ( Body ) --}}


    <section>

      @yield('content')

    </section>


    {{-- Footer page --}}
    <div class="footer">
      <div class="heading">
        <h2>PCTOOLS<sup>™</sup></h2>
      </div>
      <div class="content">
        <div class="services">
          <h4>Services</h4>
          <p><a href="{{ route('product.index') }}">Buy PC Tools</a></p>
          <p><a href="#">Sell PC Tools</a></p>
          <p><a href="{{ route('home.about') }}">PC Tools Info</a></p>
        </div>
        <div class="social-media">
          <h4>Social</h4>
          <p>
            <a href="#"><i class="fab fa-linkedin" style="color: white;"></i> Linkedin</a>
          </p>
          <p>
            <a href="#"><i class="fab fa-twitter" style="color: white;"></i> Twitter</a>
          </p>
          <p>
            <a href="https://github.com/farazc60" ><i class="fab fa-github" style="color: white;"></i> Github</a>
          </p>
          <p>
            <a href="https://www.facebook.com/codewithfaraz"><i class="fab fa-facebook" style="color: white;"></i> Facebook</a>
          </p>
          <p>
            <a href="https://www.instagram.com/codewithfaraz"><i class="fab fa-instagram" style="color: white;"></i> Instagram</a>
          </p>
        </div>
        <div class="links">
          <h4>Quick links</h4>
          <p><a style="display: flex;align-items: flex-start;flex-direction: row;justify-content: center;"  href="{{ route('home.home') }}"><img class="svgimg" style="height: 20px;width: 20px;margin-right:7px;cursor: pointer;" src = "{{ asset('images/house-solid.svg') }}" alt="house-solid SVG"/>Home</a></p>
          <p><a style="display: flex;align-items: flex-start;flex-direction: row;justify-content: center;"  href="{{ route('home.about') }}"><img class="svgimg" style="height: 20px;width: 20px;margin-right:7px;cursor: pointer;" src = "{{ asset('images/about-filled-svgrepo-com.svg') }}" alt="about-solid SVG"/>About</a></p>
          <p><a style="display: flex;align-items: flex-start;flex-direction: row;justify-content: center;"  href="{{ route('home.contact') }}"><img class="svgimg" style="height: 20px;width: 20px;margin-right:7px;cursor: pointer;" src = "{{ asset('images/contact-svgrepo-com.svg') }}" alt="contact-solid SVG"/>Contact</a></p>
        </div>
        <div class="details">
          <h4 class="address">Address</h4>
          <p>Soon...</p>
          <h4 class="mobile">Mobile</h4>
          <p><a style="display: flex;align-items: flex-start;flex-direction: row;justify-content: center;"  href="#"><img class="svgimg" style="height: 20px;width: 20px;margin-right:7px;cursor: pointer;" src = "{{ asset('images/phone-svgrepo-com.svg') }}" alt="about-solid SVG"/>+212-613583510</a></p>
          <h4 class="mail">Email</h4>
          <p><a style="display: flex;align-items: flex-start;flex-direction: row;justify-content: center;"  href="#"><img class="svgimg" style="height: 20px;width: 20px;margin-right:7px;cursor: pointer;" src = "{{ asset('images/email-8-svgrepo-com.svg') }}" alt="about-solid SVG"/>oussamaoussou9@gmail.com</a></p>
        </div>
      </div>
      <footer>
        <hr />
        © 2024 PCTOOLS.
      </footer>
    </div>
  </body>
</html>
