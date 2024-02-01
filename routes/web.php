<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PaginaPrincipalController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Dashboard\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Auth::routes(['verify' => true]);
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PaginaPrincipalController::class, 'index'])->name('pagina_principal');
Route::get('/categoria-{id}', [PaginaPrincipalController::class, 'showJobsFromCategory'])->name('show-jobs-from-category');

Route::get('/contacto', [ContactController::class, 'showContactForm'])->name('contact.show');
Route::post('/contacto', [ContactController::class, 'submitContactForm'])->name('contact.submit');

Route::get('/nosotros', [PaginaPrincipalController::class , 'nosotros'])->name('nosotros-info');

// Route::get('/dashboard/index', [Dashboard::class, 'index'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    // Rutas protegidas que requieren verificación de correo electrónico
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Rutas para la creación
    // Rutas para la creación de Trabajos
    Route::get('/dashboard/create-job', [DashboardController::class, 'showCreateJobForm'])->name('dashboard.create-job');
    Route::post('/dashboard/store-job', [DashboardController::class, 'storeJob'])->name('dashboard.store-job');

    Route::get('/dashboard/create-category', [DashboardController::class, 'showCreateCategoryForm'])->name('dashboard.create-category');
    Route::post('/dashboard/store-category', [DashboardController::class, 'storeCategory'])->name('dashboard.store-category');

    // Rutas para la visualización de trabajos
    Route::get('/dashboard/show-jobs', [DashboardController::class, 'showJobs'])->name('dashboard.show-jobs');
    Route::get('/dashboard/show-job/{id}/edit', [DashboardController::class, 'editJob'])->name('job.edit');
    Route::put('/dashboard/show-job/{id}', [DashboardController::class, 'updateJob'])->name('job.update');
    Route::delete('/dashboard/show-job/{id}/delete', [DashboardController::class, 'destroyJobs'])->name('job.destroy');
    // Rutas para la visualización de categorias
    Route::get('/dashboard/show-category', [DashboardController::class, 'showCategory'])->name('dashboard.show-category');
    Route::get('/dashboard/show-category/{id}/edit', [DashboardController::class, 'editCategory'])->name('category.edit');
    Route::put('/dashboard/show-category/{id}', [DashboardController::class, 'updateCategory'])->name('category.update');
    Route::delete('/dashboard/show-category/{id}/delete', [DashboardController::class, 'destroyCategory'])->name('category.destroy');
});

//Auth

// Rutas de Autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas de Recuperación de Contraseña

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/verification/error', [VerificationController::class, 'error'])->name('verification.error');
Route::view('/already-verified', 'auth.already-verified')->name('already-verified');
