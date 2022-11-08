<?php

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    $leader = \App\Models\User::where('jabatan', 'leader')->count();
    $anggota = \App\Models\User::where('jabatan', 'anggota')->count();
    return view('dashboard', compact('leader', 'anggota'));
})->middleware(['auth'])->name('dashboard');


//leader
Route::get('/leader', [App\Http\Controllers\leaderController::class, 'index'])->name('leaders');
Route::get('/leader/lihat/{id}', [App\Http\Controllers\leaderController::class, 'lihat'])->name('leader-lihat');
Route::post('/leader/store', [App\Http\Controllers\leaderController::class, 'store'])->name('leader-store');
Route::get('/leader/all', [App\Http\Controllers\leaderController::class, 'all'])->name('leader-all');
Route::get('/leader/belumkerjakan', [App\Http\Controllers\leaderController::class, 'belumkerjakan'])->name('leader-belumkerjakan');
Route::get('/leader/edit', [App\Http\Controllers\leaderController::class, 'edit'])->name('leader-edit');
Route::post('/leader/update', [App\Http\Controllers\leaderController::class, 'update'])->name('leader-update');
Route::delete('/leader/delete', [App\Http\Controllers\leaderController::class, 'delete'])->name('leader-delete');

Route::get('/anggota/belumkerjakan', [App\Http\Controllers\AnggotaController::class, 'anggota_belum_kerjakan'])->name('dimmas_anjing');
Route::get('/dimmas', [App\Http\Controllers\AnggotaController::class, 'dimmas']);
Route::get('/anggota', [App\Http\Controllers\AnggotaController::class, 'index'])->name('anggotas');
Route::get('/anggota/lihat/{id}', [App\Http\Controllers\AnggotaController::class, 'lihat'])->name('anggota-lihat');
Route::get('/anggota/lihat/belumkerjakan/{id}', [App\Http\Controllers\AnggotaController::class, 'lihat_belumkerjakan'])->name('anggota-lihat-belumkerjakan');
Route::get('/anggota/all', [App\Http\Controllers\AnggotaController::class, 'all'])->name('anggota-all');
Route::get('/anggota/belumkerjakan', [App\Http\Controllers\AnggotaController::class, 'belumkerjakan'])->name('anggota-belumkerjakan');
Route::get('/anggota/edit', [App\Http\Controllers\AnggotaController::class, 'edit'])->name('anggota-edit');
Route::post('/anggota/update', [App\Http\Controllers\AnggotaController::class, 'update'])->name('anggota-update');
Route::delete('/anggota/delete', [App\Http\Controllers\AnggotaController::class, 'delete'])->name('anggota-delete');


require __DIR__.'/auth.php';
