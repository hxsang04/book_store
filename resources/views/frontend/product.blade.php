@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Sản phẩm</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <a href="{{route('category', $product->category)}}">{{$product->category->name}}</a>
                            <span>Sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{$product->image}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <form action="{{route('cart.add', $product)}}">
                        <div class="product__details__text">
                            <h3>{{$product->name}}</h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18 reviews)</span>
                            </div>
                            <div class="product__details__price">{{convertPrice($product->price)}} 
                                @if ($product->discount != 0)
                                    <span class="old-price">{{convertPrice(initialPrice($product->price,$product->discount))}}</span>
                                    <span class="discount-percent">-{{$product->discount}}%</span>
                                @endif
                            </div>
                            {{-- <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                                vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
                                quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p> --}}
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty shop">
                                        <input type="text" value="1" name="quantity">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn border-0">Thêm vào giỏ hàng</button>

                            @if (Auth::check())
                                @if(Auth::guard('web')->user()->hasFavoritedProduct($product->id))
                                    <a href="{{route('favorite.delete', $product)}}" class="heart-icon" style="color: #7fad39"><span class="icon_heart_alt"></span></a>
                                @else
                                    <a href="{{route('favorite.add', $product)}}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                @endif
                            @else
                            <a href="{{route('favorite.add', $product)}}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            @endif

                            <ul>
                                <li>
                                    <b>Tình trạng</b>
                                    @if ($product->quantity > 0)
                                        <span class="text-success">Còn hàng</span>
                                    @else
                                        <span class="text-danger">Hết hàng</span>
                                    @endif
                                </li>
                                <li><b>Thể loại</b> {{$product->category->name}}</li>
                                <li><b>Tác giả</b> {{$product->author->name}}</li>
                                <li><b>Nhà xuất bản</b>NXB {{$product->publisher->name}}</li>
                                <li><b>Chia sẻ</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 d-md-none d-none d-sm-none d-xl-block">
                    <img src="{{asset('assets/frontend/img/banner/banner_3.png')}}" alt="">
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Thông tin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Giao hàng</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Đánh giá <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                    {!!$product->description!!}
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__discount">
                        <div class="section-title">
                            <h2>Sản phẩm tương tự</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product__discount__slider owl-carousel">
                @foreach($relatedProducts as $product)
                    <div class="col-lg-3">
                        <div class="product__discount__item product__item">
                            <div class="product__discount__item__pic set-bg-prod"
                                data-setbg="{{$product->image}}">
                                @if ($product->discount > 0)
                                    <div class="product__discount__percent">-{{$product->discount}}%</div>
                                @endif
                                <ul class="product__item__pic__hover">
                                    @if (Auth::check())
                                        @if(Auth::guard('web')->user()->hasFavoritedProduct($product->id))
                                            <li class="active"><a href="{{route('favorite.delete', $product)}}"><i class="fa fa-heart"></i></a></li>
                                        @else
                                            <li><a href="{{route('favorite.add', $product)}}"><i class="fa fa-heart"></i></a></li>
                                        @endif
                                    @else
                                    <li><a href="{{route('favorite.add', $product)}}"><i class="fa fa-heart"></i></a></li>
                                    @endif
                                    <li><a href="{{route('cart.add', $product)}}"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="{{route('product', $product)}}"><i class="fa fa-eye"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <h5><a href="{{route('product', $product)}}">{{$product->name}}</a></h5>
                                <div class="product__item__price">{{convertPrice($product->price)}}
                                    @if ($product->discount > 0)
                                        <span>{{convertPrice(initialPrice($product->price,$product->discount))}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection