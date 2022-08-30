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

    public function updateAllRatings(){
        foreach (Course::all() as $course){
            $personalityAvg = $course->reviews->avg('personality');
            $fairnessAvg = $course->reviews->avg('fairness');
            $easinessAvg = $course->reviews->avg('easiness');
            $overallAvg = ($personalityAvg + $easinessAvg + $fairnessAvg)/3;

            $course->update([
                'overall' => $overallAvg,
                'personality' => $personalityAvg,
                'easiness' => $easinessAvg,
                'fairness' => $fairnessAvg
            ],
            );
            $course->update(
                [
                    'review_count' => count($course->reviews)
                ]
            );
        }
    }
}
