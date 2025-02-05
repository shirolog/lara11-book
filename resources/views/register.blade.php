<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    
    @include('components.message')

    <div class="form-container">
        <form action="{{route('user.store')}}" method="post">
            @csrf
            <h3>register now</h3>
            <input type="text" name="name" class="box" placeholder="enter your name" required>    
            @error('name')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="email" name="email" class="box" placeholder="enter your email" required>    
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="password" name="password" class="box" placeholder="enter your password" required>    
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="password" name="password_confirmation" class="box" placeholder="cofirm your password" required>    
            @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="submit" class="btn" value="register now">
            <p>already have an account? <a href="{{url('/login')}}">login now</a></p>
        </form>
    </div>
</body>
</html>