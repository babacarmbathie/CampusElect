<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;


// Route pour la page "À Propos"
Route::get('/a-propos', function () {
    return view('about');  
})->name('about');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');  

Route::get('/admin/candidats/data', function() {
    $candidats = App\Models\User::where('role', 'candidate')->with('candidate')->paginate(10);
    return view('admin.partials.candidats', compact('candidats'));
})->name('admin.candidats.data');

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
    Route::get('/vote/progress', [VoteController::class, 'progress'])->name('vote.progress');
    Route::get('/votes/data', [VoteController::class, 'getVotes'])->name('votes.getVotes');
});
// Routes admin
Route::prefix('admin')->group(function () {

     Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');

    // Gestion des étudiants
    Route::prefix('etudiants')->group(function () {
        Route::get('/', [AdminController::class, 'etudiants'])->name('admin.etudiants');
        Route::get('/data', [AdminController::class, 'getEtudiantsData'])->name('admin.etudiants.data');
        Route::post('/', [StudentController::class, 'store'])->name('students.store');
        Route::put('/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

   // Gestion des candidats
   Route::get('/candidats/data', [AdminController::class, 'getCandidatsData'])->name('admin.candidats.data');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');
Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
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

// Routes des pages statiques
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/histoire', function () {
    return view('about', ['section' => 'histoire']);
})->name('histoire');

Route::get('/confidentialite', function () {
    return view('confidentialite');
})->name('confidentialite');