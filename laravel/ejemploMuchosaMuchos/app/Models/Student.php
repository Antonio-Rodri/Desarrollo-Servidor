<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'dni',
        'name',
        'apellidos',
        'email',
        'curso',
        'asignatura',
        'nota',
        'user_id',
    ];
    public function profesores()
    {
        return $this->belongsToMany(User::class)->withPivot('asignatura', 'nota');
    }
}
