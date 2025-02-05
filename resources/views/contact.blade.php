@extends('layouts.app')

@section('title', 'contact')


@section('content')

    <div class="heading">
        <h3>contact us</h3>
        <p><a href="{{url('/')}}">home</a> / contact</p>
    </div>

    <!-- contact section -->
    <section class="contact">

        <form action="{{route('user.contact_store')}}" method="post">
            @csrf
            <h3>say something!</h3>
            <input type="text" name="name" class="box" required placeholder="enter your name">
            @error('name')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="email" name="email" class="box" required placeholder="enter your email">
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="number" name="number" class="box" required placeholder="enter your number"
            onkeypress="if(this.value.length == 10) return false;">
            @error('number')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <textarea name="message" class="box" placeholder="enter your message" cols="30" rows="10" id=""></textarea>
            @error('message')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="submit" class="btn" value="send message">
        </form>
    </section> 
    
@endsection