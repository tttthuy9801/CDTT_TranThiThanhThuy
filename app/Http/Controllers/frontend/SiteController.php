<?php
//id slug table_id type
namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Link;

use App\Models\Product;

use App\Models\Category;
use App\Models\Post;

class SiteController extends Controller
{
    public function index($slug = null)
    {
        if ($slug == null) {
            return $this->home();
        } else {
            $link = Link::where('slug', '=', $slug)->first();
            if ($link != NULL) {
                $type = $link->type;
                switch ($type) {
                    case 'category ': {
                            return $this->product_category($slug);
                        }
                    case 'brand ': {
                            return $this->product_brand($slug);
                        }
                    case 'topic ': {
                            return  $this->post_topic($slug);
                        }
                    case 'page ': {
                            return $this->post_pagec($slug);
                        }
                }
            } else {
                $product = Product::where([['slug', '=', $slug], ['status', '=', 1]])->first();

                if ($product != NULL) {
                    return $this->product_detail($product);
                } else {
                    $post = Post::where(['slug', '=', $slug], ['status', '=', 1], ['type', '=', 'post'])->first();
                    if ($post != NULL) {
                        return $this->post_detail($post);
                    } else {
                        return $this->eror_404($slug);
                    }
                }
            }
        }
    }
    #HOME
    private function home()
    {
        $title = "TRANG CHU - NLD_MARKET";
        $args = [
            ['status', '=', '1'],
            ['parent_id', '=', '0']
        ];
        $list_category = Category::where($args)->orderBy('sort_order')->get();
        return view('frontend.home', compact('list_category', 'title'));
    }
    #PRODUCT
    public function product()
    {
        $title = 'Tất cả sản phẩm';
        $list_product = product::where('status', '=', '1')
            ->orderby('created_at', 'DESC')
            ->paginate(16);
        return view('frontend.product', compact('list_product', 'title'));
    }
    #product-category
    private function product_category($slug)
    {
        $title = 'Sản phẩm theo loại';
        $list_product = product::where('status', '=', '1')
            ->orderby('category_id', 'DESC')
            ->paginate(16);
        return view('frontend.product_category', compact('list_product', 'title'));
    }
    private function product_brand($slug)
    {
        $title = 'Sản phẩm theo thương hiệu';
        $list_product = product::where('status', '=', '1')
            ->orderby('brand_id', 'DESC')
            ->paginate(16);
        return view('frontend.product_brand', compact('list_product', 'title'));
    }
    private function product_detail($product)
    {

        $title = 'Sản phẩm theo thương hiệu';
        $list_product = product::where('status', '=', '1')
            ->orderby('id')
            ->paginate(16);
        return view('frontend.product_detail', compact('product', 'list_product', 'title'));
    }
    #post
    private function post()
    {
        return view('frontend.post');
    }
    #post_topic
    private function post_topic($slug)
    {
        return view('frontend.post-topic');
    }
    #post_page
    private function post_page($slug)
    {
        return view('frontend.post-page');
    }
    #post_detail
    private function post_detail($post)
    {
        return view('frontend.post-detail', compact('post'));
    }

    #eror_404
    private function error_404($slug)
    {
        return view('frontend.404');
    }
}
