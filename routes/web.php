<?php
use App\Http\Controllers\Member\MemberHomeController;
use App\Http\Controllers\Member\MemberBookBrowserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\DashboardRedirectController::class, 'redirect'])->name('home');
    
    // Admin routes with check.admin middleware and prefix
    Route::middleware(['check.admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('books', BookController::class);
        Route::resource('members', MemberController::class);
        Route::resource('reservations', ReservationController::class);
        Route::resource('fines', FineController::class);
        Route::get('fines-overdue', [FineController::class, 'overdue'])->name('fines.overdue');
        Route::get('fines-due-soon', [FineController::class, 'dueSoon'])->name('fines.due-soon');
    });

    // Member routes with check.member middleware
    Route::middleware(['check.member'])->prefix('member')->name('member.')->group(function () {
        Route::get('/dashboard', [MemberHomeController::class, 'index'])->name('dashboard');
        Route::get('/books', [MemberBookBrowserController::class, 'books'])->name('books');
        Route::post('/books/{book}/reserve', [MemberBookBrowserController::class, 'reserve'])->name('books.reserve');
        Route::delete('/reservations/{reservation}/cancel', [MemberBookBrowserController::class, 'cancelReservation'])->name('reservations.cancel');
    });

    // Common authenticated routes (accessible by both admin and members)
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('profile');
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return view('dashboard');
    })->name('sign-up');

    Route::get('/2fa/setup', [SessionsController::class, 'show2faSetup'])->name('2fa.setup');
    Route::post('/2fa/enable', [SessionsController::class, 'enable2fa'])->name('2fa.enable');
    Route::post('/2fa/disable', [SessionsController::class, 'disable2fa'])->name('2fa.disable');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/2fa/verify', [SessionsController::class, 'show2faVerify'])->name('2fa.verify');
    Route::post('/2fa/verify', [SessionsController::class, 'verify2fa']);
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');