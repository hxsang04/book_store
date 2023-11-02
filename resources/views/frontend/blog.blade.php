
@extends('frontend.layout.master')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('assets/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Bài viết</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Bài viết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <h4>Bài viết được xem nhiều</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($topPosts as $topPost)
                                    <a href="{{route('blog.detail', $topPost)}}" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic">
                                            <img src="{{$topPost->thumbnail}}" alt="" height="70">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{$topPost->title}}</h6>
                                            <span>{{date_format($topPost->created_at,'d/m/Y')}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="{{$post->thumbnail}}" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{date_format($post->created_at,'d/m/Y')}}</li>
                                            <li><i class="fa fa-eye"></i> {{$post->view}}</li>
                                        </ul>
                                        <h5><a href="{{route('blog.detail', $post)}}">{{$post->title}}</a></h5>
                                        <div class="mb-3">{{ $post->shortContent($post->content)}}</div>
                                        <a href="{{route('blog.detail', $post)}}" class="blog__btn">Đọc thêm <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12">
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection