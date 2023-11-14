<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Max book | Bán sách trực tuyến</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/assets/frontend/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="/"><img src="/assets/frontend/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                @if (Auth::check())
                    <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>{{Auth::guard('web')->user()->favoriteProducts->count()}}</span></a></li>
                @else
                    <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i></a></li>
                @endif
                <li><a href="{{route('cart')}}"><i class="fa fa-shopping-basket"></i> <span>{{ session('cart') !== null ? count(session('cart')) : 0 }}</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <div class="header__top__right__auth">
                    @if (!Auth::guard('web')->check())
                        <a href="{{route('login')}}"><i class="fa fa-user"></i> Đăng nhập</a>
                    @else
                        <a href="{{route('account')}}"><i class="fa fa-user"></i>{{Auth::guard('web')->user()->name}}</a>
                    @endif
                </div>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('home')}}">Trang chủ</a></li>
                <li><a href="{{route('shop')}}">Cửa hàng</a></li>
                <li><a href="#">Tác giả</a>
                    <ul class="header__menu__dropdown">
                        @foreach ($authors as $author)
                        	<li><a href="{{route('author', $author)}}">{{$author->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{route('blog')}}">Bài viết</a></li>
                <li><a href="{{route('contact')}}">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social"> </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> bookstore@yomail.com</li>
                <li>Miễn phí vận chuyển cho tất cả đơn hàng từ 99,000đ</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> bookstore@yomail.com</li>
                                <li>Miễn phí vận chuyển cho tất cả đơn hàng từ 199,000đ</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        @if (Auth::guard('web')->check())
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{route('account')}}"><i class="fa fa-user mr-2"></i>{{Auth::guard('web')->user()->name}}</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{route('logout')}}">Đăng xuất</a>
                                </div>
                            </div>
                        @else
                            <div class="header__top__right">
                                <div class="header__top__right__social">
                                    <a href="{{route('login')}}">Đăng nhập</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{route('register')}}">Đăng ký</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="/assets/frontend/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{request()->is('/') ? 'active' : '' }}"><a href="{{route('home')}}">Trang chủ</a></li>
                            <li class="{{request()->segment(1) === 'cua-hang' ? 'active' : '' }}" ><a href="{{route('shop')}}">Cửa hàng</a></li>
                            <li class=" {{request()->segment(1) === 'tac-gia' ? 'active' : '' }}" ><a href="#">Tác giả</a>
                                <ul class="header__menu__dropdown">
                                    @foreach ($authors as $author)
                                        <li><a href="{{route('author', $author)}}">{{$author->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class=" {{request()->segment(1) === 'bai-viet' ? 'active' : '' }}"><a href="{{route('blog')}}">Bài viết</a></li>
                            <li class=" {{request()->segment(1) === 'lien-he' ? 'active' : '' }}" ><a href="{{route('contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @if (Auth::check())
                                <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i> <span>{{Auth::guard('web')->user()->favoriteProducts->count()}}</span></a></li>
                            @else
                                <li><a href="{{route('favorite')}}"><i class="fa fa-heart"></i></a></li>
                            @endif
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-basket"></i> <span>{{ session('cart') !== null ? count(session('cart')) : 0 }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng tiền: <span>{{session('total_price') ?? 0}}đ</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Tất cả thể loại</span>
                        </div>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{route('category', $category)}}">{{$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{route('shop')}}" method="GET">
                                <input type="text" value="{{request('search')}}" name="search" placeholder="Tìm kiếm sách mong muốn">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    @yield('content')

     <!-- Footer Section Begin -->
     <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="/assets/frontend/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: bookstore@yomail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Hỗ trợ khách hàng</h6>
                        <ul>
                            <li><a href="#">Hướng dẫn mua hàng</a></li>
                            <li><a href="#">Chính sách sản phẩm</a></li>
                            <li><a href="#">Chính sách vận chuyển</a></li>
                            <li><a href="#">Chính sách đổi trả & bảo hành</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Nhận thông báo ưu đãi</h6>
                        <p>Nhận thông tin cập nhật qua e-mail về các ưu đãi đặc biệt.</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập địa chỉ email">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script> All rights reserved 
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="/assets/frontend/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Js Plugins -->
    <script src="/assets/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/frontend/js/bootstrap.min.js"></script>
    <script src="/assets/frontend/js/jquery.nice-select.min.js"></script>
    <script src="/assets/frontend/js/jquery-ui.min.js"></script>
    <script src="/assets/frontend/js/jquery.slicknav.js"></script>
    <script src="/assets/frontend/js/mixitup.min.js"></script>
    <script src="/assets/frontend/js/owl.carousel.min.js"></script>
    <script src="/assets/frontend/js/main.js"></script>



</body>

</html>