@if(Session::has('success'))
    <div class="message">
        <span>{{Session::get('success')}}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif

@if(Session::has('error'))
    <div class="message">
        <span>{{Session::get('error')}}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif

@if($errors->any())
    <div class="message">
        <span>
            @foreach($errors->all() as $error)
                {{$error}} <br>
            @endforeach
        </span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif