@extends('layouts.admin_app')

@section('title', 'orders')


@section('content')
    
    <!-- orders section -->
     <section class="oreders">

        <h1 class="title">placed orders</h1>

        <div class="box-container">
            @if($orders->isNotEmpty())
            @foreach($orders as $order)
                <div class="box">
                    <p>user id : <span>{{$order->user_id}}</span></p>
                    <p>placed on : <span>{{$order->placed_on}}</span></p>
                    <p>name : <span>{{$order->name}}</span></p>
                    <p>number : <span>{{$order->number}}</span></p>
                    <p>email : <span>{{$order->email}}</span></p>
                    <p>address : <span>{{$order->address}}</span></p>
                    <p>total products : <span>{{$order->total_products}}</span></p>
                    <p>total price : <span>{{$order->total_price}}</span></p>
                    <p>payment mehod : <span>{{$order->method}}</span></p>
                    <form action="{{route('admin.admin_orders_update', $order->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <select name="status" id="status">
                            <option value="pending" {{$order->status == 'pending' ? 'selected' : ''}}>pending</option>
                            <option value="completed" {{$order->status == 'completed' ? 'selected' : ''}}>completed</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" class="option-btn" value="update">
                            <a href="javascript:avoid(0);" class="delete-btn" data-id="{{$order->id}}">delete</a>
                        </div>
                    </form>
                </div>
            @endforeach
            @else
                <p class="empty">no orders placed yet!</p>
            @endif
        </div>
     </section>

     @if($orders->isNotEmpty())
     <div class="page">
            {!!$orders->links()!!}
        </div>
     @endif

@endsection

@section('script')
    <script type="text/javascript">
        $(document).on('click', '.delete-btn', function(e){

            e.preventDefault();

            const orderId = $(this).data('id');

            if(confirm('delete this order?')){

                deleteId(orderId);
            }
        });

        function deleteId(orderId){

            $.ajax({
                url: '{{ route("admin.admin_orders_delete", ":id") }}'.replace(":id", orderId), 
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function(response){
                    if(response.status){
                        window.location.reload();
                    }
                }
            })
        }
    </script>
@endsection


