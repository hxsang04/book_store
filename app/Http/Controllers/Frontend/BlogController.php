<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function blog(){
        $posts = Post::orderByDesc('id')->paginate(6);
        $topPosts = Post::orderByDesc('view')->limit(5)->get();
        return view('frontend.blog', compact('posts','topPosts'));
    }

    public function blogDetail(Post $post){
        $topPosts = Post::orderByDesc('view')->limit(5)->get();
        $post->view +=1;
        $post->save();
        return view('frontend.blog-details', compact('post','topPosts'));
    }
}
