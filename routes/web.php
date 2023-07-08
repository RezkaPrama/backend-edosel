<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InputDokumenDetailController;
use App\Http\Controllers\InputDokumenController;
use App\Http\Controllers\ShelfController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Request;
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

Route::get('/', function () {
    return view('auth.login');
});

//group route with prefix "admin"
Route::prefix('admin')->group(function () {

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function () {

        //route dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

        //route User
        Route::resource('/user', UserController::class, ['as' => 'admin']);
        Route::get('/user/export', [UserController::class, 'export'])->name('admin.user.export');

        //route Rak
        Route::resource('/shelf', ShelfController::class, ['as' => 'admin']);

        //route Input Dokumen
        Route::resource('/dokumen', InputDokumenController::class, ['as' => 'admin']);
        Route::get('/dokumen/exportExcel/{userid}', [InputDokumenController::class, 'exportExcel'])->name('admin.dokumen.exportExcel');

        //route Input Dokumen
        Route::post('/inputDokumenDetail/upload', [InputDokumenDetailController::class, 'upload'])->name('admin.dokumenDetail.upload');
        Route::post('/inputDokumenDetail/uploadCreate', [InputDokumenDetailController::class, 'uploadCreate'])->name('admin.dokumenDetail.uploadCreate');
        Route::get('/inputDokumenDetail/{userid}/{filename}/download', [InputDokumenDetailController::class, 'download'])->name('admin.dokumenDetail.download');
        Route::get('/inputDokumenDetail/{userid}/{filename}/previewPdf', [InputDokumenDetailController::class, 'previewPdf'])->name('admin.dokumenDetail.previewPdf');
        Route::get('/inputDokumenDetail/{id}/{userid}/destroy', [InputDokumenDetailController::class, 'destroy'])->name('admin.dokumenDetail.destroy');

        // Lock Screen
        Route::get('/lock-screen', function () {
            return view('auth.lock-screen');
        })->name('lock-screen');

        // Unlock screen
        Route::post('/unlock-screen', function (Request $request) {
            $password = $request->input('password');
        
            if ($password === 'your-password-here') { // replace with your actual password
                session(['lock-screen-unlocked' => true]);
                return redirect()->intended('/home'); // replace with your desired redirect location
            }
        
            return redirect()
                ->back()
                ->withErrors(['password' => __('The password is incorrect.')]);
        })->name('unlock-screen');

    });
});
