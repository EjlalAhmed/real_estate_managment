<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ApartmentController as UserApartmentController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ApartmentController as AdminApartmentController;
use App\Http\Controllers\Admin\FloorController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', fn () => view('auth.register'))->name('register');

Route::post('/register', function () {
    $data = request()->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    $user = \App\Models\User::create([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => bcrypt($data['password']),
    ]);

    $user->assignRole('user');

    auth()->login($user);

    return redirect()->route('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD (ALL USERS)
    |--------------------------------------------------------------------------
    */
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    /*
    |--------------------------------------------------------------------------
    | APARTMENTS (PERMISSION BASED)
    |--------------------------------------------------------------------------
    */
    Route::middleware('permission:view apartments')->group(function () {
        Route::get('/apartments', [UserApartmentController::class, 'index'])
            ->name('user.apartments');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN PANEL
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware('role:admin')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('admin.dashboard');

            // Users CRUD
            Route::resource('users', AdminUserController::class)
                ->only(['index', 'create', 'store'])
                ->names('admin.users');

            // User permissions
            Route::get('users/{user}/permissions',
                [AdminUserController::class, 'permissions'])
                ->name('admin.users.permissions');

            Route::post('users/{user}/permissions',
                [AdminUserController::class, 'syncPermissions'])
                ->name('admin.users.permissions.sync');

            // Apartments CRUD
            Route::resource('apartments', AdminApartmentController::class)
                ->names('admin.apartments');

            // Floors
            Route::resource('floors', FloorController::class)
                ->names('admin.floors');

            // Rooms
            Route::resource('rooms', RoomController::class)
                ->names('admin.rooms');

            // AJAX
            Route::get('/ajax/floors/{apartment}', [AjaxController::class, 'floors']);
            Route::get('/ajax/rooms/{floor}', [AjaxController::class, 'rooms']);
        });

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| FALLBACK
|--------------------------------------------------------------------------
*/
Route::fallback(fn () => redirect('/login'));
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER BOOKINGS
    |--------------------------------------------------------------------------
    */
    Route::middleware('permission:create booking')->group(function () {

        Route::post('/bookings', [BookingController::class, 'store'])
            ->name('bookings.store');

        Route::get('/my-bookings', [BookingController::class, 'index'])
            ->middleware('permission:view own bookings')
            ->name('bookings.index');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN BOOKINGS
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware('permission:manage bookings')
        ->group(function () {

            Route::get('/bookings', [AdminBookingController::class, 'index'])
                ->name('admin.bookings.index');

            Route::post('/bookings/{booking}/status',
                [AdminBookingController::class, 'updateStatus'])
                ->name('admin.bookings.status');
        });
});
