<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_code',
        'ufr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // La méthode vote() pour créer un vote
    public function vote(Election $election, Candidate $candidate)
    {
        // Vérifier si l'étudiant a déjà voté dans cette élection
        if ($this->votes()->where('election_id', $election->id)->exists()) {
            throw new \Exception("Vous avez déjà voté pour cette élection.");
        }

        return Vote::create([
            'student_id'   => $this->id,
            'election_id'  => $election->id,
            'candidate_id' => $candidate->id,
        ]);
    }
}
