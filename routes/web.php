<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainUserController;
use App\Http\Controllers\MainAdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/ 

Route::get('/', function () {
    return view('pages.index');
    //return view('welcome');
});
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('user.index');
})->name('dashboard');
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

//User All Route
Route::get('/user/logout', [MainUserController::class, 'Logout'])->name('user.logout');
Route::get('/user/profile', [MainUserController::class, 'UserProfile'])->name('user.profile');
Route::get('/user/profile/edit', [MainUserController::class, 'UserProfileEdit'])->name('profile.edit');
Route::post('/user/profile/store', [MainUserController::class, 'UserProfileStore'])->name('profile.store');
Route::get('/user/password/view', [MainUserController::class, 'UserPasswordView'])->name('user.password.view');
Route::post('/user/password/update', [MainUserController::class, 'UserPasswordUpdate'])->name('password.update');

//Admin All Route
Route::get('/admin/profile', [MainAdminController::class, 'AdminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [MainAdminController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [MainAdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [MainAdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/change/password', [MainAdminController::class, 'AdminChangePasswordUpdate'])->name('admin.password.update');

//Admin Section
//categories
Route::get('/admin/categories', [CategoryController::class, 'Category'])->name('categories');
Route::post('/admin/store/categories', [CategoryController::class, 'StoreCategory'])->name('store.category');
Route::get('delete/category/{id}', [CategoryController::class, 'DeleteCategory']);
Route::get('edit/category/{id}', [CategoryController::class, 'EditCategory']);
Route::post('update/category/{id}', [CategoryController::class, 'UpdateCategory']);

//Brands
Route::get('/admin/brands', [BrandController::class, 'Brand'])->name('brands');
Route::post('/admin/store/brand', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('delete/brand/{id}', [BrandController::class, 'DeleteBrand']);
Route::get('edit/brand/{id}', [BrandController::class, 'EditBrand']);
Route::post('update/brand/{id}', [BrandController::class, 'UpdateBrand']);

//Product All Route
Route::get('admin/product/all', [ProductController::class, 'Index'])->name('all.product');
Route::get('admin/product/add', [ProductController::class, 'Create'])->name('add.product');
Route::post('admin/store/product', [ProductController::class, 'Store'])->name('store.product');

Route::get('inactive/product/{id}', [ProductController::class, 'Inactive']);
Route::get('active/product/{id}', [ProductController::class, 'Active']);
Route::get('delete/product/{id}', [ProductController::class, 'DeleteProduct']);
Route::get('view/product/{id}', [ProductController::class, 'ViewProduct']);

Route::get('edit/product/{id}', [ProductController::class, 'EditProduct']);
Route::post('update/product/withoutphoto/{id}', [ProductController::class, 'UpdateProductWithoutPhoto']);
Route::post('update/product/photo/{id}', [ProductController::class, 'UpdateProductPhoto']);

//Add wishlist
Route::get('add/wishlist/{id}', [WishlistController::class, 'AddWishlist']);

//Add to Cart Route
Route::get('add/to/cart/{id}', [CartController::class, 'AddCart']);
Route::get('check', [CartController::class, 'Check']);
Route::get('product/cart', [CartController::class, 'ShowCart'])->name('show.cart');
Route::get('remove/cart/{rowId}', [CartController::class, 'RemoveCart']);

Route::post('update/cart/item', [CartController::class, 'UpdateCart'])->name('update.cartitem');

Route::get('/cart/product/view/{id}', [CartController::class, 'ViewProduct']);
Route::post('insert/into/cart/', [CartController::class, 'InsertCart'])->name('insert.into.cart');

Route::get('user/checkout', [CartController::class, 'CheckOut'])->name('user.checkout');

Route::get('user/wishlist', [CartController::class, 'Wishlist'])->name('user.wishlist');



Route::get('product/details/{id}/{product_name}', [ProductController::class, 'ProductView']);




Route::post('cart/product/add/{id}', [ProductController::class, 'AddCart']);


//Payment Step

Route::get('payment/page', [CartController::class, 'PaymentPage'])->name('payment.step');
Route::post('user/payment/process', [PaymentController::class, 'Payment'])->name('payment.process');
Route::post('user/stripe/charge', [PaymentController::class, 'StripeCharge'])->name('stripe.charge');


//Product detail shope page
Route::get('product/{id}', [ProductController::class, 'CategoryProductView']);