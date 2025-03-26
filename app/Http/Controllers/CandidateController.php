<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;  
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    public function index()
    {
        // Récupération de tous les candidats
        // Vous pouvez aussi utiliser la pagination ou filtrer selon l'élection en cours
        $candidates = Candidate::all();

        // Si vous souhaitez calculer dynamiquement le pourcentage de vote,
        // cela peut se faire ici ou dans le modèle Candidate
        foreach ($candidates as $candidate) {
            // Exemple de calcul (adapté à votre logique)
            // Supposons que le modèle Candidate a un attribut 'total_votes'
            // et que vous connaissez le total général des votes
            $totalVotes = 100; // Remplacer par le calcul ou la récupération réelle
            $candidate->vote_percentage = $totalVotes > 0
                ? round(($candidate->total_votes / $totalVotes) * 100)
                : 0;
        }

        return view('vote', compact('candidates'));
    }
}
