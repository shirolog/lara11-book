@include('components.message')

<header class="header">
    <div class="flex">
        <a href="{{url('/admin_page')}}" class="logo">Admin<span>Panel</span></a>
        <nav class="navbar">
            <a href="{{url('/admin_page')}}">home</a>
            <a href="{{url('/admin_products')}}">products</a>
            <a href="{{url('/admin_orders')}}">orders</a>
            <a href="{{url('/admin_users')}}">users</a>
            <a href="{{url('/admin_contacts')}}">messages</a>
        </nav>

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-user" id="user-btn"></div>
        </div>

        <div class="account-box">
            <p>username : <span>{{Auth::user()->name}}</span></p>
            <p>email : <span>{{Auth::user()->email}}</span></p>
            <a href="{{route('admin.admin_logout')}}" class="logout-btn" onclick="return confirm('logout from this website?');">logout</a>
        </div>
    </div>
</header>