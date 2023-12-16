<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

// login, register
Route::middleware('permit_auth')->group(function () {

    Route::redirect('/', 'loginPage');
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {

    //classify Admin Or User
    Route::get('/dashboard', [AuthController::class, 'dashboard']);

    //Admin
    Route::middleware('admin_auth')->group(function () {

        Route::prefix('admin')->group(function () {

            //category
            Route::prefix('category')->group(function () {
                Route::get('/list', [CategoryController::class, 'list'])->name('category#list');
                Route::get('/createPage', [CategoryController::class, 'createPage'])->name('category#cratePage');
                Route::post('/create', [CategoryController::class, 'createBtn'])->name('category#createBtn');
                Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
                Route::get('/editPage/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
                Route::post('/update/{id}', [CategoryController::class, 'updateBtn'])->name('category#updateBtn');
            });

            //password
            Route::prefix('password')->group(function () {
                Route::get('/changePage', [AdminController::class, 'changePassPage'])->name('admin#changePassPage');
                Route::post('changeBtn', [AdminController::class, 'changePassBtn'])->name('admin#changePassBtn');
            });

            //account
            Route::prefix('account')->group(function () {
                Route::get('/detailsPage', [AdminController::class, 'detailsPage'])->name('admin#accountDetailsPage');
                Route::get('/edit', [AdminController::class, 'editPage'])->name('admin#editDetailsPage');
                Route::post('/edit/confirm', [AdminController::class, 'confirmBtn'])->name('admin#detailsConfirmBtn');
                Route::get('/admins/list', [AdminController::class, 'adminList'])->name('admin#list');
                Route::get('remove/{id}', [AdminController::class, 'removeAdmin'])->name('admin#remove');
                Route::get('changeRole/{id}', [AdminController::class, 'changeRolePage'])->name('admin#changeRolePage');
                Route::post('changeRole/{id}', [AdminController::class, 'roleChangeBtn'])->name('admin#changeRoleBtn');
                Route::get('ajax/change/role', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            });

            //users
            Route::prefix('user')->group(function () {
                Route::get('/ist', [AdminController::class, 'userList'])->name('admin#userList');
                Route::post('changeto/admin/{id}', [AdminController::class, 'toAdminBtn'])->name('admin#toAdmin');
                Route::get('remove/{id}', [AdminController::class, 'removeUsers'])->name('admin#removeUser');
                Route::get('/feedback', [AdminController::class, 'feedback'])->name('admin#userFeedback');
                Route::get('remove/feedbacks/{id}', [AdminController::class, 'removeFeedback'])->name('admim#removeFeedback');
            });

            //product
            Route::prefix('product')->group(function () {
                //product
                Route::get('listPage', [ProductController::class, 'listPage'])->name('product#listPage');
                Route::get('addPage', [ProductController::class, 'addPage'])->name('product#addPage');
                Route::post('createPizza', [ProductController::class, 'createBtn'])->name('product#createBtn');
                Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
                Route::get('/viewPage/{id}', [ProductController::class, 'viewPage'])->name('product#viewPage');
                Route::get('/editPage/{id}', [ProductController::class, 'editPage'])->name('product#editPage');
                Route::post('/edit/confirm', [ProductController::class, 'confirmBtn'])->name('product#confirmBtn');
            });

            //order
            Route::prefix('orders')->group(function () {
                Route::get('/list', [OrderController::class, 'orderList'])->name('admin#orderList');
                Route::get('/status', [OrderController::class, 'orderStatus'])->name('admin#orderStatus');
                Route::get('/change/status', [OrderController::class, 'changeOrderStatus'])->name('admin#changeOrderStatus');
                Route::get('detail/{orderCode}', [OrderController::class, 'orderDetail'])->name('admin#orderDetail');
            });
        });
    });

    //user
    Route::middleware('user_auth')->group(function () {

        route::prefix('user')->group(function () {

            //home
            Route::get('/shop', [UserController::class, 'shopPage'])->name('user#shop');
            Route::get('/contact', [UserController::class, 'contactUs'])->name('user#contactUsPage');
            Route::post('/contact/submit', [UserController::class, 'contactSubmit'])->name('user#contactSubmit');

            //products
            Route::prefix('product')->group(function () {
                Route::get('/details/{id}', [UserController::class, 'productDetail'])->name('user#productDetail');
                Route::get('viewCounts', [UserController::class, 'viewCount'])->name('user#viewCount');
            });

            //password
            Route::prefix('password')->group(function () {
                Route::get('/change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
                Route::post('/change', [UserController::class, 'changePasswordBtn'])->name('user#changePassBtn');
            });

            //account
            Route::prefix('account')->group(function () {
                Route::get('details', [UserController::class, 'accountDetailsPage'])->name('user#accDetailsPage');
                Route::get('editDetails', [UserController::class, 'editDetailsPage'])->name('user#editDetailsPage');
                Route::post('edit/confirm', [UserController::class, 'editConfirm'])->name('user#editConfirm');
            });

            //sorting
            Route::get('products/sort', [AjaxController::class, 'SortProducts']);

            //filter
            Route::get('/category/filter/{id}', [UserController::class, 'filter'])->name('user#categoryFilter');

            //Cart
            Route::prefix('cart')->group(function () {
                Route::get('singleAdd', [AjaxController::class, 'singleAddCart'])->name('user#singleAddCart');
                Route::get('add', [AjaxController::class, 'addCart'])->name('user#addCart');
                Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');
                Route::get('order', [AjaxController::class, 'order'])->name('user#cartOrderBtn');
                Route::get('orderList', [UserController::class, 'orderList'])->name('user#orderList');
                Route::get('single/remove', [AjaxController::class, 'removeSingleCart'])->name('user#removeSingleCart');
                Route::get('clear', [AjaxController::class, 'clearCart'])->name('user#clearCart');
            });
        });
    });

});
