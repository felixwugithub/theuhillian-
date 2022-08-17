<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Tonysm\RichTextLaravel\Models\RichText;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;


class Article extends Model
{

    use HasRichText;
    use HasFactory;

    protected $guarded = [];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */


}
