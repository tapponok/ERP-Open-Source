<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\TeamsController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\UnitController;
use \App\Http\Controllers\GarageController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\SupplierController;
use \App\Http\Controllers\PurchaseOrderController;
use \App\Http\Controllers\GroupProductController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\permissionController;
use \App\Http\Controllers\PurchaseInvoiceController;
use \App\Http\Controllers\ReceiveOrderController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\salesInvoiceController;
use App\Http\Controllers\SalesorderController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\TeamController;
use Spatie\Permission\Contracts\Permission;

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


Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/ajax/getpuchaseorder', [AjaxController::class, 'getpurchaseorder'])->name('ajax.getpurchaseorder');
    Route::get('/ajax/getpodetail/{id}', [AjaxController::class, 'getpodetail'])->name('ajax.getpodetail');
    Route::get('/ajax/getdataproduct/{id}', [AjaxController::class, 'getdataproduct'])->name('ajax.getdataproduct');
    Route::post('/ajax/getproduct', [AjaxController::class, 'getproduct'])->name('ajax.getproduct');
    Route::post('/ajax/getproductreceive', [AjaxController::class, 'getproductreceive'])->name('ajax.getproductreceive');
    Route::get('/ajax/getproductdetai/{id}', [AjaxController::class, 'getproductdetail'])->name('ajax.getproductdetail');
    Route::post('/ajax/getstockitem', [AjaxController::class, 'getstockitem'])->name('ajax.getstockitem');
    Route::get('stockitem/index', [StockItemController::class, 'index'])->name('stockitem.index');
    Route::get('stockitem/stocklogs', [StockItemController::class, 'stocklogs'])->name('stockitem.stocklogs');
    Route::post('/ajax/setrolepermission', [AjaxController::class, 'setrolepermission'])->name('ajax.setrolepermission');
    Route::resource('product', ProductController::class);
    Route::resource('product', ProductController::class);
    Route::resource('groupproduct', GroupProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('stockopname', StockOpnameController::class);
    Route::resource('receiveorder', ReceiveOrderController::class);
    Route::put('collectionproduct/add/{id}', [GroupProductController::class, 'collectionadd'])->name('collectionproduct.add');
    Route::put('collectionproduct/delete/{id}', [GroupProductController::class, 'collectiondestroy'])->name('collectionproduct.delete');
    Route::put('receiveorder/approve/{id}', [ReceiveOrderController::class, 'approve'])->name('receiveorder.approve');
    Route::put('receiveorder/cancel/{id}', [ReceiveOrderController::class, 'cancel'])->name('receiveorder.cancel');
    Route::put('/stockopname/approve/{id}', [StockOpnameController::class, 'approve'])->name('stockopname.approve');
    Route::put('/stockopname/cancel/{id}', [StockOpnameController::class, 'cancel'])->name('stockopname.cancel');
    Route::resource('supplier', SupplierController::class);
    Route::resource('purchaseorder', PurchaseOrderController::class);
    Route::post('/purchaseinvoice/submit/{id}', [PurchaseInvoiceController::class, 'submit'])->name('purchaseinvoice.submit');
    Route::get('/purchaseinvoice', [PurchaseInvoiceController::class, 'index'])->name('purchaseinvoice.index');
    Route::get('/purchaseinvoice/show/{id}', [PurchaseInvoiceController::class, 'show'])->name('purchaseinvoice.show');
    Route::get('/purchaseinvoice/pdf/{id}', [PurchaseInvoiceController::class, 'createpdf'])->name('purchaseinvoice.downloadpdf');
    Route::put('/purchaseinvoice/approve/{id}', [PurchaseInvoiceController::class, 'approve'])->name('purchaseinvoice.approve');
    Route::put('/purchaseinvoice/cancel/{id}', [PurchaseInvoiceController::class, 'cancell'])->name('purchaseinvoice.cancel');
    Route::put('/purchaseorder/approve/{id}', [PurchaseOrderController::class, 'approve'])->name('purchaseorder.approve');
    Route::put('/purchaseorder/cancel/{id}', [PurchaseOrderController::class, 'cancell'])->name('purchaseorder.cancel');
    Route::group(['prefix'=>'/user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{user}',[UserController::class, 'update'])->name('user.update');
        Route::put('/updatepassword/{user}',[UserController::class, 'updatepassword'])->name('user.updatepassword');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/detail/{user}', [UserController::class, 'show'])->name('user.show');
        Route::get('/user/detailself', [UserController::class, 'detailself'])->name('user.detailself');
        Route::post('/user/updateself', [UserController::class, 'updateself'])->name('user.updateself');
        Route::post('/user/uprofilepassword', [UserController::class, 'uprofilepassword'])->name('user.uprofilepassword');
    });
    // Route::resource('/permissions', permissionController::class);
    Route::post('/ajax/getusers', [AjaxController::class, 'getusers'])->name('ajax.getusers');
    Route::post('/salesinvoice/getsalesorder', [salesInvoiceController::class, 'getSalesOrder'])->name('salesinvoice.getsalesorder');
    Route::post('/salesinvoice/createsalesinvoice', [salesInvoiceController::class, 'CreateSalesInvoice'])->name('salesinvoice.CreateSalesInvoice');
    // Route::put('permissionuser/add/{id}', [permissionController::class, 'permissionuser'])->name('permissionuser.add');
    // Route::put('permissionuser/deleteuser/{id}', [permissionController::class, 'deleteuser'])->name('permissionuser.deleteuser');

    Route::resource('garage', GarageController::class);

    Route::resource('/roles', roleController::class);
    Route::put('roles/add/{id}', [roleController::class, 'roleuser'])->name('roleuser.add');
    Route::put('roles/deleteuser/{id}', [roleController::class, 'deleteuser'])->name('roleuser.deleteuser');

    Route::resource('team', TeamController::class);
    Route::resource('partnership', PartnershipController::class);
    Route::resource('payment', PaymentController::class);
    Route::post('salesorder/submit/{id}', [SalesorderController::class, 'submit'])->name('salesorder.submit');
    Route::post('salesorder/approve/{id}', [SalesorderController::class, 'approve'])->name('salesorder.approve');
    Route::post('salesorder/reject/{id}', [SalesorderController::class, 'reject'])->name('salesorder.reject');
    Route::resource('salesorder', SalesorderController::class);
    Route::resource('salesinvoice', salesInvoiceController::class);
});

