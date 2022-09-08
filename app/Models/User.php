<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelLike\Traits\Liker;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Liker;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }
    public function profile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Profile::class);
    }
    public function reviewHelpfuls(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ReviewHelpful::class);
    }
    public function commentLikes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    public function course_members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseMember::class);
    }

    public function club_members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClubMember::class);
    }

    public function course_requests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CourseRequest::class);
    }

    public function canRequest(User $user): bool
    {
        return $user->course_requests()->today()->count() < 1;
    }

    public function article_comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ArticleComment::class);
    }

}
