@extends('layouts.app')

@section('title', 'search page')


@section('content')
    <div class="heading">
        <h3>search page</h3>
        <p><a href="{{url('/')}}">home</a> / search</p>
    </div>

    <!-- search section -->
    <section class="search-form">
        <form action="" method="get">
            <input type="text" name="search" class="box" placeholder="seacrch products...">
            <input type="submit" class="btn" value="search">
        </form>
    </section> 

    <!-- product section -->
     <section class="products" style="padding-top: 0;">
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
                @if(request('search'))
                    <p class="empty">no result found!</p>
                @else
                    <p class="empty">search something!</p>
                @endif
            @endif
        </div>
     </section>

     @if($products->isNotEmpty())
        <div class="page">
            {!! $products->appends(['search' => request('search')])->links() !!}
        </div>
    @endif
@endsection