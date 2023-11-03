@extends('frontend.layout.master')

@section('content')
    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{$post->thumbnail}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{$post->title}}</h2>
                        <ul>
                            <li>By {{$post->admin->name}}</li>
                            <li>{{ date_format($post->created_at,'d/m/Y')}}</li>
                            <li>{{$post->view}} Lượt xem</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
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
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        {!! $post->content !!}
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{asset('assets/frontend/img/no-avatar.png')}}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{$post->admin->name}}</h6>
                                        <span>{{$post->admin->role}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Danh mục:</span> {{$post->postType->name}}</li>
                                        <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                    </ul>
                                    <div class="blog__details__social">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-envelope"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

@endsection