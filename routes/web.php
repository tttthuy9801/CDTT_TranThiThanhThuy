<?php

use Illuminate\Support\Facades\Route;
#Controller backend

use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ConfigController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\MenuController;
use App\Http\Controllers\backend\DashboarController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\OrderdetailController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\backend\TopicController;
#Controller frontent
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\frontend\LienheController;
use App\Http\Controllers\frontend\SearchController;
use App\Http\Controllers\frontend\CartController;
use App\Models\Category;
use PSpell\Config;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
///SITE
Route::get('/', [SiteController::class,'index'])->name('site.index');
Route::get('san-pham',[SiteController::class,'product'])->name('site.product');
Route::get('bai-viet', [SiteController::class, 'post'])->name('site.post');
Route::get('lien-he', [LienheController::class, 'index'])->name('site.contact');
Route::get('tim-kiem/{keyword}', [SearchController::class, 'index'])->name('site.search');
Route::get('gio-hang}', [CartController::class, 'index'])->name('site.cart');
Route::get('gio-hang/addcart', [CartController::class, 'index'])->name('site.cart.addcart');


///ADMIN
Route::get('admin/login',[AuthController::class,'getlogin'])->name('admin.getlogin');
Route::post('admin/login', [AuthController::class, 'postlogin'])->name('admin.postlogin');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::prefix('admin')->middleware('adminlogin')->group(function()
{
    //Trang bang dieu khien
    Route::get('/', [DashboarController::class,'index'])->name('dashboard.index');
    Route::get('product/trash',[ProductController::class,'trash'])->name('product.trash');
    Route::get('product/status/{product}', [ProductController::class, 'status'])->name('product.status');
    Route::get('product/delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('product/restore/{product}', [ProductController::class, 'restore'])->name('product.restore');
    Route::resource('product', ProductController::class);
    
    Route::get('category/trash',[CategoryController::class,'trash'])->name('category.trash');
    Route::get('category/status/{category}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('category/delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::resource('category', CategoryController::class);

    Route::get('config/trash',[ConfigController::class,'trash'])->name('config.trash');
    Route::get('config/status/{config}', [ConfigController::class, 'status'])->name('config.status');
    Route::get('config/delete/{config}', [ConfigController::class, 'delete'])->name('config.delete');
    Route::get('config/restore/{config}', [ConfigController::class, 'restore'])->name('config.restore');
    Route::resource('config', ConfigController::class);

    
    Route::get('brand/trash',[BrandController::class,'trash'])->name('brand.trash');
    Route::get('brand/status/{brand}', [BrandController::class, 'status'])->name('brand.status');
    Route::get('brand/delete/{brand}', [BrandController::class, 'delete'])->name('brand.delete');
    Route::get('brand/restore/{brand}', [BrandController::class, 'restore'])->name('brand.restore');
    Route::resource('brand', BrandController::class);

    Route::get('menu/trash',[MenuController::class,'trash'])->name('menu.trash');
    Route::get('menu/status/{menu}', [MenuController::class, 'status'])->name('menu.status');
    Route::get('menu/delete/{menu}', [MenuController::class, 'delete'])->name('menu.delete');
    Route::get('menu/restore/{menu}', [MenuController::class, 'restore'])->name('menu.restore');
    Route::resource('menu', MenuController::class);

    Route::get('contact/trash',[ContactController::class,'trash'])->name('contact.trash');
    Route::get('contact/status/{contact}', [ContactController::class, 'status'])->name('contact.status');
    Route::get('contact/delete/{contact}', [ContactController::class, 'delete'])->name('contact.delete');
    Route::get('contact/restore/{contact}', [ContactController::class, 'restore'])->name('contact.restore');
    Route::resource('contact', ContactController::class);

    Route::get('order/trash',[OrderController::class,'trash'])->name('order.trash');
    Route::get('order/status/{order}', [OrderController::class, 'status'])->name('order.status');
    Route::get('order/delete/{order}', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('order/restore/{order}', [OrderController::class, 'restore'])->name('order.restore');
    Route::resource('order', OrderController::class);

    Route::get('orderdetail/trash',[OrderdetailController::class,'trash'])->name('orderdetail.trash');
    Route::get('orderdetail/status/{orderdetail}', [OrderdetailController::class, 'status'])->name('orderdetail.status');
    Route::get('orderdetail/delete/{orderdetail}', [OrderdetailController::class, 'delete'])->name('orderdetail.delete');
    Route::get('orderdetail/restore/{orderdetail}', [OrderdetailController::class, 'restore'])->name('orderdetail.restore');
    Route::resource('orderdetail', OrderdetailController::class);

    Route::get('post/trash',[PostController::class,'trash'])->name('post.trash');
    Route::get('post/status/{post}', [postController::class, 'status'])->name('post.status');
    Route::get('post/delete/{post}', [postController::class, 'delete'])->name('post.delete');
    Route::get('post/restore/{post}', [postController::class, 'restore'])->name('post.restore');
    Route::resource('post', PostController::class);

    Route::get('slider/trash',[SliderController::class,'trash'])->name('slider.trash');
    Route::get('slider/status/{slider}', [SliderController::class, 'status'])->name('slider.status');
    Route::get('slider/delete/{slider}', [SliderController::class, 'delete'])->name('slider.delete');
    Route::get('slider/restore/{slider}', [SliderController::class, 'restore'])->name('slider.restore');
    Route::resource('slider', SliderController::class);

    Route::get('topic/trash',[TopicController::class,'trash'])->name('topic.trash');
    Route::get('topic/status/{topic}', [TopicController::class, 'status'])->name('topic.status');
    Route::get('topic/delete/{topic}', [TopicController::class, 'delete'])->name('topic.delete');
    Route::get('topic/restore/{topic}', [TopicController::class, 'restore'])->name('topic.restore');
    Route::resource('topic', TopicController::class);

    Route::get('user/trash',[UserController::class,'trash'])->name('user.trash');
    Route::get('user/status/{user}', [UserController::class, 'status'])->name('user.status');
    Route::get('user/delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/restore/{user}', [UserController::class, 'restore'])->name('user.restore');
    Route::resource('user', UserController::class);
});


///SITE
Route::get('{slug}', [SiteController::class, 'index'])->name('site.slug');
