<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teacher_id', 'course_id'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function learningResources()
    {
        return $this->hasMany(LearningResource::class);
    }
}
