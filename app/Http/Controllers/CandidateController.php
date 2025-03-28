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
        // Votre méthode index existante (inchangée)
        $currentElection = Election::where('status', 1)->first();
    
        if (!$currentElection) {
            abort(404, "Aucune élection en cours.");
        }
    
        $candidates = Candidate::where('election_id', $currentElection->id)->get();
        $totalVotes = \App\Models\Vote::where('election_id', $currentElection->id)->count();
    
        foreach ($candidates as $candidate) {
            $candidateVotes = \App\Models\Vote::where('candidate_id', $candidate->id)->count();
            $candidate->vote_percentage = $totalVotes > 0 
                ? round(($candidateVotes / $totalVotes) * 100)
                : 0;
        }
    
        $vote = null;
        if (auth()->check() && auth()->user()->student) {
            $vote = \App\Models\Vote::where('student_id', auth()->user()->student->id)
                ->where('election_id', $currentElection->id)
                ->first();
        }
    
        return view('vote', compact('candidates', 'currentElection', 'vote'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'election_id' => 'required|exists:elections,id',
            'program' => 'required|string' // Ajout de la validation
        ]);
    
        Candidate::create([
            'name' => $request->name,
            'election_id' => $request->election_id,
            'position' => $request->position,
            'program' => $request->program, // Champ ajouté
            'photo' => $request->file('photo') ? $request->file('photo')->store('candidates', 'public') : null
        ]);
    
        return back()->with('success', 'Candidat ajouté avec succès');
    }
}