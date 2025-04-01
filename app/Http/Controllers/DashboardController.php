<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // Si c'est le nom réel de votre modèle
use App\Models\Candidate; // Si c'est le nom réel de votre modèle
use App\Models\Vote;

class DashboardController extends Controller
{
    public function getStats()
    {
        
        $etudiantsTotal = Student::count();
        $candidatsTotal = Candidate::count(); 
        $votesTotal = Vote::count();
    
        // Étudiants ayant voté (actifs)
        $etudiantsActifs = Vote::distinct('student_id')->count('student_id');
    
        // Étudiants inactifs (inscrits mais n'ayant pas voté)
        $etudiantsInactifs = $etudiantsTotal - $etudiantsActifs;
    
        // Récupérer les votes par candidat
        $votesParCandidat = Candidate::withCount('votes')->get(['id', 'name as nom', 'votes_count']);
    
        return response()->json([
            'etudiants' => $etudiantsTotal,
            'candidats' => $candidatsTotal,
            'votes' => $votesTotal,
            'etudiants_actifs' => $etudiantsActifs,
            'etudiants_inactifs' => $etudiantsInactifs,
            'votes_par_candidat' => $votesParCandidat
        ]);
    }
}