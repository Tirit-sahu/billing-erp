<?php
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerPaymentsController;
use App\Http\Controllers\ExpensesController;


Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'loginPage'])->name('login');

Route::post('login', [LoginController::class, 'Login'])->name('user.login');

Route::get('logout', [LoginController::class, 'logout'])->name('user.logout');

Route::middleware(['auth'])->group(function () {
    
    //Master file
    Route::resource('company', CompanyController::class);
    Route::resource('category', CategoriesController::class);
    Route::resource('session', SessionController::class);
    Route::resource('unit', UnitController::class);
    Route::resource('sub-category', SubCategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('head', HeadController::class);
    Route::resource('expenses', ExpensesController::class);
    Route::get('incomeIndex', [ExpensesController::class, 'incomeIndex'])->name('incomeIndex');
    Route::get('incomeCreate', [ExpensesController::class, 'incomeCreate'])->name('incomeCreate');
  
    Route::resource('party', PartyController::class);
    Route::resource('supplierPayment', PaymentController::class);

    Route::get('customerPaymentIndex', [PaymentController::class, 'customerPaymentIndex'])->name('customerPaymentIndex');
    Route::get('customerPayment', [PaymentController::class, 'customerPayment'])->name('customerPayment');
    //END Master file

    //purchase
    Route::resource('purchase', PurchaseController::class);
    Route::resource('purchaseDetails', PurchaseDetailController::class);

    Route::get('purchaseDetailsEdit', [PurchaseDetailController::class, 'show']);

    Route::GET('purchase-final-submit', [PurchaseController::class, 'purchaseFinalSubmit'])->name('purchase.final.submit');

    Route::GET('purchase-edit/{id}', [PurchaseController::class, 'edit']);

    Route::get('purchase-details', [PurchaseDetailController::class, 'purchseDetails']);
    
    // SALES ROUTE
    
    Route::resource('sales', SaleController::class);

    Route::resource('salesDetails', SaleDetailsController::class);

    Route::get('saleDetailsEdit', [SaleDetailsController::class, 'show']);

    Route::GET('sale-final-submit', [SaleController::class, 'saleFinalSubmit'])->name('sale.final.submit');

    Route::GET('sale-edit/{id}', [SaleController::class, 'edit']);

    Route::GET('sale-details', [SaleDetailsController::class, 'saleDetails']);


    // ROute::get('getTotalAmount', [CommonController::class, 'getTotalAmount']);

    //select option
    Route::get('/common-get-select2', [CommonController::class, 'getSelectOption2']);

    // GET A VALUE
    Route::get('/common-get-value', [CommonController::class, 'getValueByAjax']);

    // EDIT RECORD USING AJAX
    Route::get('/common-get-edit', [CommonController::class, 'editValueByAjax']);

    // DELETE RECORD USING AJAX
    Route::get('/common-ajax-delete', [CommonController::class, 'deleteRecordByAjax']);

});