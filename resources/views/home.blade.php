@extends('layouts.app')

@section('title', 'home')


@section('content')


    <!-- home section -->
    <div class="home">
        <div class="content">
            <h3>Hand Picked Book to your door.</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Est, dolorem voluptates. Nesciunt pariatur rerum earum!
            </p>
            <a href="{{url('/about')}}" class="white-btn">discover more</a>
        </div>
    </div>

    <!-- products section -->
    <section class="products">
        <h1 class="title">latest products</h1>
        <div class="box-container">
            @if($products->isNotEmpty())
                @foreach($products as $product)
                    <form action="{{route('user.add_cart')}}" method="post" class="box">
                        @csrf
                        <input type="hidden" name="image" value="{{$product->image}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="name" value="{{$product->name}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <img src="{{asset('uploaded_img/'. $product->image)}}" class="image" alt="">
                        <div class="name">{{$product->name}}</div>
                        <div class="price">${{number_format($product->price)}}/-</div>
                        <input type="number" name="quantity" class="qty" min="1" value="1" onkeypress="if(this.value.length == 2) return false">
                        <input type="submit" class="btn" value="add to cart">
                    </form>
                @endforeach
            @else
                <p class="empty">no products added yet!</p>
            @endif
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center;">
            <a href="{{url('/shop')}}" class="option-btn">load more</a>
        </div>
    </section> 

    <!-- about section -->
    <section class="about" style="margin-top: 3rem; margin-bottom:3rem;">
        <div class="flex">
            <div class="image">
                <img src="{{asset('images/about-img.jpg')}}" alt="">
            </div>

            <div class="content">
                <h3>about us</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Necessitatibus sequi maxime quam mollitia dolorem cum 
                    totam distinctio illum architecto cupiditate.
                </p>
                <a href="{{url('/about')}}" class="btn">read more</a>
            </div>
        </div>
    </section>


    <div class="home-contact">
        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Officiis eaque omnis dolorum ipsam necessitatibus blanditiis.
            </p>
            <a href="{{url('/contact')}}" class="white-btn">contact us</a>
        </div>
    </div> 
@endsection