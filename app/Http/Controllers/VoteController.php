<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est authentifié
        if (!Auth::check()) {
            return response()->json(['error' => 'Vous devez être connecté pour voter.'], 403);
        }

        try {
            // Valider les données nécessaires
            $validated = $request->validate([
                'candidate_id' => 'required|exists:candidates,id',
                'election_id'  => 'required|exists:elections,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()->first()], 422);
        }

        $user = auth()->user();

        // Vérifier que l'utilisateur possède bien un étudiant associé
        if (!$user->student) {
            return response()->json(['error' => 'Vous devez être un étudiant pour voter.'], 403);
        }

        // Vérifier si l'utilisateur (étudiant) a déjà voté pour cette élection
        $existingVote = Vote::where('student_id', $user->student->id)
            ->where('election_id', $request->election_id)
            ->first();

        if ($existingVote) {
            return response()->json(['error' => 'Vous avez déjà voté pour cette élection.'], 422);
        }

        // Créer le vote
        try {
            Vote::create([
                'student_id'   => $user->student->id,
                'election_id'  => $request->election_id,
                'candidate_id' => $request->candidate_id,
            ]);
        } catch (\Exception $ex) {
            // En cas d'erreur lors de la création, renvoyer un message JSON
            return response()->json(['error' => 'Erreur lors de l\'enregistrement du vote.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Merci d\'avoir voté !']);
    }
}

