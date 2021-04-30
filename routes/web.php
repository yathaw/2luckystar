<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;


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

// Frontend
Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('accessory',[FrontendController::class,'accessory'])->name('accessory');
Route::get('info/{id}',[FrontendController::class,'info'])->name('info');

Route::get('service',[FrontendController::class,'service'])->name('service');
Route::get('detail/{id}',[FrontendController::class,'detail'])->name('detail');



Route::get('login',[LoginController::class,'showLoginForm']);
Route::post('login',[LoginController::class,'login'])->name('login');
Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

	// Color
	Route::resource('/color', ColorController::class);
	Route::get('/getlistColors',[ColorController::class, 'getlistData'])->name('getlistColors');

	// Brand
	Route::resource('/brand', BrandController::class);
	Route::get('/getlistBrands',[BrandController::class, 'getlistData'])->name('getlistBrands');

	// Category
	Route::resource('/category', CategoryController::class);
	Route::get('/getlistCategories',[CategoryController::class, 'getlistData'])->name('getlistCategories');

	// Country
	Route::resource('/country', CountryController::class);
	Route::get('/getlistCountries',[CountryController::class, 'getlistData'])->name('getlistCountries');

	// Car
	Route::resource('/car', CarController::class);
	Route::get('/getlistCars',[CarController::class, 'getlistData'])->name('getlistCars');

	// SPA
	Route::resource('/spa', SpaController::class);
	Route::get('/getlistSpas',[SpaController::class, 'getlistData'])->name('getlistSpas');
	Route::post('/spa/update/{id}',[SpaController::class, 'update'])->name('spa.update');


	// Item
	Route::resource('/item', ItemController::class);
	Route::get('/getlistItems',[ItemController::class, 'getlistData'])->name('getlistItems');


	Route::get('/getitemStocks/{id}',[StockController::class,  'getitemstockData'])->name('getitemStocks');
	Route::get('/additemStock/{id}',[StockController::class, 'additemStock'])->name('additemStock');
	Route::get('/edititemStock/{id}',[StockController::class, 'edititemStock'])->name('edititemStock');
	Route::get('/destroyitemStock/{id}',[StockController::class, 'destroyitemStock'])->name('destroyitemStock');


	// Sale
	Route::resource('/sale', SaleController::class);
	Route::get('/getlistSales',[SaleController::class, 'getlistData'])->name('getlistSales');

	Route::get('pagination/spa_fetch_data', [SaleController::class, 'spa_fetch_data']);
	Route::get('pagination/item_fetch_data', [SaleController::class, 'item_fetch_data']);

	Route::post('salesearch',[SaleController::class, 'salesearch'])->name('salesearch');

	// Expense
	Route::resource('/expense', ExpenseController::class);
	Route::get('/getlistExpenses',[ExpenseController::class, 'getlistData'])->name('getlistExpenses');
	Route::get('/getmomentTotal',[ExpenseController::class, 'gettotalData'])->name('getmomentTotal');

	Route::post('/searchExpense',[ExpenseController::class, 'getsearchExpense'])->name('searchExpense');
	Route::post('/searchExpensetotal',[ExpenseController::class, 'getsearchExpensetotal'])->name('searchExpensetotal');

	// Supplier
	Route::resource('/supplier', SupplierController::class);
	Route::get('/getlistSuppliers',[SupplierController::class, 'getlistData'])->name('getlistSuppliers');

	// Customer
	Route::resource('/customer', CustomerController::class);
	Route::get('/getlistCustomers',[CustomerController::class, 'getlistData'])->name('getlistCustomers');

	// Staff
	Route::resource('/staff', StaffController::class);
	Route::get('/getlistStaff',[StaffController::class, 'getlistData'])->name('getlistStaff');
	Route::post('/getPermission_byUserid',[StaffController::class, 'getPermission_byUserid'])->name('getPermission_byUserid');

	// Profile
	Route::resource('/profile',ProfileController::class);
	Route::post('/changepassword',[ProfileController::class,'changepassword'])->name('changepassword');
	Route::post('/changeprofile',[ProfileController::class, 'changeprofile'])->name('changeprofile');

	// Report
	Route::resource('/report',ReportController::class);
	Route::get('/dashboard',[ReportController::class, 'dashboard'])->name('dashboard');
});

