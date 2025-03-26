<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false; // Si vous ne souhaitez qu'un created_at

    protected $fillable = [
        'student_id',
        'election_id',
        'candidate_id',
        'created_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
