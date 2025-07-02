<?php

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
Route::get('/assortment', function () {
    return view('assortment');
});
Route::get('/assignment-track-records', function () {
    return view('assignment_track_records');
});
Route::get('/dashboard/biodata/edit', [BiodataController::class, 'edit'])->name('biodata');
Route::post('/dashboard/biodata/update', [BiodataController::class, 'update']);


Route::get('/placement-track-records', function () {
    return view('placement_track_records');
});
Route::get('/reward-track-records', function () {
    return view('reward_track_records');
});
Route::get('/occupation', function () {
    return view('occupation');
});
Route::get('/biodata', function () {
    return view('biodata');
});
Route::get('/posisi', function () {
    return view('position');
});
Route::get('/dashboard/family/edit', [FamilyController::class, 'edit'])->name('family.edit');
Route::post('/dashboard/family/update', [FamilyController::class, 'update'])->name('family.update');


Route::get('/profile', function () {
    return view('dashboard');
})->name('profile');

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


