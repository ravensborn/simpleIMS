<?php

use App\Livewire\Dashboard\AppExpired;
use App\Livewire\Dashboard\Customers\Index as CustomerIndex;
use App\Livewire\Dashboard\Customers\Show as CustomerShow;
use App\Livewire\Dashboard\Customers\Edit as CustomerEdit;
use App\Livewire\Dashboard\Customers\Create as CustomerCreate;

use App\Livewire\Dashboard\Home;
use App\Livewire\Dashboard\Products\Index as ProductIndex;
use App\Livewire\Dashboard\Products\Show as ProductShow;
use App\Livewire\Dashboard\Products\Edit as ProductEdit;
use App\Livewire\Dashboard\Products\Create as ProductCreate;

use App\Livewire\Dashboard\Products\Inventories\Index as ProductInventoryIndex;
use App\Livewire\Dashboard\Products\Inventories\Create as ProductInventoryCreate;
use App\Livewire\Dashboard\Products\Inventories\Edit as ProductInventoryEdit;

use App\Livewire\Dashboard\Orders\Index as OrderIndex;
use App\Livewire\Dashboard\Orders\Show as OrderShow;
use App\Livewire\Dashboard\Orders\Edit as OrderEdit;
use App\Livewire\Dashboard\Orders\Create as OrderCreate;
use App\Livewire\Dashboard\Orders\Invoice as OrderInvoice;

use App\Livewire\Dashboard\Orders\OrderItems\Index as OrderItemIndex;
use App\Livewire\Dashboard\Orders\OrderPayments\Invoice as OrderPaymentInvoice;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false, 'logout' => false]);

Route::get('/logout', function () {

    auth()->logout();

    return redirect()->route('login');

})->name('logout');


Route::get('/app-expired', AppExpired::class)->name('app-expired');

Route::middleware(['auth', 'checkSubscription'])->group(function () {

    Route::get('/', Home::class)->name('home');



    Route::prefix('customers')->as('customers.')->group(function () {
        Route::get('/', CustomerIndex::class)->name('index');
        Route::get('/create', CustomerCreate::class)->name('create');
        Route::get('/{customer}', CustomerShow::class)->name('show');
        Route::get('/{customer}/edit', CustomerEdit::class)->name('edit');
    });

    Route::prefix('products')->as('products.')->group(function () {
        Route::get('/', ProductIndex::class)->name('index');
        Route::get('/create', ProductCreate::class)->name('create');
        Route::get('/{product}', ProductShow::class)->name('show');
        Route::get('/{product}/edit', ProductEdit::class)->name('edit');

        Route::prefix('{product}/inventories')->as('inventories.')->group(function () {
            Route::get('/', ProductInventoryIndex::class)->name('index');
            Route::get('/create', ProductInventoryCreate::class)->name('create');
            Route::get('/{inventory}/edit', ProductInventoryEdit::class)->name('edit');
        });
    });

    Route::prefix('orders')->as('orders.')->group(function () {

        Route::get('/', OrderIndex::class)->name('index');
        Route::get('/create', OrderCreate::class)->name('create');
        Route::get('/{order}', OrderShow::class)->name('show');
        Route::get('/{order}/edit', OrderEdit::class)->name('edit');
        Route::get('/{order}/invoice', OrderInvoice::class)->name('invoice');

        Route::prefix('{order}/order-items')->as('order-items.')->group(function () {
            Route::get('/', OrderItemIndex::class)->name('index');
        });

        Route::prefix('{order}/payments/{orderPayment}/invoice')->as('order-payments.')->group(function () {
            Route::get('/', OrderPaymentInvoice::class)->name('invoice');
        });

    });
});
