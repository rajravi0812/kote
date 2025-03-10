<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardScannerController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FingerprintController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
// Clear application cache:
Route::get('clear-cache', function() {
    Artisan::call('cache:clear');

    Artisan::call('route:cache');

    Artisan::call('config:cache');

    Artisan::call('view:clear');

    Artisan::call('optimize:clear');

    return 'Cache cleard';
})->name('clear.cache');



Route::get('/', function () {
    return view('admin.login');
    // return view('admin.registration');
    // return view('admin.dashboard.dashboard');
});


// Route::get('loginold', [LoginController::class, 'loginold'])->name('loginold');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('sign-in', [LoginController::class, 'sign_in'])->name('sign_in');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    // // ***************** category list *******************//
    // Route::get('manage-product-cat', [AdminController::class, 'manage_product_cat'])->name('manage.product.category');
    // Route::post('add-product-cat', [AdminController::class, 'add_product_cat'])->name('add.product.cat');
    // Route::post('delete-product-cat', [AdminController::class, 'delete_product_cat'])->name('delete.product.cat');
    // Route::post('update-product-cat', [AdminController::class, 'update_product_cat'])->name('update.product.cat');
 // ***************** rank list *******************//
 Route::get('manage-rank', [AdminController::class, 'manage_rank'])->name('manage.rank');
 Route::post('add-rank', [AdminController::class, 'add_rank'])->name('add.rank');
 Route::post('delete-rank', [AdminController::class, 'delete_rank'])->name('delete.rank');
 Route::post('update-rank', [AdminController::class, 'update_rank'])->name('update.rank');

 // ***************** Company list *******************//
 Route::get('manage-company', [AdminController::class, 'manage_company'])->name('manage.company');
 Route::post('add-company', [AdminController::class, 'add_company'])->name('add.company');
 Route::post('delete-company', [AdminController::class, 'delete_company'])->name('delete.company');
 Route::post('update-company', [AdminController::class, 'update_company'])->name('update.company');

 // ***************** Wpn Type  *******************//
 Route::get('manage-wpntype', [AdminController::class, 'manage_wpntype'])->name('manage.wpntype');
 Route::post('add-wpntype', [AdminController::class, 'add_wpntype'])->name('add.wpntype');
 Route::post('delete-wpntype', [AdminController::class, 'delete_wpntype'])->name('delete.wpntype');
 Route::post('update-wpntype', [AdminController::class, 'update_wpntype'])->name('update.wpntype');

 //***********************Add Indl*****************//

 Route::get('add-indl',[AdminController::class,'add_indl'])->name('add.indl');
 Route::post('add-indlAction', [AdminController::class, 'add_indlAction'])->name('add.indlAction');
 Route::get('indl-list', [AdminController::class, 'indl_list'])->name('indl.list');
 Route::post('/delete-indl', [AdminController::class, 'delete_indl'])->name('delete.indl');
 Route::get('edit-indl/{id}', [AdminController::class, 'edit_indl'])->name('edit.indl');
 Route::put('edit-indl-action/{id}', [AdminController::class, 'edit_indlAction'])->name('edit.indl.action');


// *****************  Wpn ********************//
Route::get('add-wpn',[AdminController::class,'add_wpn'])->name('add.wpn');
Route::post('add-wpnAction', [AdminController::class, 'add_wpnAction'])->name('add.wpnAction');
Route::get('wpn-list', [AdminController::class, 'wpn_list'])->name('wpn.list');
Route::post('/delete-wpn', [AdminController::class, 'delete_wpn'])->name('delete.wpn');
Route::get('edit-wpn/{id}', [AdminController::class, 'edit_wpn'])->name('edit.wpn');
Route::put('edit-action/{id}', [AdminController::class, 'editWpnAction'])->name('edit.wpn.action');

// ******************wpn allot list********************//
Route::get('indl-allot-list', [AdminController::class, 'indl_allot_list'])->name('indl.allot.list');
Route::get('wpn-allot/{id}',[AdminController::class, 'wpn_allot'])->name('wpn.allot');



// ************** wpn Allot individual ****************//
Route::post('add-allot-wpn',[AdminController::class, 'addAllotWpn'])->name('add.allot.wpn');
Route::post('fetch-allot-wpn',[AdminController::class, 'fetchWpnAllot'])->name('fetch.wpn.allot');
Route::post('del-allot-wpn',[AdminController::class, 'delAllotWpn'])->name('del.allot.wpn');
Route::post('fetch-wpn-avail',[AdminController::class, 'fetchWpnAvail'])->name('fetch.wpn.avail');
Route::post('update-assign-type',[AdminController::class, 'updateAsgnType'])->name('update.assign.type');

Route::post('fetch-wpn-alloted',[AdminController::class, 'fetchWpnAlloted'])->name('fetch.wpn.alloted');
Route::post('fetch-wpnbar-sel',[AdminController::class, 'fetchWpnBarcodeSelected'])->name('fetch.wpn.barcode');
Route::post('fetch-wpnbar-notsel',[AdminController::class, 'fetchWpnBarcodeNotSelected'])->name('fetch.wpn.barcode.not');
Route::post('add_issue',[AdminController::class, 'addIssueReturn'])->name('add.issue.return');

// ************wpn issue ********************//
Route::get('wpn-issue',[AdminController::class, 'wpn_issue'])->name('wpn.issue');
Route::get('wpn-return',[AdminController::class, 'wpn_return'])->name('wpn.return');

Route::post('wpn-return-indl',[AdminController::class, 'wpnReturnIndl'])->name('wpn.return.indl');
Route::post('fetch-bar-selected',[AdminController::class, 'fetchWpnBarcodeSelectedIndl'])->name('fetch.wpn.selected');
Route::post('fetch-bar-notselected',[AdminController::class, 'fetchWpnBarcodeNotSelectedIndl'])->name('fetch.wpn.notselected');
Route::post('update-return-wpn',[AdminController::class, 'updateReturnWpn'])->name('update.return.wpn');

Route::post('/check-session', [EmployeeController::class, 'checkEmployeeSession'])->name('check.session');

// ******************** fingerprint Enroll ****************//
Route::get('/fingerprint/enroll', [FingerprintController::class, 'enrollList'])->name('fingerprint.enroll');
Route::post('/fingerprint/update', [FingerprintController::class, 'updateFingerprint'])->name('fingerprint.update');
Route::get('/issue/{emp_id}', [EmployeeController::class, 'details'])->name('employee.details');

// ***************reports************//
Route::get('reports', [AdminController::class, 'reports'])->name('reports');
Route::get('master-report', [AdminController::class, 'master_report'])->name('master.report');
Route::get('inout-report', [AdminController::class, 'inout_report'])->name('inout.report');
Route::get('allot-wpn-report', [AdminController::class, 'allot_wpn_report'])->name('allot.wpn.report');



Route::post('/weapons/get-held', [AdminController::class, 'getHeldWpn'])->name('weapons.getHeld');
Route::post('/weapons/get-kote', [AdminController::class, 'getKoteWpn'])->name('weapons.getKote');
Route::post('/weapons/get-less24', [AdminController::class, 'getLess24Wpn'])->name('weapons.getLess24');
Route::post('/weapons/get-more24', [AdminController::class, 'getMore24Wpn'])->name('weapons.getMore24');

Route::get('/wpn-summary',[AdminController::class,'wpn_summary'])->name('wpn.summary');


    // // ******************* Rank section *************//
    // Route::get('manage-fund-cat', [AdminController::class, 'manage_fund_cat'])->name('manage.fund.cat');
    // Route::post('add-fund-cat', [AdminController::class, 'add_fund_cat'])->name('add.fund.cat');
    // Route::post('delete-fund-cat', [AdminController::class, 'delete_fund_cat'])->name('delete.fund.cat');
    // Route::post('update-fund-cat', [AdminController::class, 'update_fund_cat'])->name('update.fund.cat');


    // // ******************* branches section *************//
    // Route::get('manage-branches', [AdminController::class, 'manage_branches'])->name('manage.branches');
    // Route::post('add-branches', [AdminController::class, 'add_branches'])->name('add.branches');
    // Route::post('delete-branches', [AdminController::class, 'delete_branches'])->name('delete.branches');
    // Route::post('update-branches', [AdminController::class, 'update_branches'])->name('update.branches');



    // ******************* Unit section *************//
      Route::get('manage-unit', [AdminController::class, 'manage_unit'])->name('manage.unit');
      Route::post('add-unit', [AdminController::class, 'add_unit'])->name('add.unit');
      Route::post('delete-unit', [AdminController::class, 'delete_unit'])->name('delete.unit');
      Route::post('update-unit', [AdminController::class, 'update_unit'])->name('update.unit');
  
    // ******************* Fund Cat section *************//
    Route::get('manage-fund-cat', [AdminController::class, 'manage_fund_cat'])->name('manage.fund.cat');
    Route::post('add-fund-cat', [AdminController::class, 'add_fund_cat'])->name('add.fund.cat');
    Route::post('delete-fund-cat', [AdminController::class, 'delete_fund_cat'])->name('delete.fund.cat');
    Route::post('update-fund-cat', [AdminController::class, 'update_fund_cat'])->name('update.fund.cat');


    // ******************* Fund Sub Cat Unit section *************//
    Route::get('manage-fund-subcat', [AdminController::class, 'manage_fund_subcat'])->name('manage.fund.subcat');
    Route::post('add-fund-subcat', [AdminController::class, 'add_fund_subcat'])->name('add.fund.subcat');
    Route::post('delete-fund-subcat', [AdminController::class, 'delete_fund_subcat'])->name('delete.fund.subcat');
    Route::post('update-fund-subcat', [AdminController::class, 'update_fund_subcat'])->name('update.fund.subcat');    

    // ******************* store section *************//
    Route::get('manage-store', [AdminController::class, 'manage_store'])->name('manage.store');
    Route::post('add-store', [AdminController::class, 'add_store'])->name('add.store');
    Route::post('delete-store', [AdminController::class, 'delete_store'])->name('delete.store');
    Route::post('update-store', [AdminController::class, 'update_store'])->name('update.store');


  


    //********************* veh assign form **********************//
    Route::get('assign-form', [AdminController::class, 'assign_form'])->name('assign.form');
    Route::get('edit-assign-form/{id}', [AdminController::class, 'edit_assign_form'])->name('edit.assign.form');    
    Route::post('assign-veh', [AdminController::class, 'assign_veh'])->name('assign.vehicle');
    Route::get('assign-list', [AdminController::class, 'assign_list'])->name('assign.list');
    Route::get('/product-list/{id}', [AdminController::class, 'product_list'])->name('product.list');
    Route::post('edit-product-action', [AdminController::class, 'edit_productaction'])->name('edit.product.action');   
    //*********************** other methods*********************//
    Route::get('/issue-products/{id}', [AdminController::class, 'issue_products'])->name('issue.products');
    Route::post('/issue-productsaction', [AdminController::class, 'issue_productsaction'])->name('issue.products.action');
    // Route::get('products', [AdminController::class, 'products'])->name('products');
    // Route::get('/subproducts/{id}', [AdminController::class, 'subproducts'])->name('subproducts');
    // Route::get('/subproducts/{id}', [AdminController::class, 'subproducts'])->name('subproducts');



// stage1
Route::get('/stage1-tabs', [AdminController::class, 'stage1tabs'])->name('stage1.tabs');



// ************manage user*****************//
Route::get('view-user', [AdminController::class, 'view_user'])->name('view.user');
Route::post('add-user', [AdminController::class, 'add_user'])->name('add.user');
Route::post('delete-user', [AdminController::class, 'delete_user'])->name('delete.user');
Route::post('update-user', [AdminController::class, 'update_user'])->name('update.user');


// ******************formatioin unit *********************//
Route::get('signout', [LoginController::class, 'signout'])->name('signout');
Route::get('/view-details/{id}', [AdminController::class, 'view_details'])->name('view.details');

// *******************manage section****************//
Route::get('wpn-section', [AdminController::class, 'wpn_section'])->name('wpn.section');
Route::get('indl-section', [AdminController::class, 'indl_section'])->name('indl.section');


// ************************indl weapon report**********************
Route::get('indl-weapon-report',[AdminController::class,"indl_list2"])->name('indl.weapon.report');
Route::get('indl-weapon-current-history',[AdminController::class,'current_history'])->name('get.indl_list.current_history');
Route::get('indl-weapon-history/{id}',[AdminController::class,'weapon_history'])->name('wpn.history');
Route::get('weapon-current-history',[AdminController::class,'weapon_current_history'])->name('wpn.current.history');
Route::get('weapon-issue-history/{id}',[AdminController::class,'weapon_issue_history'])->name('wpn.issue.history');

});