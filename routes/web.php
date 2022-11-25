<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\CoreBisnisController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\BankAccController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CashOutController;
use App\Http\Controllers\CashInController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\TipeCashInController;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Route::prefix('divisi')->group(function(){
	Route::get('/', [DivisiController::class, 'index'])->name('divisi');
	Route::post('store', [DivisiController::class, 'store'])->name('divisi.store');
	Route::get('edit/{id}', [DivisiController::class, 'edit'])->name('divisi.edit');
	Route::post('update/{id}', [DivisiController::class, 'update'])->name('divisi.update');
	Route::post('delete/{id}', [DivisiController::class, 'destroy'])->name('divisi.destroy');
});

Route::prefix('coreBisnis')->group(function(){
	Route::get('/', [CoreBisnisController::class, 'index'])->name('coreBisnis');
	Route::post('store', [CoreBisnisController::class, 'store'])->name('coreBisnis.store');
	Route::get('edit/{id}', [CoreBisnisController::class, 'edit'])->name('coreBisnis.edit');
	Route::post('update/{id}', [CoreBisnisController::class, 'update'])->name('coreBisnis.update');
	Route::post('delete/{id}', [CoreBisnisController::class, 'destroy'])->name('coreBisnis.destroy');
});

Route::prefix('role')->group(function(){
	Route::get('/', [RoleController::class, 'index'])->name('role');
	Route::post('store', [RoleController::class, 'store'])->name('role.store');
	Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
	Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
	Route::post('delete/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});

Route::prefix('stages')->group(function(){
	Route::get('/', [StagesController::class, 'index'])->name('stages');
	Route::post('store', [StagesController::class, 'store'])->name('stages.store');
	Route::get('edit/{id}', [StagesController::class, 'edit'])->name('stages.edit');
	Route::post('update/{id}', [StagesController::class, 'update'])->name('stages.update');
	Route::post('delete/{id}', [StagesController::class, 'destroy'])->name('stages.destroy');
});

Route::prefix('userManagement')->group(function(){
	Route::get('/', [UserController::class, 'index'])->name('userManagement');
	Route::post('store', [UserController::class, 'store'])->name('userManagement.store');
	Route::get('edit/{id}', [UserController::class, 'edit'])->name('userManagement.edit');
	Route::post('update/{id}', [UserController::class, 'update'])->name('userManagement.update');
	Route::post('delete/{id}', [UserController::class, 'destroy'])->name('userManagement.destroy');
});

Route::prefix('companies')->group(function(){
	Route::get('/', [CompaniesController::class, 'index'])->name('companies');
	Route::post('store', [CompaniesController::class, 'store'])->name('companies.store');
	Route::get('edit/{id}', [CompaniesController::class, 'edit'])->name('companies.edit');
	Route::post('update/{id}', [CompaniesController::class, 'update'])->name('companies.update');
	Route::post('delete/{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
});

Route::prefix('contacts')->group(function(){
	Route::get('/', [ContactsController::class, 'index'])->name('contacts');
	Route::post('store', [ContactsController::class, 'store'])->name('contacts.store');
	Route::get('edit/{id}', [ContactsController::class, 'edit'])->name('contacts.edit');
	Route::post('update/{id}', [ContactsController::class, 'update'])->name('contacts.update');
	Route::post('delete/{id}', [ContactsController::class, 'destroy'])->name('contacts.destroy');
});

Route::prefix('deals')->group(function(){
	Route::get('/', [DealsController::class, 'index'])->name('deals');
	Route::get('create', [DealsController::class, 'create'])->name('deals.create');
	Route::post('store', [DealsController::class, 'store'])->name('deals.store');
	Route::get('edit/{id}', [DealsController::class, 'edit'])->name('deals.edit');
	Route::post('update/{id}', [DealsController::class, 'update'])->name('deals.update');
	Route::post('delete/{id}', [DealsController::class, 'destroy'])->name('deals.destroy');
	Route::get('downloadFileDeals/{id}', [DealsController::class, 'downloadFileDeals'])->name('deals.downloadFileDeals');
});

Route::prefix('products')->group(function(){
	Route::get('/', [ProductController::class, 'index'])->name('products');
	Route::post('store', [ProductController::class, 'store'])->name('products.store');
	Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
	Route::post('update/{id}', [ProductController::class, 'update'])->name('products.update');
	Route::post('delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('source')->group(function(){
	Route::get('/', [SourceController::class, 'index'])->name('source');
	Route::post('store', [SourceController::class, 'store'])->name('source.store');
	Route::get('edit/{id}', [SourceController::class, 'edit'])->name('source.edit');
	Route::post('update/{id}', [SourceController::class, 'update'])->name('source.update');
	Route::post('delete/{id}', [SourceController::class, 'destroy'])->name('source.destroy');
});

Route::prefix('invoice')->group(function(){
	Route::get('/', [InvoiceController::class, 'index'])->name('invoice');
	Route::get('editRequest/{id}', [InvoiceController::class, 'editRequest'])->name('invoice.editRequest');
	Route::post('updateRequest/{id}', [InvoiceController::class, 'updateRequest'])->name('invoice.updateRequest');
	Route::get('createSingleInvoice', [InvoiceController::class, 'createSingleInvoice'])->name('invoice.createSingleInvoice');
	Route::post('postCreateInvoice', [InvoiceController::class, 'postCreateInvoice'])->name('invoice.postCreateInvoice');
	Route::post('delete/{id}', [InvoiceController::class, 'changeStatusData'])->name('invoice.delete');
});

Route::get('generateDeals/{id}', [InvoiceController::class, 'generateDeals'])->name('generateDeals');
Route::get('request-invoice-deals',[InvoiceController::class, 'requestInvoice'])->name('requestInvoice');
Route::get('detail-invoice-deals/{id}', [InvoiceController::class, 'detailInvoice'])->name('detailInvoice');
Route::post('create-invoice/{id}', [InvoiceController::class, 'createInvoice'])->name('createInvoice');
Route::get('downloadMediaOrder/{id}', [InvoiceController::class, 'downloadMediaOrder'])->name('downloadMediaOrder');
Route::get('getMediaOrder/{id}', [InvoiceController::class, 'getMediaOrder'])->name('getMediaOrder');


Route::prefix('bankAcc')->group(function(){
	Route::get('/', [BankAccController::class, 'index'])->name('bankAcc');
	Route::post('store', [BankAccController::class, 'store'])->name('bankAcc.store');
	Route::get('edit/{id}', [BankAccController::class, 'edit'])->name('bankAcc.edit');
	Route::post('update/{id}', [BankAccController::class, 'update'])->name('bankAcc.update');
	Route::post('delete/{id}', [BankAccController::class, 'destroy'])->name('bankAcc.destroy');
});

Route::prefix('cashOut')->group(function(){
	Route::get('/', [CashOutController::class, 'index'])->name('cashOut');
	Route::get('create', [CashOutController::class, 'create'])->name('cashOut.create');
	Route::post('store', [CashOutController::class, 'store'])->name('cashOut.store');
	Route::get('edit/{id}', [CashOutController::class, 'edit'])->name('cashOut.edit');
	Route::post('update/{id}', [CashOutController::class, 'update'])->name('cashOut.update');
	Route::get('getFileCashOut/{id}', [CashOutController::class, 'getFileCashOut'])->name('cashOut.getFileCashOut');
	Route::post('delete/{id}', [CashOutController::class, 'destroy'])->name('cashOut.destroy');
});

Route::prefix('cashIn')->group(function(){
	Route::get('/', [CashInController::class, 'index'])->name('cashIn');
	Route::get('create', [CashInController::class, 'create'])->name('cashIn.create');
	Route::post('store', [CashInController::class, 'store'])->name('cashIn.store');
	Route::get('edit/{id}', [CashInController::class, 'edit'])->name('cashIn.edit');
	Route::post('update/{id}', [CashInController::class, 'update'])->name('cashIn.update');
	Route::get('getFileCashIn/{id}', [CashInController::class, 'getFileCashIn'])->name('cashIn.getFileCashIn');
	Route::post('delete/{id}', [CashInController::class, 'destroy'])->name('cashIn.destroy');
});

Route::prefix('tipeCashIn')->group(function(){
	Route::get('/', [TipeCashInController::class, 'index'])->name('tipeCashIn');
	// Route::get('create', [TipeCashInController::class, 'create'])->name('tipeCashIn.create');
	Route::post('store', [TipeCashInController::class, 'store'])->name('tipeCashIn.store');
	Route::get('edit/{id}', [TipeCashInController::class, 'edit'])->name('tipeCashIn.edit');
	Route::post('update/{id}', [TipeCashInController::class, 'update'])->name('tipeCashIn.update');
	Route::post('delete/{id}', [TipeCashInController::class, 'destroy'])->name('tipeCashIn.destroy');
});

Route::prefix('tipeCost')->group(function(){
	Route::get('/', [CostController::class, 'indexTipe'])->name('tipeCost');
	// Route::get('create', [CostController::class, 'create'])->name('tipeCost.create');
	Route::post('store', [CostController::class, 'storeTipe'])->name('tipeCost.store');
	Route::get('edit/{id}', [CostController::class, 'editTipe'])->name('tipeCost.edit');
	Route::post('update/{id}', [CostController::class, 'updateTipe'])->name('tipeCost.update');
	Route::post('delete/{id}', [CostController::class, 'destroyTipe'])->name('tipeCost.destroy');
});

Route::prefix('subTipe')->group(function(){
	Route::get('/', [CostController::class, 'indexSub'])->name('subTipe');
	// Route::get('create', [CostController::class, 'create'])->name('subTipe.create');
	Route::post('store', [CostController::class, 'storeSub'])->name('subTipe.store');
	Route::get('edit/{id}', [CostController::class, 'editSub'])->name('subTipe.edit');
	Route::post('update/{id}', [CostController::class, 'updateSub'])->name('subTipe.update');
	Route::post('delete/{id}', [CostController::class, 'destroySub'])->name('subTipe.destroy');
});


