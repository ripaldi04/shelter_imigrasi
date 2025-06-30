<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Authentication\RegisterController;



Route::get('/', function () {
    return view('home');
})->name('home');;
Route::get('/pengumuman', function () {
    return view('announcement');
});
Route::get('/posisi', function () {
    return view('position');
});
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


