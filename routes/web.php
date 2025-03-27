<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes étudiant
Route::prefix('student')->group(function () {
    Route::get('/register', [StudentController::class, 'showRegistrationForm'])->name('student.register.form');
    Route::post('/register', [StudentController::class, 'register'])->name('student.register');
    Route::get('/login', [StudentController::class, 'showLoginForm'])->name('student.login.form');
    Route::post('/login', [StudentController::class, 'login'])->name('student.login');
    Route::post('/logout', [StudentController::class, 'logout'])->name('student.logout');
});

// Routes de vote
Route::middleware(['auth'])->group(function () {
    Route::get('/vote', [CandidateController::class, 'index'])->name('vote.index');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
});

// Routes admin
Route::prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // Gestion des étudiants
    Route::prefix('etudiants')->group(function () {
        Route::get('/', [AdminController::class, 'etudiants'])->name('admin.etudiants');
        Route::get('/data', [AdminController::class, 'getEtudiantsData'])->name('admin.etudiants.data');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.etudiants.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('admin.etudiants.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('admin.etudiants.destroy');
    });

    // Gestion des candidats
    Route::get('/candidats/data', function() {
        $candidats = App\Models\User::where('role', 'candidate')->with('candidate')->paginate(10);
        return view('admin.partials.candidats', compact('candidats'));
    })->name('admin.candidats.data');
    Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
});

// Pour les besoins de développement - A supprimer en production
if (app()->environment('local')) {
    Route::get('/test-capture', function() {
        $request = Request::capture();
        return response()->json([
            'method' => $request->method(),
            'path' => $request->path(),
            'all' => $request->all()
        ]);
    });
}