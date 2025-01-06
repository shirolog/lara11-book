@include('components.message')

<header class="header">
    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fab fa-facebook-f"></a>
                <a href="#" class="fab fab fa-twitter"></a>
                <a href="#" class="fab fab fa-instagram"></a>
                <a href="#" class="fab fab fa-linkedin"></a>
            </div>
            <p>new <a href="{{url('/login')}}">login</a> | <a href="{{url('/register')}}">register</a></p>
        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="{{url('/')}}" class="logo">Bookly</a>

            <nav class="navbar">
                <a href="{{url('/')}}">home</a>
                <a href="{{url('/about')}}">about</a>
                <a href="{{url('/shop')}}">shop</a>
                <a href="{{url('/contact')}}">contact</a>
                <a href="{{url('/orders')}}">orders</a>
            </nav>
    
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <a href="{{url('/search_page')}}" class="fas fa-search"></a>
                <div id="user-btn" class="fas fa-user"></div>
                <a href="{{url('/cart')}}"><i class="fas fa-shopping-cart"></i> <span>({{$cart_total}})</span></a>
            </div>

            <div class="user-box">
                <p>username : <span>{{Auth::user()->name}}</span></p>
                <p>email : <span>{{Auth::user()->email}}</span></p>
                <a href="{{route('user.logout')}}" class="logout-btn" 
                onclick="return confirm('logout from this webste?');">logout</a>
            </div>
        </div>
    </div>
</header>