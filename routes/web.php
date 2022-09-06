<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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


Route::get("/auth", function () {
    $user = User::whereEmail("roob.marshall@example.org")->first();
    Auth::login($user, true);
});

Route::get("/me", function () {

    dd(Auth::user()->name);
});


Route::get("/login", function () {

    return Socialite::driver('google')->redirect();
});





Route::get("/google-login", function () {

    $s_user = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $s_user->email],
        [
            'name' => $s_user->name,
            'password' => Hash::make(Str::random(8))
        ]
    );

    Auth::login($user, true);
    
     echo "hello ".Auth::user()->name;

});
