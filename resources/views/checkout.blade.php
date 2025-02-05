@extends('layouts.app')

@section('title', 'checkout')


@section('content')

    <div class="heading">
        <h3>checkout</h3>
        <p><a href="{{url('/')}}">home</a> / checkout</p>
    </div>

    <!-- display-order section -->
    <section class="display-order">
        @if($carts->isNotEmpty())
            @foreach($carts as $cart)
                <p>{{$cart->name}} <span>(${{number_format($cart->price)}}/-  x  {{$cart->quantity}})</span></p>
            @endforeach
        @else
            <p class="empty">your cart is empty</p>
        @endif

        <div class="grand-total">grand total: <span>${{number_format($total_price)}}/-</span></div>
    </section> 

    <!-- checkout section -->
    <section class="checkout">
        <form action="{{route('user.checkout_store')}}" method="post">
            @csrf
            @foreach($carts as $cart)
                <input type="hidden" name="productName[]" value="{{$cart->product->name}}">
                <input type="hidden" name="quantity[]" value="{{$cart->quantity}}">
            @endforeach
            <input type="hidden" name="total_price" value="{{$total_price}}">
            <h3>place your order</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>your name :</span>
                    <input type="text" name="name" placeholder="enter your name" required>
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>your number :</span>
                    <input type="number" name="number" placeholder="enter your number" onkeypress="if(this.value.length == 10) return false" required>
                    @error('number')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>your email :</span>
                    <input type="email" name="email" placeholder="enter your email" required>
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>payment method :</span>
                    <select name="method" required>
                        <option value="cash on delivery">cash on delivery</option>
                        <option value="credit card">credit card</option>
                        <option value="paypal">paypal</option>
                        <option value="paytm">paytm</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>address line 01 :</span>
                    <input type="number" name="flat" placeholder="e. g. flat no." min="0" required onkeypress="if(this.value.length == 10) return false">
                    @error('flat')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>address line 01 :</span>
                    <input type="text" name="street" placeholder="e. g. street name" min="0" required>
                    @error('street')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>city :</span>
                    <input type="text" name="city" placeholder="e. g. mumbai" required>
                    @error('city')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>state :</span>
                    <input type="text" name="state" placeholder="e. g. maharashtra" required>
                    @error('state')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>country :</span>
                    <input type="text" name="country" placeholder="e. g. india" required>
                    @error('country')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

                <div class="inputBox">
                    <span>pincode :</span>
                    <input type="number" name="pin_code" min="0" placeholder="e. g. 123456" onkeypress="if(this.value.length == 6) return false" required>
                    @error('pin_code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <input type="submit" class="btn" value="order now">
        </form>
    </section> 
    
@endsection