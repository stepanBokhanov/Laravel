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
Route::get('/base64', function(){
    $image = public_path('installer/img/pattern.png');;
    $img = \Image::make($image);
    return response()->make($img->encode($img->mime()), 200, array('Content-Type' => $img->mime(),'Cache-Control'=>'max-age=86400, public'));
});
# Employee Login
Route::get('/',['as'=>'front.login','uses'=>'front\LoginController@index']);
Route::post('/login',['as'=>'login','uses'=>'front\LoginController@ajaxLogin']);
Route::get('logout', ['as'=>'front.logout','uses'=>'front\LoginController@logout']);

# Employee Panel After Login
Route::group(['middleware' => ['auth.employees'],'namespace' => 'front'], function()
{
    Route::get('/change_password_modal',['as'=>'front.change_password_modal','uses'=>'DashboardController@changePasswordModal']);
    Route::post('/change_password',['as'=>'front.change_password','uses'=>'DashboardController@change_password']);
    Route::get('ajaxApplications',['as'=>'front.leave_applications','uses'=> 'DashboardController@ajaxApplications']);

    Route::get('leave',['as'=>'front.leave','uses'=>'DashboardController@leave']);

    Route::post('dashboard/notice/{id}',['as'=>'front.notice_ajax','uses'=>'DashboardController@notice_ajax']);

    Route::post('leave_store',['as'=>'front.leave_store','uses'=>'DashboardController@leave_store']);


    Route::resource('dashboard','DashboardController');
});
# Admin Login
Route::group([ 'middleware' => ['auth.employees'],'prefix' => 'admin','namespace' => 'Admin'], function() {
    Route::get('notice/{id}', ['as'=>'front.show_notice','uses'=>'NoticeboardsController@show']);
    Route::get('award/{id}', ['as'=>'front.show_award_details','uses'=>'AwardsController@show']);
});

# Admin Login
Route::group([ 'prefix' => 'admin','namespace' => 'Admin'], function()
{

    Route::get('/',['as'=>'admin.getlogin','uses'=>'AdminLoginController@index']);
    Route::get('logout',['as'=>'admin.logout','uses'=> 'AdminLoginController@logout']);

    Route::post('login',['as'=>'admin.login','uses'=> 'AdminLoginController@ajaxAdminLogin']);

});


// Admin Panel After Login
Route::group(['middleware' => ['auth.admin'], 'prefix' => 'admin','namespace' => 'Admin'], function()
{

    //	Dashboard Routing
    //Route::resource('dashboard', 'AdminDashboardController');
    Route::resource('dashboard', 'AdminDashboardController',['as' => 'admin']);

    //    Employees Routing
    Route::get('employees/export',['as'=>'admin.employees.export','uses'=>'EmployeesController@export']);
    Route::get('employees/employeeLogin/{id}',['as'=>'admin.employees.employeeLogin','uses'=>'EmployeesController@employeesLogin']);
    Route::get('employees/employeelist',['as'=>'admin.employees.ajaxlist','uses'=>'EmployeesController@ajaxEmployees']);
    Route::resource('employees', 'EmployeesController',['except' => ['show'],'as' => 'admin']);


    //  Awards Routing
    Route::get('ajax_awards/',['as'=>'admin.ajax_awards','uses'=> 'AwardsController@ajax_awards']);
    Route::resource('awards', 'AwardsController',['except'=>['show'],'as' => 'admin']);

    //  Department Routing
    Route::get('departments/ajax_designation/',['as'=>'admin.departments.ajax_designation','uses'=> 'DepartmentsController@ajax_designation']);
    Route::get('departments/ajax_department/',['as'=>'admin.departments.ajax_department','uses'=> 'DepartmentsController@ajaxDepartments']);
    Route::resource('departments', 'DepartmentsController',['as' => 'admin']);

    //    Expense Routing
    Route::get('ajax_expenses/',['as'=>'admin.ajax_expenses','uses'=> 'ExpensesController@ajax_expenses']);
    Route::resource('expenses', 'ExpensesController',['except' => ['show'],'as' => 'admin']);

    //    Holiday Routing
    Route::get('holidays/mark_friday', 'HolidaysController@Friday');
    Route::resource('holidays', 'HolidaysController',['as' => 'admin']);
    Route::post('holidays/preassign', ['as'=>'admin.holidays.preassign','uses'=>'HolidaysController@preassign']);
    //  Routing for the attendance
    Route::get('attendances/report/{attendances}', ['as'=>'admin.attendance.report','uses'=>'AttendancesController@report']);
    Route::get('attendances/ajax-attendance-list', ['as'=>'admin.attendance.ajax-attendance-list','uses'=>'AttendancesController@ajaxAttendanceList']);
    Route::post('attendances/export', ['as'=>'admin.attendance.export','uses'=>'AttendancesController@export']);
    Route::resource('attendances', 'AttendancesController',['as' => 'admin']);

    //    Routing or the leavetypes
    Route::get('leavetypes/ajax_list',['as'=>'admin.leavetypes.ajax_list','uses'=> 'LeavetypesController@ajaxLeaveType']);
    Route::resource('leavetypes', 'LeavetypesController',['except'=>['show'],'as' => 'admin']);

    //    Leave Applications routing
    Route::get('leave_applications/ajaxApplications',['as'=>'admin.leave_applications','uses'=> 'LeaveApplicationsController@ajaxApplications']);
    Route::resource('leave_applications', 'LeaveApplicationsController',['except'=>['create','store','edit'],'as' => 'admin']);

    //   Routing for setting
    Route::resource('settings', 'SettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //    Salary Routing
    Route::get('add-salary-modal/{employeeID}',['as'=>'admin.add-salary-modal','uses'=>  'SalaryController@addSalaryModal']);

    Route::resource('salary','SalaryController',['only'=>['destroy','show','update','store'],'as' => 'admin']);

    //    Profile Setting
    Route::resource('profile_settings', 'ProfileSettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //   Notification Setting

    Route::post('ajax_update_notification',['as'=>'admin.ajax_update_notification','uses'=> 'NotificationSettingsController@ajax_update_notification']);
    Route::resource('notificationSettings', 'NotificationSettingsController',['only'=>['edit','update'],'as' => 'admin']);

    Route::post('ajax_update_email_setting',['as'=>'admin.ajax_update_email_setting','uses'=> 'EmailSettingsController@ajax_email_setting']);
    Route::resource('email_settings', 'EmailSettingsController',['only'=>['edit','update'],'as' => 'admin']);

    //  Notice Board
    Route::get('ajax_notices/',['as'=>'admin.ajax_notices','uses'=> 'NoticeboardsController@ajax_notices']);
    Route::resource('noticeboards', 'NoticeboardsController',['except'=>['show'],'as' => 'admin']);


    Route::get('update-new-version', ['as' => 'admin.updateVersion.index', 'uses' => 'AdminUpdateVersionController@index']);

});
Event::listen('auth.login', function($user)
{
    $user->last_login = new DateTime;
    $user->save();
});
// Lock Screen Routing
Route::get('screenlock', 'Admin\AdminDashboardController@screenlock');


