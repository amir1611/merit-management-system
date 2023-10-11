<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentList extends Model
{
    use HasFactory;

    /**
     * The programs that belong to the student.
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class)->withTimestamps();
    }
}
