<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
 

class StudentController extends Controller
{
    // Affiche le formulaire d'inscription
    public function showRegistrationForm()
    {
        return view('auth.student_register');
    }

    // Traitement de l'inscription
    public function register(Request $request)
    {
        // Nettoyage et formatage du code étudiant
        $formattedCode = strtoupper(str_replace(' ', '', $request->student_code));
        $request->merge(['student_code' => $formattedCode]);

        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|regex:/^[^\s@]+@ugb\.edu\.sn$/|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'student_code' => 'required|string|regex:/^P[0-9]+$/|unique:students',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Création de l'étudiant
        Student::create([
            'user_id' => $user->id,
            'student_code' => $validated['student_code'],
        ]);

        return redirect()->route('student.login.form')->with('success', 'Inscription réussie, veuillez vous connecter.');
    }

    public function login(Request $request)
    {
        // Validation des champs obligatoires
        $request->validate([
            'login'    => 'required',
            'password' => 'required',
        ]);
    
        $login = $request->input('login');
        $password = $request->input('password');
    
        // Détermination du type d'identifiant
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            // Si c'est un email, on l'utilise directement
            $credentials = [
                'email'    => $login,
                'password' => $password,
            ];
        } else {
            // Sinon, on suppose qu'il s'agit d'un code étudiant
            $studentCode = strtoupper(str_replace(' ', '', $login));
            $student = Student::where('student_code', $studentCode)->first();
    
            if (!$student) {
                throw ValidationException::withMessages([
                    'login' => 'Identifiants incorrects ou compte inexistant.',
                ]);
            }
    
            // Utilisation de l'email lié à l'utilisateur associé à l'étudiant
            $credentials = [
                'email'    => $student->user->email,
                'password' => $password,
            ];
        }
    
        // Tentative d'authentification avec les informations recueillies
        if (Auth::attempt($credentials)) {
            // Régénération de la session pour éviter la fixation de session
            $request->session()->regenerate();
    
            // Redirection vers la page de vote après connexion réussie
            return redirect()->intended('/vote')->with('success', 'Connexion réussie');
        }
    
        // Si l'authentification échoue, on renvoie une exception de validation
        throw ValidationException::withMessages([
            'login' => 'Les informations d\'identification sont incorrectes.',
        ]);
    }
    
    // ... Les autres méthodes restent inchangées ...
    

    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.student_login');
    }

  

    // Déconnexion (facultatif)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('student.login.form');
    }

    //VERIF AVEC jQuery
    
    public function checkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $exists = User::where('email', $request->email)->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email déjà utilisé' : 'Email disponible'
        ]);
    }

}
