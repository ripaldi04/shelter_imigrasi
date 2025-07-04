<?php

use App\Http\Controllers\Employee\AssortmentController;
use App\Http\Controllers\Employee\AssortmentTrackRecordsController;
use App\Http\Controllers\Employee\PositionTrackRecordsController;
use App\Http\Controllers\Identity\FamilyController;
use App\Http\Controllers\Identity\BiodataController;
use App\Http\Controllers\Identity\PersonalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Authentication\RegisterController;




Route::get('/', function () {
    return view('home');
})->name('home');
;
Route::get('/pengumuman', function () {
    return view('announcement');
});
// Route::get('/personal', function () {
//     return view('identity');
// });
// Route::get('/assortment', function () {
//     return view('assortment');
// });
Route::get('/assignment-track-records', function () {
    return view('assignment_track_records');
});

Route::get('/placement-track-records', function () {
    return view('placement_track_records');
});
Route::get('/reward-track-records', function () {
    return view('reward_track_records');
});
// Route::get('/occupation', function () {
//     return view('position_track_records');
// });
Route::get('/posisi', function () {
    return view('position');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/biodata/edit', [BiodataController::class, 'edit'])->name('biodata');
    Route::post('/dashboard/biodata/update', [BiodataController::class, 'update']);

    Route::get('/dashboard/family/edit', [FamilyController::class, 'edit'])->name('family.edit');
    Route::post('/dashboard/family/update', [FamilyController::class, 'update'])->name('family.update');
    Route::put('/dashboard/family/update/{id}', [FamilyController::class, 'update2'])->name('family.update2');
    Route::delete('/dashboard/family/delete/{id}', [FamilyController::class, 'destroy'])->name('family.destroy');

    Route::post('/dashboard/assortment/store', [AssortmentTrackRecordsController::class, 'store'])->name('assortment.store');
    Route::get('/dashboard/assortment/edit', [AssortmentTrackRecordsController::class, 'index']);
    Route::put('/dashboard/assortment/update/{id}', [AssortmentTrackRecordsController::class, 'update']);
    Route::delete('/dashboard/assortment/delete/{id}', [AssortmentTrackRecordsController::class, 'destroy'])->name('assortment.delete');

    Route::post('/dashboard/position/store', [PositionTrackRecordsController::class, 'store'])->name('position.store');
    Route::get('/dashboard/position/edit', [PositionTrackRecordsController::class, 'index'])->name('position.index');
    Route::put('/dashboard/position/update/{id}', [PositionTrackRecordsController::class, 'update'])->name('position.update');
    Route::delete('/dashboard/position/delete/{id}', [PositionTrackRecordsController::class, 'destroy'])->name('position.destroy');





    Route::get('/profile', function () {
        return view('dashboard');
    })->name('profile');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('filament.admin.auth.logout');

// Route::get('/login', function () {
//     return view('filament.admin.pages.auth.login');
// })->name('login');

Route::get('/captcha', function () {
    return captcha_img(); // akan otomatis mengembalikan image base64
})->name('captcha');

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


