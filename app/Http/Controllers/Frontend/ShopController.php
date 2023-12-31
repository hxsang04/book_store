<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Author;
use App\Models\Post;

class ShopController extends Controller
{
    public function index(){
        $topSellingProducts = Product::orderByDesc('sold')->get()->take(8);
        $discountProducts = Product::where('discount', '>', 0)->orderByDesc('id')->limit(10)->get();
        $newPosts = Post::orderByDesc('id')->limit(3)->get();
        $latestProducts = Product::orderByDesc('id')->limit(8)->get();
        return view('frontend.index', compact('discountProducts','topSellingProducts', 'newPosts', 'latestProducts'));
    }

    public function shop(Request $request){
        $keyword = $request->input('search');
       
        $products = Product::when($keyword, function($query,$keyword){
            return $query->where('name','like',"%$keyword%");
        });
        
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);
        return view('frontend.shop', compact('products'));
    }

    public function product(Product $product){
        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '<>', $product->id)
                            ->limit(10)
                            ->get();
        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function getProductByCategory(Category $category, Request $request){
        
        $products = Product::where('category_id',$category->id);
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);

        return view('frontend.shop',compact('products'));
    }

    public function getProductByAuthor(Author $author, Request $request){
        
        $products = Product::where('author_id',$author->id);
        $products = $this->filter($products, $request);
        $products = $this->sortByAndPaginate($products, $request);

        return view('frontend.shop',compact('products'));
    }

    protected function filter($products, $request){
        
        /* Nhà xuất bản filter */
        $publishers = $request->input('nxb') ?? [];
        $arr_publishers = array_keys($publishers);

        $products = $products->when($arr_publishers, function($query, $arr_publishers){
            return $query->whereIn('publisher_id', $arr_publishers);
        });

        /* Tác giả filter */
        $authors = $request->input('tac-gia') ?? [];
        $arr_authors = array_keys($authors);

        $products = $products->when($arr_authors, function($query, $arr_authors){
            return $query->whereIn('author_id', $arr_authors);
        });

        $min_price = $request->input('min_price');
        $max_price = $request->input('max_price');

        $products = ($min_price != null && $max_price != null) 
                    ? $products->whereBetween('price', [$min_price, $max_price]) : $products;

        return $products;
    }

    protected function sortByAndPaginate($products,Request $request){
        $sortBy = $request->input('sort_by') ?? 'latest';
        
        switch ($sortBy) {
            case 'latest':
                $products = $products->orderByDesc('id');
                break;
            case 'oldest':
                $products = $products->orderBy('id');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-desending':
                $products = $products->orderByDesc('price');
                break;
            case 'discount':
                $products = $products->where('discount', '<>', 0)->orderByDesc('discount');
                break;
            default: $products = $products->orderByDesc('id');
        }

        $perPage = $request->input('show') ?? '9';

        $products = $products->paginate($perPage);
        $products->appends(['sort_by' => $sortBy , 'show' => $perPage]);

        return $products;
    }

    public function contact(){
        return view('frontend.contact');
    }
}
