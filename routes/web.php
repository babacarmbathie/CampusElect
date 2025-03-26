<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoteController;

Route::get('/register', [StudentController::class, 'showRegistrationForm'])->name('student.register.form');
Route::post('/register', [StudentController::class, 'register'])->name('student.register');

Route::get('/login', [StudentController::class, 'showLoginForm'])->name('student.login.form');
Route::post('/login', [StudentController::class, 'login'])->name('student.login');

// Optionnel : route de déconnexion
Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');

// Exemple de page d'accueil après connexion
Route::get('/', function () {
    return "Accueil - " . session('success');
});

Route::get('/', function () {
    return view('welcome');

})->name('welcome');

 
Route::middleware(['auth'])->group(function () {
    Route::get('/vote', [CandidateController::class, 'index'])->name('vote.index');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
});

 
///du jQuery pour qqls verifs
// Route::post('/check-email', [StudentController::class, 'checkEmail']);

// Route::get('/', function () {
//     return view('welcome');
// });


