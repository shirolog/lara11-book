@extends('layouts.app')

@section('title', 'cart')


@section('content')
    <div class="heading">
        <h3>shopping cart</h3>
        <p><a href="{{url('/')}}">home</a> / cart</p>
    </div>

    <!-- shopping-cart section -->
    <section class="shopping-cart">
        <h1 class="title">products added</h1>
        <div class="box-container">
            @if($carts->isNotEmpty())
                @foreach($carts as $cart)
                    <div class="box">
                        <a href="javascript:avoid(0);" data-id="{{$cart->id}}" class="fas fa-times" id="delete-cart"></a>
                        <img src="{{asset('uploaded_img/'. $cart->image)}}" alt="">
                        <div class="name">{{$cart->name}}</div>
                        <div class="price">${{number_format($cart->price)}}/-</div>
                        <form action="{{route('user.cart_update', $cart->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{old('quantity', $cart->quantity)}}" min="1" onkeypress="if(this.value.length == 2) return false">
                            <input type="submit" class="option-btn" value="update">
                        </form>
                        <div class="sub-total">sub total : <span>${{number_format($cart->price * $cart->quantity)}}/-</span></div>
                    </div>
                @endforeach
            @else
                <p class="empty">your cart is empty</p>
            @endif
        </div>

        <div style="margin-top: 2rem; text-align:center;">
            <a href="javascript:avoid(0);" class="delete-btn {{$total_price > 0 ? '' : 'disabled' }}" id="delete-all-cart">delete all</a>
        </div>

        <div class="cart-total">
            <p>grand total : <span>${{number_format($total_price)}}/-</span></p>
            <div class="flex">
                <a href="{{url('/shop')}}" class="option-btn">continue shopping</a>
                <a href="{{url('/checkout')}}" class="btn {{$total_price > 0 ? '' : 'disabled' }}">proceed to checkout</a>
            </div>
        </div>
    </section> 

    @if($carts->isNotEmpty())
        <div class="page">
            {!!$carts->onEachSide(1)->links()!!}
        </div>
    @endif

@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '#delete-cart', function(e){

            e.preventDefault();

            const cartId = $(this).data('id');

            if(confirm('delete form this cart?')){
                deleteCart(cartId);
            }
        });

        function deleteCart(cartId){
            $.ajax({
                url: '{{route("user.cart_destroy", ":id")}}'.replace(":id", cartId),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success:function(response){
                    if(response.status){
                        window.location.href = '{{route("user.cart")}}'; 
                    }
                }
            });
        }


        $(document).on('click', '#delete-all-cart', function(e){

            e.preventDefault();

            if(confirm('delete all from cart?')){
                deleteAll();
            } 
        });

        function deleteAll(){
            $.ajax({
                url: '{{route("user.cart_all_destroy")}}',
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function(response){
                    if(response.status){
                        window.location.href = '{{route("user.cart")}}';
                    }
                }
            })
        }
    </script>
@endsection