<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubPostPicture extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function club_post(){
        return $this->belongsTo(ClubPost::class);
    }
}
