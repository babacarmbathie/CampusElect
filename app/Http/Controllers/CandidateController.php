<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;  
use App\Models\Election;  
  
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    

    public function index()
    {
        // Récupérer l'élection en cours (status = 1, par exemple pour "ouverte")
        $currentElection = Election::where('status', 1)->first();
    
        if (!$currentElection) {
            // Optionnel : gérer le cas où aucune élection n'est en cours
            abort(404, "Aucune élection en cours.");
        }
    
        // Récupérer tous les candidats appartenant à l'élection en cours
        $candidates = Candidate::where('election_id', $currentElection->id)->get();
    
        // Calculer le total des votes pour l'élection en cours
        $totalVotes = \App\Models\Vote::where('election_id', $currentElection->id)->count();
    
        // Pour chaque candidat, calculer le pourcentage de votes
        foreach ($candidates as $candidate) {
            $candidateVotes = \App\Models\Vote::where('candidate_id', $candidate->id)->count();
            $candidate->vote_percentage = $totalVotes > 0 
                ? round(($candidateVotes / $totalVotes) * 100)
                : 0;
        }
    
        // Récupérer le vote de l'utilisateur connecté (si disponible)
        $vote = null;
        if (auth()->check() && auth()->user()->student) {
            $vote = \App\Models\Vote::where('student_id', auth()->user()->student->id)
                ->where('election_id', $currentElection->id)
                ->first();
        }
    
        return view('vote', compact('candidates', 'currentElection', 'vote'));
    }
    
}
