<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articlePDf(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ArticlePDF::class);
    }
}
