<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Election;
use App\Models\Candidate;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('student')
                   ->whereHas('student')
                   ->paginate(10);

        $elections = Election::all();
        $candidates = Candidate::all();

        return view('admin.admin', compact('users', 'elections', 'candidates'));
    }

    public function getEtudiantsData()
    {
        $users = User::with('student')
                   ->whereHas('student')
                   ->paginate(10);

        return view('admin.partials.etudiants', compact('users'));
    }

    /**
     * Récupère les données des candidats pour l'affichage dans le tableau de bord admin
     */
    public function getCandidatsData()
    {
        $elections = Election::all();
        $candidates = Candidate::with('election')->get();

        return view('admin.partials.candidats', compact('candidates', 'elections'));
    }
}