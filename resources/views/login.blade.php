<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    
    @include('components.message')

    <div class="form-container">
        <form action="{{route('user.authenticate')}}" method="post">
            @csrf
            <h3>login now</h3>
            <input type="email" name="email" class="box" placeholder="enter your email" value="{{old('email')}}" required>    
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="password" name="password" class="box" placeholder="enter your password" required>    
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror

            @if(session('error'))
                <p class="text-danger">{{ session('error') }}</p>
            @endif
            <input type="submit" class="btn" value="login now">
            <p>don't have an account? <a href="{{url('/register')}}">register now</a></p>
        </form>
    </div>
</body>
</html>