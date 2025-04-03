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

        // Déterminer le statut de l'élection
        $electionStatus = $currentElection->status;
    
        return view('vote', compact('candidates', 'currentElection', 'vote', 'electionStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'election_id' => 'required|exists:elections,id',
            'program' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        Candidate::create([
            'name' => $request->name,
            'election_id' => $request->election_id,
            'position' => $request->position,
            'program' => $request->program,
            'photo_path' => $request->file('photo') ? $request->file('photo')->store('candidates', 'public') : null
        ]);
    
        return back()->with('success', 'Candidat ajouté avec succès');
    }

    /**
     * Mise à jour d'un candidat existant
     */
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'election_id' => 'required|exists:elections,id',
            'program' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'election_id' => $request->election_id,
            'program' => $request->program,
        ];

        // Traiter la photo uniquement si une nouvelle est fournie
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo s'il y en a une
            if ($candidate->photo_path && \Storage::disk('public')->exists($candidate->photo_path)) {
                \Storage::disk('public')->delete($candidate->photo_path);
            }
            
            // Stocker la nouvelle photo
            $data['photo_path'] = $request->file('photo')->store('candidates', 'public');
        }

        $candidate->update($data);

        return back()->with('success', 'Candidat modifié avec succès');
    }

    /**
     * Suppression d'un candidat
     */
    public function destroy(Candidate $candidate)
    {
        // Supprimer la photo associée au candidat s'il y en a une
        if ($candidate->photo_path && \Storage::disk('public')->exists($candidate->photo_path)) {
            \Storage::disk('public')->delete($candidate->photo_path);
        }

        // Supprimer les votes associés à ce candidat
        \App\Models\Vote::where('candidate_id', $candidate->id)->delete();

        // Supprimer le candidat
        $candidate->delete();

        return back()->with('success', 'Candidat supprimé avec succès');
    }
}