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
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    //Route::get('/', 'WelcomeController@welcome')->name('welcome');
    Route::redirect('/', '/home');
});

// Authentication Routes
Auth::routes();
Auth::routes(['register' => false]);
Route::redirect('/register', '/login');

// Public Routes
Route::group(['middleware' => ['web', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep', 'checkblocked']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
// TODO: remove atmadmin role
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::redirect('/php', '/phpinfo', 301);

    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

// Registered, activated, and is collector routes.
Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin|atmcollector', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('vertical-signals', 'VerticalSignalController')->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    Route::post('search-vertical-signals', 'VerticalSignalController@search')->name('search-vertical-signals');

    Route::resource('intersections', 'IntersectionController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-intersections', 'IntersectionController@search')->name('search-intersections');
    Route::get('api/today-intersections', 'IntersectionController@today')->name('today-intersections');
    Route::get('api/all-intersections', 'IntersectionController@all')->name('all-intersections');

    Route::resource('traffic-poles', 'TrafficPoleController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-traffic-poles', 'TrafficPoleController@search')->name('search-traffic-poles');
    Route::get('api/today-poles', 'TrafficPoleController@today')->name('today-poles');
    Route::get('api/all-poles', 'TrafficPoleController@all')->name('all-poles');

    Route::resource('traffic-tensors', 'TrafficTensorController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-traffic-tensors', 'TrafficTensorController@search')->name('search-traffic-tensors');
    Route::get('api/today-tensors', 'TrafficTensorController@today')->name('today-tensors');
    Route::get('api/all-tensors', 'TrafficTensorController@all')->name('all-tensors');

    Route::resource('regulator-boxes', 'RegulatorBoxController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-regulator-boxes', 'RegulatorBoxController@search')->name('search-regulator-boxes');
    Route::get('api/today-regulators', 'RegulatorBoxController@today')->name('today-regulators');
    Route::get('api/all-regulators', 'RegulatorBoxController@all')->name('all-regulators');

    Route::resource('traffic-lights', 'TrafficLightController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-traffic-lights', 'TrafficLightController@search')->name('search-traffic-lights');
});

// Registered, activated, and is collector routes.
Route::group(['middleware' => ['auth', 'activated', 'role:atmadmin', 'activity', 'twostep', 'checkblocked']], function () {
    Route::resource('signals-inventory', 'SignalInventoryController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-signals-inventory', 'SignalInventoryController@search')->name('search-signals-inventory');

    Route::resource('devices-inventory', 'DeviceInventoryController')->only([
        'index', 'show', 'create', 'store',  'edit', 'update', 'destroy'
    ]);
    Route::post('search-devices', 'DeviceInventoryController@search')->name('search-device-inventory');

    Route::get('/reports/vertical-signals', 'ReportsController@index')->name('reports-vsignals');
    Route::post('/reports/vertical-signals', 'ReportsController@search')->name('vsignal-filters');
});

Route::resource('/workorders', 'WorkOrderController');
Route::resource('/alerts', 'AlertController');
Route::resource('/motives', 'MotiveController');
Route::resource('/priorities', 'PriorityController');
Route::resource('/statuses', 'StatusController');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('search-motives', 'MotiveController@search')->name('search-motives');
Route::post('search-alerts', 'VerticalSignalController@search')->name('search-alerts');

