<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternationalCompanyController;
use App\Http\Controllers\DomesticCompanyController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AfcshipController;
use App\Http\Controllers\RoaController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\AshanlsController;
use App\Models\Ashanls;
use App\Http\Controllers\AshftController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TemController;
use App\Http\Controllers\UaController;
use App\Models\Ashft;
use App\Http\Controllers\SaController;

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

Route::middleware('guest')->group(function () {
    // Home route
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


    // Menangani login form submission
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard routes
    // baru
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard.index');
    // Shipment routes
    Route::resource('shipments', ShipmentController::class);

    // Route untuk halaman upload file Excel
    Route::get('upload/file', [ShipmentController::class, 'uploadFile'])->name('shipments.upload');
    Route::post('upload/file', [ShipmentController::class, 'importFile'])->name('shipments.import');

    // Route untuk dashboard dengan filter bulan
    Route::get('dashboard', [ShipmentController::class, 'dashboard'])->name('dashboard');

    Route::resource('shipments', ShipmentController::class)->except(['show']);
    Route::get('/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::get('shipments/{activity}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
    Route::put('shipments/{activity}', [ShipmentController::class, 'update'])->name('shipments.update');
    Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroy'])->name('shipments.destroy');
    Route::get('/get-companies', [ShipmentController::class, 'getCompanies'])->name('shipments.getCompanies');
    Route::get('activities/{activity}/shipments/create', [ShipmentController::class, 'create'])->name('shipments.create');
    Route::post('activities/{activity}/shipments', [ShipmentController::class, 'store'])->name('shipments.store');


    // Domestic Company routes
    Route::resource('domestic_companies', DomesticCompanyController::class);
    Route::get('/domestic-companies', [DomesticCompanyController::class, 'index'])->name('domestic_companies.index');
    Route::get('/domestic-companies/create', [DomesticCompanyController::class, 'create'])->name('domestic_companies.create');
    Route::post('/domestic-companies', [DomesticCompanyController::class, 'store'])->name('domestic_companies.store');
    Route::get('/domestic-companies/{id}', [DomesticCompanyController::class, 'show'])->name('domestic_companies.show');

    // International Company routes
    Route::resource('international_companies', InternationalCompanyController::class);
    Route::get('/international-companies', [InternationalCompanyController::class, 'index'])->name('international_companies.index');
    Route::get('/international-companies/create', [InternationalCompanyController::class, 'create'])->name('international_companies.create');
    Route::post('/international-companies', [InternationalCompanyController::class, 'store'])->name('international_companies.store');
    Route::get('/international-companies/{id}', [InternationalCompanyController::class, 'show'])->name('international_companies.show');


    // Route surveyor\
    Route::resource('surveyors', SurveyorController::class);
    Route::get('/surveyors', [SurveyorController::class, 'index'])->name('surveyors.index');
    Route::get('/surveyors/create', [SurveyorController::class, 'create'])->name('surveyors.create');
    Route::post('/surveyors', [SurveyorController::class, 'store'])->name('surveyors.store');

    // Export routes
    Route::get('/index', [ExportController::class, 'index'])->name('index');
    Route::get('/export', [ExportController::class, 'export'])->name('export');
    Route::get('/export/{id}', [ExportController::class, 'export'])->name('export');

    // Activity routes
    Route::resource('activities', ActivityController::class);
    // web.php
    Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
    Route::get('activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');

    // Menampilkan form untuk membuat ROA baru terkait dengan activity tertentu
    Route::get('activities/{activity}/shipments/{shipment}/roas/create', [RoaController::class, 'create'])->name('roa.create');
    Route::post('activities/{activity}/shipments/{shipment}/roas', [RoaController::class, 'store'])->name('roa.store');
    // Route untuk menampilkan form edit ROA

    Route::get('/roa/{roa}/edit', [RoaController::class, 'edit'])->name('roa.edit');
    Route::put('/roa/{roa}', [RoaController::class, 'update'])->name('roa.update');


    Route::get('activities/{activity}/shipments/{shipment}/coas/create', [CoaController::class, 'create'])->name('coas.create');
    Route::post('activities/{activity}/shipments/{shipment}/coas', [CoaController::class, 'store'])->name('coas.store');
    Route::get('/coa/{coa}/edit', [CoaController::class, 'edit'])->name('coas.edit');
    Route::put('/coa/{coa}', [CoaController::class, 'update'])->name('coas.update');


    Route::get('activities/{activity}/shipments/{shipment}/ashanls/create', [AshanlsController::class, 'create'])->name('ashanls.create');
    Route::post('activities/{activity}/shipments/{shipment}/ashanls', [AshanlsController::class, 'store'])->name('ashanls.store');
    Route::get('/Ash/{ashanls}/edit', [AshanlsController::class, 'edit'])->name('ashanls.edit');
    Route::put('/Ash/{ashanls}', [AshanlsController::class, 'update'])->name('ashanls.update');

    // bagian untuk Ashft
    //Route::get('activities/{activity}/ashft/create', [AshftController::class, 'create'])->name('ashft.create');
    //Route::post('activities/{activity}/ashft', [AshftController::class, 'store'])->name('ashft.store');

    // routes/web.php
    // ashft

    Route::resource('ashfts', AshftController::class);
    // Route::resource('activities/{activity}/shipments/{shipment}/ashfts', AshftController::class)->except(['show']);
    // Rute khusus untuk create, store, edit, update
    // http://projectmagangit.test/activities/2/shipments/3/ashanls/create
    Route::get('activities/{activity}/shipments/{shipment}/ashfts/create', [AshftController::class, 'create'])->name('ashfts.create');
    Route::post('activities/{activity}/shipments/{shipment}/ashfts', [AshftController::class, 'store'])->name('ashfts.store');
    Route::get('/ashfts/{ashft}/edit', [AshftController::class, 'edit'])->name('ashfts.edit');
    Route::put('/ashfts/{ashft}', [AshftController::class, 'update'])->name('ashfts.update');

    Route::get('/tem', [TemController::class, 'index'])->name('tem_index');
    Route::get('/tem/{tem}/edit', [TemController::class, 'edit'])->name('tem.edit');
    Route::put('/tem/{tem}', [TemController::class, 'update'])->name('tem.update');
    Route::get('/activities/{activity}/shipments/{shipment}/tem/create', [TemController::class, 'create'])->name('tems.create');
    Route::post('/tem', [TemController::class, 'store'])->name('tem_store');

    // afcship
    Route::get('/afcship', [AfcshipController::class, 'index'])->name('afcship_index');
    Route::get('/afcship/{afcship}/edit', [AfcshipController::class, 'edit'])->name('afcship.edit');
    Route::put('/afcship/{afcship}', [AfcshipController::class, 'update'])->name('afcship.update');
    Route::get('/activities/{activity}/shipments/{shipment}/afcship/create', [AfcshipController::class, 'create'])->name('afcship.create');
    Route::post('/afcship', [AfcshipController::class, 'store'])->name('afcship_store');

    // uas done edit dan sebagianya
    Route::get('/activities/{activity}/shipments/{shipment}/ua/create', [UaController::class, 'create'])->name('ua.create');
    Route::get('/uas/{uas}/edit', [UaController::class, 'edit'])->name('ua.edit');
    Route::put('/uas/{uas}', [UaController::class, 'update'])->name('ua_update');
    Route::post('/ua', [UaController::class, 'store'])->name('ua_store');

    // sas 
    Route::get('/activities/{activity}/shipments/{shipment}/sa/create', [SaController::class, 'create'])->name('sa.create');
    Route::post('/activities/{activity}/shipments/{shipment}/sa', [SaController::class, 'store'])->name('sa_store');
    Route::resource('sas', SaController::class);

    Route::get('/sas/{sas}/edit', [SaController::class, 'edit'])->name('sa.edit');
    Route::put('/sas/{sa}', [SaController::class, 'update'])->name('sas.update');
    // Route::get('/sa', [SaController::class, 'create'])->name('sa_create');

    Route::get('/users', [AuthController::class,'users'])->name('user-index');
    Route::get('/add-users', [AuthController::class,'adduser'])->name('add-user');
    Route::post('/users', [AuthController::class, 'storeuser'])->name('store-user');
   // Menampilkan form edit user
Route::get('/users/{id}/edit', [AuthController::class, 'edituser'])->name('edit-user');

// Memproses update user
Route::put('/users/{id}', [AuthController::class, 'updateuser'])->name('update-user');
Route::delete('/users/{id}', [AuthController::class, 'deleteuser'])->name('delete-user');

});