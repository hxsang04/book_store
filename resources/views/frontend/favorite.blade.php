
@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Yêu thích</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Trang chủ</a>
                            <span>Yêu thích</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        @if (count($favoriteProducts) > 0)
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Sản phẩm</th>
                                        <th>Giá tiền</th>
                                        <th>Tình trạng</th>
                                        <th>Hành động</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favoriteProducts as $product)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{$product->image}}" alt="" width="100">
                                                <a href="{{route('product', $product)}}">
                                                    <h5>{{$product->name}}</h5>
                                                </a>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{convertPrice($product->price)}}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                @if($product->quantity > 0)
                                                    <p class="text-success">Còn hàng</p>
                                                @else
                                                    <p class="text-danger">Còn hàng</p>
                                                @endif 
                                            </td>
                                            <td class="shoping__cart__quantity">
                                               <a href="{{route('cart.add', $product)}}" class="btn btn-info">Thêm vào giỏ hàng</a>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <span onclick="confirmDelete({{$product->id}})" class="icon_close"></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h5 class="text-center">Bạn chưa có sản phẩm yêu thích nào!</h5>
            <div class="row justify-content-center mt-4">
                <div class="shoping__cart__btns">
                    <a href="{{route('shop')}}" class="primary-btn">Tiếp tục mua hàng</a>
                </div>
            </div>
        @endif
        
    </section>
    <!-- Shoping Cart Section End -->

    <script>
        function confirmDelete(id){
            Swal.fire({
                title: 'Bạn có muốn xóa sản phẩm này khỏi yêu thích không?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/yeu-thich/delete/' + id;
                }
            })
        }

    </script>

@endsection
   