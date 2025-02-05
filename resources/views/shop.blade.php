@extends('layouts.app')

@section('title', 'shop')


@section('content')

    <div class="heading">
        <h3>our shop</h3>
        <p><a href="{{url('/')}}">home</a> / shop</p>
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
        </section> 

    @if($products->isNotEmpty())
    <div class="page">
        {!!$products->onEachSide(1)->links()!!}
    </div>
    @endif
    
@endsection