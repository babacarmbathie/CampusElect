<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['getVotes']);
    }

    public function getVotes()
    {
        $currentElection = Election::with(['candidates' => function($query) {
            $query->withCount('votes');
        }])->where('status', 1)->first();

        if (!$currentElection) {
            return response()->json([
                'totalVotes' => 0,
                'candidates' => []
            ]);
        }

        return response()->json([
            'totalVotes' => $currentElection->candidates->sum('votes_count'),
            'candidates' => $currentElection->candidates->map(function($candidate) {
                return [
                    'name' => $candidate->name,
                    'votes' => $candidate->votes_count
                ];
            })
        ]);
    }
}