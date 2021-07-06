<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 
// Route::get('test', 'TestController@index');

// Route::get('subdomain', function (Request $request) {
//     return  $request->root();
// });
  
// Route::post('forgot-password', 'Api\AuthController@forgot_password');

// Route::group(['middleware' => 'auth:api'], function () { 
// });
// Route::get('users', 'UserController@index');

Route::get('settings', 'SettingsController@index');
Route::get('settings/{data}', 'SettingsController@show');
Route::post('settings', 'SettingsController@store'); 

Route::get('image/{fileName}', 'FileController@show'); 


  
Route::get('productcategory', 'ProductCategoryController@index');

Route::middleware(['auth:api'])->group(function ($router) {

    // Route::get('user', function (Request $request) {
    //     return $request->user();
    // });
    //----------------------------Settings------------------------------
    // Route::get('settings', 'SettingsController@index');
    // Route::get('settings/{data}', 'SettingsController@show');
    // Route::post('settings', 'SettingsController@store'); 
    //----------------------------user------------------------------ 
    Route::get('user', 'UserController@index');
    Route::get('user/{u}', 'UserController@show');
    Route::post('user', 'UserController@store');
    Route::post('user', 'UserController@store');
    Route::put('user/{u}', 'UserController@update');
    Route::post('user/changePassword', 'UserController@changePassword'); 
    //----------------------------workspace------------------------------
    Route::get('workspace', 'WorkspaceController@show');
    Route::post('workspace', 'WorkspaceController@update');
    //----------------------------salarycaregory------------------------------ 
    Route::get('salarycaregory', 'SalaryCategoryController@index');
    Route::get('salarycaregory/{data}', 'SalaryCategoryController@show');
    Route::post('salarycaregory', 'SalaryCategoryController@store');
    Route::put('salarycaregory/{data}', 'SalaryCategoryController@update');
    Route::delete('salarycaregory/{data}', 'SalaryCategoryController@delete');
    //----------------------------productcategory------------------------------    
    Route::get('productcategory/{data}', 'ProductCategoryController@show');
    Route::post('productcategory', 'ProductCategoryController@store');
    Route::post('productcategory/update', 'ProductCategoryController@updateCategory');
    Route::delete('productcategory/{data}', 'ProductCategoryController@delete');
    Route::post('productcategory/activate/{id}', 'ProductCategoryController@activate');
    Route::post('productcategory/deactivate/{id}', 'ProductCategoryController@deactivate');
    //----------------------------supplier-------------------------------------------------
    Route::get('supplier', 'SupplierController@index');
    Route::get('supplier/{data}', 'SupplierController@show');
    Route::post('supplier', 'SupplierController@store');
    Route::post('supplier/update', 'SupplierController@updateCategory');
    Route::delete('supplier/{data}', 'SupplierController@delete');
    Route::post('supplier/activate/{id}', 'SupplierController@activate');
    Route::post('supplier/deactivate/{id}', 'SupplierController@deactivate');
    //----------------------------leavepayment------------------------------ 
    Route::get('leavepayment', 'LeavePaymentController@index');
    Route::get('leavepayment/{data}', 'LeavePaymentController@show');
    Route::post('leavepayment', 'LeavePaymentController@store');
    Route::put('leavepayment/{data}', 'LeavePaymentController@update');
    Route::delete('leavepayment/{data}', 'LeavePaymentController@delete');  
    //----------------------------CheckBank------------------------------
    Route::get('checkbankview/{id?}', 'CheckbankController@indexView')->where(['id' => '[0-9]?']); 
    Route::get('checkbank/checkstate/{checkStateId}', 'CheckbankController@getByCheckStateId')->where(['checkStateId' => '[0-9]+']); 
    Route::get('checkbank', 'CheckbankController@index');
    Route::get('checkbank/{checkbank}', 'CheckbankController@show');
    Route::post('checkbank', 'CheckbankController@store');
    Route::put('checkbank/{checkbank}', 'CheckbankController@update');
    Route::delete('checkbank/{checkbank}', 'CheckbankController@delete');
    //----------------------------CheckBank------------------------------
    Route::get('checkbankoutview/{id?}', 'CheckbankOutController@indexView')->where(['id' => '[0-9]?']);
    Route::get('checkbankout/checkstate/{checkStateId}', 'CheckbankOutController@getByCheckStateId')->where(['checkStateId' => '[0-9]+']);
    Route::get('checkbankout', 'CheckbankOutController@index');
    Route::get('checkbankout/{checkbank}', 'CheckbankOutController@show');
    Route::post('checkbankout', 'CheckbankOutController@store');
    Route::put('checkbankout/{checkbank}', 'CheckbankOutController@update');
    Route::delete('checkbankout/{checkbank}', 'CheckbankOutController@delete');
    //----------------------------Agency--------------------------------------
    Route::get('agency', 'AgencyController@index');
    Route::get('agency/{data}', 'AgencyController@show');
    Route::post('agency', 'AgencyController@store');
    Route::put('agency/{data}', 'AgencyController@update');
    Route::delete('agency/{data}', 'AgencyController@delete');
    //----------------------------Bank------------------------
    Route::get('bank', 'BankController@index');
    Route::get('bank/{data}', 'BankController@show');
    Route::post('bank', 'BankController@store');
    Route::put('bank/{data}', 'BankController@update');
    Route::delete('bank/{data}', 'BankController@delete');
    //----------------------------BankAccountController---
    Route::get('bank-account', 'BankAccountController@index');
    Route::get('bank-account/{data}', 'BankAccountController@show');
    Route::post('bank-account', 'BankAccountController@store');
    Route::put('bank-account/{data}', 'BankAccountController@update');
    Route::delete('bank-account/{data}', 'BankAccountController@delete');
    //----------------------------Customer------------------------------ 
    Route::get('customers', 'CustomerController@index');
    Route::get('customers/{data}', 'CustomerController@show');
    Route::post('customers', 'CustomerController@store');
    Route::put('customers/{data}', 'CustomerController@update');
    Route::delete('customers/{data}', 'CustomerController@delete');
    //----------------------------NatureCheck----------------------
    Route::get('naturecheck', 'NatureCheckController@index');
    Route::get('naturecheck/{n}', 'NatureCheckController@show');
    Route::post('naturecheck', 'NatureCheckController@store');
    Route::put('naturecheck/{n}', 'NatureCheckController@update');
    Route::delete('naturecheck/{n}', 'NatureCheckController@delete');
    //----------------------------Payeur-----------------------------
    Route::get('payeurs', 'PayeurController@index');
    Route::get('payeurs/{p}', 'PayeurController@show');
    Route::post('payeurs', 'PayeurController@store');
    Route::put('payeurs/{p}', 'PayeurController@update');
    Route::delete('payeurs/{p}', 'PayeurController@delete');
    //----------------------------RemisDate-----------------------------
    Route::get('deliverybankdate', 'DeliveryBankDatesController@index');
    Route::get('deliverybankdate/{bd}', 'DeliveryBankDatesController@show');
    Route::post('deliverybankdate', 'DeliveryBankDatesController@store');
    Route::put('deliverybankdate/{bd}', 'DeliveryBankDatesController@update');
    Route::delete('deliverybankdate/{bd}', 'DeliveryBankDatesController@delete');
    //----------------------------EncasmentMode----------------------------------
    Route::get('encasmentmodes', 'EncasmentModeController@index');
    Route::get('encasmentmodes/{m}', 'EncasmentModeController@show');
    Route::post('encasmentmodes', 'EncasmentModeController@store');
    Route::put('encasmentmodes/{m}', 'EncasmentModeController@update');
    Route::delete('encasmentmodes/{m}', 'EncasmentModeController@delete');
    //----------------------------EncasmentMode---------------------------
    Route::get('paymentmodes', 'PayementModeController@index');
    Route::get('paymentmodes/{m}', 'PayementModeController@show');
    Route::post('paymentmodes', 'PayementModeController@store');
    Route::put('paymentmodes/{m}', 'PayementModeController@update');
    Route::delete('paymentmodes/{m}', 'PayementModeController@delete');
    //----------------------------checkstate---------------------------
    Route::get('checkstate', 'CheckStateController@index');
    Route::get('checkstate/{checkState}', 'CheckStateController@show');
    Route::post('checkstate', 'CheckStateController@store');
    Route::put('checkstate/{checkState}', 'CheckStateController@update');
    Route::delete('checkstate/{checkState}', 'CheckStateController@delete');

    Route::get('transfer/view', 'TransferController@view');
    Route::get('transfer', 'TransferController@index');
    Route::get('transfer/{data}', 'TransferController@show');
    Route::post('transfer', 'TransferController@store');
    Route::put('transfer/{data}', 'TransferController@update');
    Route::delete('transfer/{data}', 'TransferController@delete');

    Route::get('transfermultiple/view', 'TransferMultipleController@view');
    Route::get('transfermultiple', 'TransferMultipleController@index');
    Route::get('transfermultiple/{data}', 'TransferMultipleController@show');
    Route::post('transfermultiple', 'TransferMultipleController@store');
    Route::put('transfermultiple/{data}', 'TransferMultipleController@update');
    Route::delete('transfermultiple/{data}', 'TransferMultipleController@delete');
    
    Route::get('printusers', 'PDFMakerController@PrintUsers');
    Route::get('printsubscribers', 'PDFMakerController@PrintSubscribers');

    
    Route::get('printcheckbanks', 'PDFMakerController@PrintCheckBanks');
    Route::post('printcheckbanksunpaid', 'PDFMakerController@PrintCheckBanksUnpaid');
    Route::post('printcheckbanksreported', 'PDFMakerController@PrintCheckBanksReported');
    Route::post('printcheckbankswallet', 'PDFMakerController@PrintCheckBanksWallet');
    Route::post('printCheckBanksEncaissed', 'PDFMakerController@PrintCheckBanksEncaissed');
     
    Route::post('printcheckstate', 'PDFMakerController@PrintCheckState');
    Route::post('printtransfer', 'PDFMakerController@PrintTransfer');
    Route::post('printtransfermultiple', 'PDFMakerController@PrintTransferMultiple');
    Route::post('printpaymentleave', 'PDFMakerController@PrintLeavePayment');
    
});



Route::get('calc/{value?}', 'CalcController@toLetter2');//->where(['value' => '\d+']); 


Route::middleware(['api'])->group(function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me')->middleware('log.route');
    Route::post('register', 'RegistrationController@register');
    // Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    // Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
});



Route::get('roles', 'RoleManagerController@index');

//-------------------------------------------------------
Route::get('attachments', 'AttachmentsController@index');
Route::get('attachments/{attachment}', 'AttachmentsController@show');
Route::post('attachments', 'AttachmentsController@store');
Route::put('attachments/{a}', 'AttachmentsController@update');
Route::delete('attachments/{a}', 'AttachmentsController@delete');
Route::get('attachments/{attachment}', 'AttachmentsController@show');
//----------------------------salary------------------
Route::get('salary/branch', 'SalaryController@branch');
Route::get('salary/today/{day}', 'SalaryController@today');
Route::get('salary/thismonth/{month}', 'SalaryController@thismonth');
//------------------------------------------------------------------
Route::get('salary', 'SalaryController@index');
Route::get('salary/{data}', 'SalaryController@show');
Route::post('salary', 'SalaryController@store');
Route::put('salary/{data}', 'SalaryController@update');
Route::delete('salary/{data}', 'SalaryController@delete');
Route::post('salary/activate/{salaryId}', 'SalaryController@activate');
Route::post('salary/deactivate/{salaryId}', 'SalaryController@deactivate');
//----------------------------product------------------------------------- 
Route::get('product', 'ProductController@index');
Route::get('product/{data}', 'ProductController@show');
Route::post('product', 'ProductController@store');
Route::post('product/update', 'ProductController@updateProduct');
Route::delete('product/{data}', 'ProductController@delete');
Route::post('product/category/{categoryId}', 'ProductController@category'); 
Route::post('product/activate/{id}', 'ProductController@activate');
Route::post('product/deactivate/{id}', 'ProductController@deactivate');
//----------------------------Subscriber------------------------------
Route::get('subscriber', 'SubscriberController@index');
Route::get('subscriber/{data}', 'SubscriberController@show');
Route::post('subscriber', 'SubscriberController@store');
Route::put('subscriber/{data}', 'SubscriberController@update');
Route::delete('subscriber/{data}', 'SubscriberController@delete');
Route::post('subscriber/activate/{subscriberId}', 'SubscriberController@activate');
Route::post('subscriber/deactivate/{subscriberId}', 'SubscriberController@deactivate');
//-------------------------subscriberfunction------------------------
Route::get('subscriberfunction', 'SubscriberFunctionController@index');
Route::get('subscriberfunction/{data}', 'SubscriberFunctionController@show');
Route::post('subscriberfunction', 'SubscriberFunctionController@store');
Route::put('subscriberfunction/{data}', 'SubscriberFunctionController@update');
Route::delete('subscriberfunction/{data}', 'SubscriberFunctionController@delete');
//---------------------------Education-------------------------------------------
Route::get('education', 'EducationController@index');
Route::get('education/{data}', 'EducationController@show');
Route::post('education', 'EducationController@store');
Route::put('education/{data}', 'EducationController@update');
Route::delete('education/{data}', 'EducationController@delete');
//----------------------------pointing--------------------------
Route::get('pointing', 'PointingController@index');
Route::get('pointing/monthly/{month}', 'PointingController@monthly'); 
Route::get('pointing/dayly/{day}', 'PointingController@dayly'); 
//----------------------------pointing-------------------------
Route::get('pointing/{data}', 'PointingController@show');
Route::post('pointing', 'PointingController@store');
Route::put('pointing/{data}', 'PointingController@update');
Route::delete('pointing/{data}', 'PointingController@delete'); 
//-----------------------------------------------------------
Route::get('advance/{data}', 'AdvanceController@show');
Route::post('advance', 'AdvanceController@store');
Route::put('advance/{data}', 'AdvanceController@update');
Route::delete('advance/{data}', 'AdvanceController@delete');  
//----------------------------------------------------------
Route::get('statisticl/transferbymonth', 'transferByMonth@delete'); 
Route::get('statisticl/transfermultiplebymonth', 'StatisticalController@transferMultipleByMonth');
Route::get('printpointing/{month}/{branch_id}', 'PDFMakerController@PrintPointing');
//---------------------------------------------------------------------------------

Route::get('clean', function () { 
    // $exitCode = Artisan::call('key:generate');
    // $exitCode = Artisan::call('jwt:secret');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything 
});
 
Route::get('setusers', function() {
    $exitCode = Artisan::call('laravel_api:bootstrap');
    return 'Migrate DONE'; //Return anything
});


Route::get('migrate', function() {
    $exitCode = Artisan::call('migrate:fresh --seed');
    return 'Migrate DONE'; //Return anything
});


Route::get('seed', function() {
    $exitCode = Artisan::call('db:seed');
    return 'Seed DONE'; //Return anything
});
 

Route::get('resetData','ResetController@reset');

Route::get('img', function() {
    return view('welcome');
});
