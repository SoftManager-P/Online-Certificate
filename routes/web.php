<?php

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

////frontend
    // Route::get('/', 'HomeController@home');  
    Route::get('/home', 'HomeController@home'); 
    
    Route::get('/about_us', 'HomeController@about_us');
    Route::get('/contact_us', 'HomeController@contact_us');
/////customer   
    Route::get('/services', 'Customer\CustomerController@services'); 
    Route::post('insert_service_details', 'Customer\CustomerController@insert_serviceDetail');
    Route::post('delete_service_detail', 'Customer\CustomerController@delete_service_detail');
    Route::get('service_list', 'Customer\CustomerController@service_list'); 
    Route::get('edit_service/{id}', 'Customer\CustomerController@edit_service');
    Route::post('save_service', 'Customer\CustomerController@save_service');
    Route::post('delete_service', 'Customer\CustomerController@delete_service');
    Route::post('set_category_cus', 'Customer\CustomerController@set_category');
    Route::get('submit_service', 'Customer\CustomerController@submit_service');
    Route::get('submit_product', 'Customer\CustomerController@submit_product');
    // Route::post('get_services', 'CustomerController@getService'); 
    // Route::post('insert_service', 'CustomerController@insert_service'); 
    Route::get('/submitted', 'Customer\CustomerController@submitted_doc');
    // Route::get('/submitted/{search}', 'CustomerController@submitted_doc');
    // Route::get('pay-fees/{id}', 'CustomerController@pay_fees');
    Route::get('/confirm/{id}', 'CustomerController@confirm');
    // Route::get('foodreport/{id}', 'CustomerController@food_report');
    
    // Route::post('delete_foodservice', 'CustomerController@delete_foodservice');
    // Route::post('update_service_his', 'CustomerController@update_service_his');
    // Route::get('food_submit', 'CustomerController@food_submit');
    // Route::get('resubmit/{id}', 'CustomerController@resubmit');
    // Route::get('document_detail/{id}', 'CustomerController@document_detail');
    // Route::post('insert_foodservice_history', 'CustomerController@insert_foodservice_history');
    // Route::post('/update_evaluate_history', 'CustomerController@update_evaluate_history');
    // Route::post('/print_certification', 'CustomerController@view_print');
////login page
    Route::get('login', 'HomeController@login_page')->name('login');  
    Route::get('register', 'HomeController@register_page');  
    Route::get('logout', 'LoginController@logout');
    Route::post('signin', 'LoginController@signin');
    Route::post('signup', 'LoginController@signup');
    Route::get('forgot_password', 'HomeController@forgot_password');
    Route::get('set_password/{token}', 'HomeController@set_password');
    Route::post('confirmEmail', 'HomeController@confirmEmail');
    Route::post('update_password', 'HomeController@update_password');

//// admin user   // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('admin/', 'Admin\UserController@index'); 
    Route::get('admin/employees', 'Admin\UserController@index'); 
    Route::get('admin/editemployee/{id}', 'Admin\UserController@editemployee'); 
    Route::get('admin/customers', 'Admin\UserController@customerview');
    Route::get('admin/editcustomer/{id}', 'Admin\UserController@editcustomer');
    Route::post('admin/employeelist', 'Admin\UserController@employeelist');
    Route::post('admin/customerlist', 'Admin\UserController@customerlist');
    Route::get('admin/employees', 'Admin\UserController@index'); 
    Route::post('admin/insert_user', 'Admin\UserController@insert');
    Route::post('admin/delete_user', 'Admin\UserController@delete');
    Route::get('admin/myprofile/{id}', 'Admin\UserController@myprofile');
//// admin sector
    Route::get('admin/sector', 'Admin\SectorController@index'); 
    Route::get('admin/editsector/{id}', 'Admin\SectorController@editsector');
    Route::post('admin/sectorlist', 'Admin\SectorController@sectorlist');
    Route::post('admin/insert_sector', 'Admin\SectorController@insert_sector');
    Route::post('admin/delete_sector', 'Admin\SectorController@delete');
/// admin service
    Route::get('admin/service', 'Admin\ServiceController@index'); 
    Route::post('admin/servicelist', 'Admin\ServiceController@servicelist');
    Route::get('admin/editservice/{id}', 'Admin\ServiceController@editservice');
    Route::post('admin/insert_service', 'Admin\ServiceController@insert_service');
    Route::post('admin/delete_service', 'Admin\ServiceController@delete');
Route::get('/', function () {
    Session::put('nav','home');
    return view('index');
});
/// 
    
    Route::get('edit_profile', 'CustomerController@edit_profile'); 
    Route::get('get_otp/', 'CustomerController@get_otp');
    Route::get('verify/', 'CustomerController@verify');
    Route::post('/insert_user', 'CustomerController@insert');
//// company
    Route::get('productdetail', 'Company\CompanyController@productdetail'); 
    Route::post('insert_product_details', 'Company\CompanyController@insert_productDetail');
    Route::post('update_product_details', 'Company\CompanyController@update_product_details');
    Route::post('delete_product_detail', 'Company\CompanyController@delete_product_detail');
    Route::get('product_list', 'Company\CompanyController@product_list'); 
    Route::get('edit_product/{id}', 'Company\CompanyController@edit_product');
    Route::post('save_product', 'Company\CompanyController@save_product');
    Route::post('delete_product', 'Company\CompanyController@delete_product');
    Route::post('set_category', 'Company\CompanyController@set_category');
    Route::get('template_excel', 'Company\CompanyController@down_temp');
    Route::post('uploadCsvFile', 'Company\CompanyController@uploadCsvFile');


/// employee
    Route::get('employee/', 'Employee\EmployeeController@index'); 
    Route::get('employee/evaluate', 'Employee\EmployeeController@index'); 
    Route::get('employee/myprofile/{id}', 'Employee\EmployeeController@myprofile');
    Route::post('employee/insert_user', 'Employee\EmployeeController@insert');
    Route::post('employee/evaluate_history', 'Employee\EmployeeController@evaluate_historylist');
    Route::get('employee/editevaluate_history/{id}', 'Employee\EmployeeController@editevaluate_history');
    Route::post('employee/insert_evaluate', 'Employee\EmployeeController@insert_evaluate');
    Route::post('employee/delete_evaluate', 'Employee\EmployeeController@delete');
    Route::post('employee/get_service_his', 'Employee\EmployeeController@get_service_history');
    Route::post('employee/save_docname', 'Employee\EmployeeController@save_docname');

/// pdf generator
    Route::get('generate-pdf','HomeController@generatePDF');