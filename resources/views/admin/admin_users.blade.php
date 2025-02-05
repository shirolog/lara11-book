@extends('layouts.admin_app')

@section('title', 'users')


@section('content')
    
    <!-- users section -->
    <section class="users">
        <h1 class="title">user accounts</h1>
        <div class="box-container">
            @if($users->isNotEmpty())
                @foreach($users as $user)
                    <div class="box">
                        <p>username : <span>{{$user->name}}</span></p>
                        <p>email : <span>{{$user->email}}</span></p>
                        <p>user type : <span style="color: {{($user->role === 'admin') ? 'var(--orange)' : 'inherit'}};">{{ $user->role }}</span></p>
                        <a href="javascript:avoid(0);" data-id="{{$user->id}}" class="delete-btn">delete user</a>
                    </div>
                @endforeach
                @else
                    <p class="empty">no users yet!</p>
            @endif
        </div>
    </section>

    @if($users->isNotEmpty())
     <div class="page">
            {!!$users->onEachSide(1)->links()!!}
    </div>
     @endif

@endsection


@section('script')
    <script type="text/javascript">
        $(document).on('click', '.delete-btn', function(e){

            e.preventDefault();

            const userId = $(this).data('id');

            if(confirm('delete this user?')){

                deleteUser(userId);
            }
        });

        function deleteUser(userId){

            $.ajax({
                url: '{{route("admin.admin_users_delete", ":id")}}'.replace(":id", userId),
                type: 'DELETE',
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function(response){
                    window.location.reload();
                }
            })
        }
    </script>
@endsection