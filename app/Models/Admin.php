<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'user_id',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Méthodes de gestion des étudiants
    public function addStudent(array $data)
    {
        // Exemple : création d'un nouvel utilisateur étudiant et de son profil student
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        return Student::create([
            'user_id' => $user->id,
            'student_code' => $data['student_code'],
        ]);
    }

    public function updateStudent(Student $student, array $data)
    {
        // Mise à jour du profil étudiant
        $student->update($data);
    }

    public function deleteStudent(Student $student)
    {
        // Suppression de l'étudiant (et de l'utilisateur associé par cascade)
        $student->delete();
    }

    // Méthodes de gestion des élections
    public function startElection(Election $election)
    {
        $election->update(['status' => 1]); // 1 = OPEN par exemple
    }

    public function stopElection(Election $election)
    {
        $election->update(['status' => 2]); // 2 = CLOSED
    }

    public function resetElection(Election $election)
    {
        $election->update(['status' => 3]); // 3 = RESET ou autre statut
    }

    // Méthodes de gestion des candidats
    public function addCandidate(array $data)
    {
        return Candidate::create($data);
    }

    public function updateCandidate(Candidate $candidate, array $data)
    {
        $candidate->update($data);
    }

    public function deleteCandidate(Candidate $candidate)
    {
        $candidate->delete();
    }
}
