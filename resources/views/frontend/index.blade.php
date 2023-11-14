@extends('frontend.layout.master')

@section('content')

    <!-- Banner Section Begin -->
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hero__item set-bg" data-setbg="/assets/frontend/img/hero/banner-2.jpg">
                        <div class="hero__text">
                            <span>Max Book</span>
                            <h2>Giảm giá tới <br> 25% cho đơn hàng</h2>
                            <p>Đặt hàng và giao hàng miễn phí ngay hôm nay</p>
                            <a href="{{route('shop')}}" class="primary-btn">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Flash sale Section Begin -->
    <section class="flash-sale spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__discount">
                        <div class="section-title">
                            <h2>Giảm giá</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product__discount__slider owl-carousel">
                @foreach($discountProducts as $product)
                    <div class="col-lg-3">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg-prod"
                                data-setbg="{{$product->image}}">
                                <div class="product__discount__percent">-{{$product->discount}}%</div>
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
                                <span>{{$product->category->name}}</span>
                                <h5><a href="{{route('product', $product)}}">{{$product->name}}</a></h5>
                                <div class="product__item__price">{{convertPrice($product->price)}}<span>{{convertPrice(initialPrice($product->price, $product->discount))}}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Flash sale Section End -->
   
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm bán chạy</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($topSellingProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg-prod"
                                data-setbg="{{$product->image}}">
                                @if ($product->discount)
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
                                <span>{{$product->category->name}}</span>
                                <h5><a href="{{route('product', $product)}}">{{$product->name}}</a></h5>
                                <div class="product__item__price">{{convertPrice($product->price)}}<span>{{convertPrice(initialPrice($product->price, $product->discount))}}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/assets/frontend/img/banner/banner-1.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/assets/frontend/img/banner/banner-2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm mới nhất</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter" id="MixItUpBADF16">
                @foreach ($latestProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg-prod"
                                data-setbg="{{$product->image}}">
                                @if ($product->discount)
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
                                <span>{{$product->category->name}}</span>
                                <h5><a href="{{route('product', $product)}}">{{$product->name}}</a></h5>
                                <div class="product__item__price">{{convertPrice($product->price)}}<span>{{convertPrice(initialPrice($product->price, $product->discount))}}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>Bài viết</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($newPosts as $post)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{$post->thumbnail}}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{date_format($post->created_at, 'd/m/Y')}}</li>
                                    <li><i class="fa fa-eye"></i> {{$post->view}}</li>
                                </ul>
                                <h5><a href="{{route('blog.detail', $post)}}">{{$post->title}}</a></h5>
                                <p>{{$post->shortContent($post->content)}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection