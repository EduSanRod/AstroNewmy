<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $comment_Text
 * @property int $likes
 * @property int $dislikes
 * @property int $user_id
 * @property int $article_id
 * @property string $created_at
 */
class Comment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var array
     */
    protected $fillable = ['comment_Text', 'likes', 'dislikes', 'user_id', 'article_id ', 'created_at'];

}