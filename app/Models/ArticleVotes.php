<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $article_id 
 * @property int $user_id 
 * @property string $vote 
 */
class ArticleVotes extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'articlevotes';

    /**
     * @var array
     */
    protected $fillable = ['article_id', 'user_id', 'vote'];

}