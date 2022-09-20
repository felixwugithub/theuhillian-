<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function reviewHelpfuls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReviewHelpful::class);
    }

    public function reviewHelpfuledBy(User $user){
        return $this->reviewHelpfuls->contains('user_id', $user->id);
    }

    public function reports(){
        return $this->hasMany(ReviewReport::class);
    }


}
