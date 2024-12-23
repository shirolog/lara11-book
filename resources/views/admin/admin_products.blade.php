@extends('layouts.admin_app')

@section('title', 'products')


@section('content')
    
    <!-- add-products section -->
    <section class="add-products">
        <h1 class="title">shop products</h1>
        <form action="{{route('admin.admin_products_store')}}" method="post" enctype="multipart/form-data">
           @csrf 
           <h3>add product</h3>
           <input type="text" name="name" class="box" placeholder="enter product name" required>
           <input type="number" name="price" class="box" placeholder="enter product price" required
           oninput="if(this.value.length > 2) this.value= this.value.slice(0, 9);" min="0">
           <input type="file" name="image" class="box" accept="image/png, image/jpeg, image/jpg" id="">
           <input type="submit" class="btn" value="add product">
        </form>
    </section>   

    <!-- show-products section -->
    <section class="show-products">
        <div class="box-container">
            @if($products->isNotEmpty())
                @foreach($products as $product)
                    <div class="box">
                        <img src="{{asset('uploaded_img/'.$product->image)}}" alt="">
                        <div class="name">{{$product->name}}</div>
                        <div class="price">${{number_format($product->price)}}/-</div>
                        <a href="javascript:avoid(0);" class="option-btn" id="edit-btn" data-id="{{$product->id}}">update</a>
                        <a href="javascript:avoid(0);" class="delete-btn"  data-id="{{$product->id}}">delete</a>
                    </div>
                @endforeach
            @else
                <p class="empty">no product added yet!</p>
            @endif
        </div>
    </section>

    <div class="edit-product-form">
        <form id="editFrom"  method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if(isset($product))
                <img src="{{asset('uploaded_img/'. $product->image)}}" alt="">
                <input type="text" name="name" class="box" required 
                placeholder="enter product name" value="{{old('name', $product->name)}}">
                <input type="text" name="price" class="box" value="{{old('price', number_format($product->price))}}" placeholder="enter product price" required
                oninput="if(this.value.length > 2) this.value= this.value.slice(0, 9);" min="0">
            @endif
           <input type="file" name="image" class="box" accept="image/png, image/jpeg, image/jpg" id="">
           <input type="submit" value="update" class="btn">
           <input type="reset" value="cancel" class="option-btn" id="close-update">
        </form>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
        //商品を削除
        $(document).on('click', '.delete-btn', function(e){

            e.preventDefault();

            const productId = $(this).data('id');

            if(confirm('delete this product?')){

                deleteProduct(productId);
            }
        });

        function deleteProduct(productId){
            $.ajax({
                'url': '{{route("admin.admin_products_delete", ":id")}}'.replace(":id", productId),
                'type': 'DELETE',
                'headers':{
                    'X-CSRF-TOKEN': '{{csrf_token()}}' 
                },  
                success: function(response){
                    if(response.status){
                        window.location.reload();
                    }
                }
            })
        }

        //モーダルウィンドウを商品毎に表示
        $(document).on('click', '#edit-btn', function(e){
            e.preventDefault();

            const productId = $(this).data('id');

            
            
            $.ajax({
                'url': '{{route("admin.admin_products_edit", ":id")}}'.replace(":id", productId),
                type: 'GET',
                success: function(response){
                    if(response.status){

                        const product = response.product;

                        $('#editFrom input[name="name"]').val(product.name); // 商品名
                        $('#editFrom input[name="price"]').val(product.price); // 価格
                        $('#editFrom img').attr('src', '{{ asset("uploaded_img") }}/' + product.image); // 画像

                        // フォームにproductIdを設定
                        $('#editFrom').data('id', productId);


                    }
                }
            })
        });


    
       
                
        $(document).on('submit', '#editFrom', function (e) {
            e.preventDefault();

            const productId = $(this).data('id'); // モーダルで設定された正しいIDを取得

            const formData = new FormData(this); // フォームデータを取得

            $.ajax({
                url: '{{ route("admin.admin_products_update", ":id") }}'.replace(":id", productId),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status) {
                        window.location.reload();
                    }
                },
            });
        });







    </script>
@endsection

