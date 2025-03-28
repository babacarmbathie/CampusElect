<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Récupérer tous les utilisateurs avec leurs étudiants associés
        $users = User::with('student')
                    ->whereHas('student')
                    ->get();
        
        return view('etudiants', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Supprimer d'abord l'étudiant associé
        if ($user->student) {
            $user->student->delete();
        }
        
        // Puis supprimer l'utilisateur
        $user->delete();
        
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
    }

    public function edit($id)
    {
        $user = User::with('student')->findOrFail($id);
        return view('edit_etudiant', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'student_code' => 'required|string|regex:/^P[0-9]+$/|unique:students,student_code,'.$user->student->id
        ]);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        $user->student->update([
            'student_code' => strtoupper(str_replace(' ', '', $request->student_code))
        ]);
        
        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès');
    }
}