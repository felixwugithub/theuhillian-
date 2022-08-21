<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function club(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function club_post_pictures(){
        return $this->hasMany(ClubPostPicture::class);
    }
}
