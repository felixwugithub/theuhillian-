<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Article extends Model
{
    protected $guarded = [];
    use HasFactory;
    use HasRichText;

    protected $richTextFields = [
        'content'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function articlePDf(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ArticlePDF::class);
    }
}
