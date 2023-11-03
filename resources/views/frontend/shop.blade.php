@extends('frontend.layout.master')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/assets/frontend/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Cửa hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('home')}}">Trang chủ</a>
                            <span>Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <form action="">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="sidebar">
                            <div class="sidebar__item">
                                <h4>Thể loại</h4>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li class="{{request()->segment(2) == $category->id ? 'active' : ''}} " ><a href="{{route('category', $category)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="sidebar__item">
                                <h4>Giá</h4>
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="0" data-max="500000">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" id="minamount" name="min_price">
                                            <input type="text" id="maxamount" name="max_price">
                                            <span class="text-danger"><b>(đ)</b></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn text-white mt-2 px-3" style="background: #7fad39">Lọc</button>
                            </div>
                            <div class="sidebar__item">
                                <h4>Nhà xuất bản</h4>
                                @foreach($publishers as $publisher)
                                    <div class="sidebar__item__publisher">
                                        <input type="checkbox" name="nxb[{{$publisher->id}}]" id="{{$publisher->name}}" 
                                        {{ (request('nxb')[$publisher->id] ?? '' ) == 'on' ? 'checked' : ''}} onchange="this.form.submit()">
                                        <label for="{{$publisher->name}}">
                                            {{$publisher->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="sidebar__item">
                                <h4>Tác giả hàng đầu</h4>
                                @foreach ($authors as $author)
                                    <div class="sidebar__item__author">
                                        <input type="checkbox" name="tac-gia[{{$author->id}}]" id="{{$author->name}}"
                                        {{ (request('tac-gia')[$author->id] ?? '' ) == 'on' ? 'checked' : ''}} onchange="this.form.submit()">
                                        <label for="{{$author->name}}">
                                            {{$author->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="sidebar__item">
                                <div class="latest-product__text">
                                    <h4>Bán chạy trong tuần</h4>
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($topProducts as $product)
                                            <a href="{{route('product', $product)}}" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{$product->image}}" alt="" width="100">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$product->name}}</h6>
                                                    <span>{{convertPrice($product->price)}}đ</span>
                                                    <div class="text-warning">Đã bán {{$product->totalSold}}</div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="filter__item">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    @if(request('search'))
                                        <h4>Kết quả tìm kiếm cho từ khóa: "{{request('search')}}"</h4>
                                    @else
                                        <div class="filter__sort">
                                            <span>Sắp xếp:</span>
                                            <select name="sort_by" onchange="this.form.submit()">
                                                <option {{ request('sort_by') == 'lastest' ? 'selected' : ''}} value="latest">Mới nhất</option>
                                                <option {{ request('sort_by') == 'oldest' ? 'selected' : ''}} value="oldest">Cũ nhất</option>
                                                <option {{ request('sort_by') == 'price-ascending' ? 'selected' : ''}} value="price-ascending">Giá tăng dần</option>
                                                <option {{ request('sort_by') == 'price-desending' ? 'selected' : ''}} value="price-desending">Giá giảm dần</option>
                                                <option {{ request('sort_by') == 'discount' ? 'selected' : ''}} value="discount">Giảm giá</option>
                                            </select>

                                            <select name="show" onchange="this.form.submit()">
                                                <option {{ request('show') == '9' ? 'selected' : ''}} value="9">9</option>
                                                <option {{ request('show') == '6' ? 'selected' : ''}} value="6">6</option>
                                                <option {{ request('show') == '12' ? 'selected' : ''}} value="12">12</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="filter__found">
                                        <h6 class="text-right">Hiển thị {{$products->firstItem()}} đến {{$products->lastItem()}} trong {{$products->total()}} sản phẩm</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6">
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
                                            <span>{{$product->category->name}}</span>
                                            <h5><a href="{{route('product', $product)}}">{{$product->name}}</a></h5>
                                            <div class="product__item__price">{{convertPrice($product->price)}}
                                                @if ($product->discount > 0)
                                                    <span>{{convertPrice(initialPrice($product->price, $product->discount))}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $products->links()}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Product Section End -->

@endsection