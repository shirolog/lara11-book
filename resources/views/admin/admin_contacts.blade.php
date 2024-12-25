@extends('layouts.admin_app')

@section('title', 'messages')


@section('content')
    
    <!-- messages section -->
    <section class="messages">
        <h1 class="title">messages</h1>
        <div class="box-container">
            @if($messages->isNotEmpty())
                @foreach($messages as $message)
                    <div class="box">
                        <p>name : <span>{{$message->name}}</span></p>
                        <p>number : <span>{{$message->number}}</span></p>
                        <p>email : <span>{{$message->email}}</span></p>
                        <p>message : <span>{{$message->message}}</span></p>
                        <a href="javascript:avoid(0);" data-id="{{$message->id}}" class="delete-btn">delete message</a>
                    </div>
                @endforeach
            @else
                <p class="empty">You have no messages!</p>    
            @endif
        </div>
    </section>

    
    @if($messages->isNotEmpty())
     <div class="page">
            {!!$messages->links()!!}
        </div>
     @endif

@endsection


@section('script')
    <script type="text/javascript">
        $(document).on('click', '.delete-btn', function(e){

            e.preventDefault();

            const messageId = $(this).data('id');

            if(confirm('delete this message?')){

                deleteMessage(messageId);
            }
        });

        function deleteMessage(messageId){

            $.ajax({
                url: '{{route("admin.admin_contacts_delete", ":id")}}'.replace(":id", messageId),
                type: 'DELETE',
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function(response){
                    if(response.status){
                        window.location.href = '{{route("admin.admin_contacts")}}'
                    }
                }
            })
        }
    </script>
@endsection


