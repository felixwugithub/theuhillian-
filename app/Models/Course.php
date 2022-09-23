<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model

{
    protected $guarded = [];
    use HasFactory;

    public function course_members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseMember::class);
    }



    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function courseJoined(User $user){
        return $this->course_members->contains('user_id', $user->id);
    }

}
