<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{

    protected $guarded = [];

    use HasFactory;

    public function club_members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClubMember::class);
    }

    public function clubJoined(User $user){
        return $this->club_members->contains('user_id', $user->id);
    }

    public function club_posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClubPost::class);
    }

    public function club_cover_image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ClubCoverImage::class);
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class);

    }

}
