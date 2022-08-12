<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id 
 * @property int $article_id
 */
class ArticleReport extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'articlereport';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'article_id'];

}