<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Support\Facades;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Product;
use DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer(['frontend.layout.master','frontend.shop'], function (View $view) {
            $categories = Category::all();
            $publishers = Publisher::all();
            $authors = Author::limit(8)->get();

            $sevenDaysAgo = now()->subDays(7);
            $topProduct_ids = Product::select('products.id as product_id', DB::raw('SUM(order_product.quantity) as totalSold'))
                    ->join('order_product', 'products.id', '=', 'order_product.product_id')
                    ->join('orders', 'order_product.order_id', '=', 'orders.id')
                    ->where('orders.created_at', '>=', $sevenDaysAgo)
                    ->groupBy('product_id')
                    ->orderByDesc('totalSold')
                    ->limit(3)
                    ->get();
            $topProducts = [];
            foreach ($topProduct_ids as $item) {
                $product = Product::find($item['product_id']);

                if ($product) {
                    $product->totalSold = $item['totalSold'];
                    $topProducts[] = $product;
                }
            }
            $view->with(compact('categories','publishers','authors','topProducts'));
        });
    }
}
