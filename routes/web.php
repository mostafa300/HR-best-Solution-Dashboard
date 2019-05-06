<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('departments', 'Admin\DepartmentsController');
    Route::post('departments_mass_destroy', ['uses' => 'Admin\DepartmentsController@massDestroy', 'as' => 'departments.mass_destroy']);
    Route::post('departments_restore/{id}', ['uses' => 'Admin\DepartmentsController@restore', 'as' => 'departments.restore']);
    Route::delete('departments_perma_del/{id}', ['uses' => 'Admin\DepartmentsController@perma_del', 'as' => 'departments.perma_del']);
    Route::resource('transactions', 'Admin\TransactionsController');
    Route::post('transactions_mass_destroy', ['uses' => 'Admin\TransactionsController@massDestroy', 'as' => 'transactions.mass_destroy']);
    Route::post('transactions_restore/{id}', ['uses' => 'Admin\TransactionsController@restore', 'as' => 'transactions.restore']);
    Route::delete('transactions_perma_del/{id}', ['uses' => 'Admin\TransactionsController@perma_del', 'as' => 'transactions.perma_del']);
    Route::resource('tasks', 'Admin\TasksController');
    Route::post('tasks_mass_destroy', ['uses' => 'Admin\TasksController@massDestroy', 'as' => 'tasks.mass_destroy']);
    Route::post('tasks_restore/{id}', ['uses' => 'Admin\TasksController@restore', 'as' => 'tasks.restore']);
    Route::delete('tasks_perma_del/{id}', ['uses' => 'Admin\TasksController@perma_del', 'as' => 'tasks.perma_del']);
    Route::resource('settings', 'Admin\SettingsController');
    Route::post('settings_mass_destroy', ['uses' => 'Admin\SettingsController@massDestroy', 'as' => 'settings.mass_destroy']);
    Route::post('settings_restore/{id}', ['uses' => 'Admin\SettingsController@restore', 'as' => 'settings.restore']);
    Route::delete('settings_perma_del/{id}', ['uses' => 'Admin\SettingsController@perma_del', 'as' => 'settings.perma_del']);



 
});
