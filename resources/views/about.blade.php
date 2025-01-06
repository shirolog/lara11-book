@extends('layouts.app')

@section('title', 'about')
    

@section('content')

    <div class="heading">
        <h3>about us</h3>
        <p><a href="{{url('/')}}">home</a> / about</p>
    </div>
        
    
    <!-- about section -->
    <section class="about" style="margin-top: 3rem; margin-bottom:3rem;">
        <div class="flex">
            <div class="image">
                <img src="{{asset('images/about-img.jpg')}}" alt="">
            </div>

            <div class="content">
                <h3>why choose us?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Tenetur possimus, rerum, commodi dolor quae blanditiis laborum soluta voluptates optio cum magni a sunt,
                    at dolorum amet quis similique dicta architecto!
                </p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Necessitatibus sequi maxime quam mollitia dolorem cum 
                    totam distinctio illum architecto cupiditate.
                </p>
                <a href="{{url('/contact')}}" class="btn">contact us</a>
            </div>
        </div>
    </section>

    <!-- reviews section -->
    <section class="reviews">
        <h1 class="title">client's reviews</h1>

        <div class="box-container">

            <div class="box">
                <img src="{{asset('images/pic-1.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            
            <div class="box">
                <img src="{{asset('images/pic-2.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/pic-3.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/pic-4.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/pic-5.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/pic-6.png')}}" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Laudantium soluta nobis repellat nemo provident harum ratione 
                     molestias nesciunt tempora temporibus!
                </p>

                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>
        </div>
    </section> 

    <!-- authors section -->
    <section class="authors">
        <h1 class="title">great authors</h1>

        <div class="box-container">

            <div class="box">
                <img src="{{asset('images/author-1.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/author-2.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/author-3.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/author-4.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/author-5.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="box">
                <img src="{{asset('images/author-6.jpg')}}" alt="">
                <div class="share">
                    <a href="#" class="fab fab fa-facebook-f"></a>
                    <a href="#" class="fab fab fa-twitter"></a>
                    <a href="#" class="fab fab fa-instagram"></a>
                    <a href="#" class="fab fab fa-linkedin"></a>
                </div>
                <h3>john deo</h3>
            </div>
        </div>
    </section> 
@endsection