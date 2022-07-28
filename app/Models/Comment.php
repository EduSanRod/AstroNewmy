<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $comment_Text
 * @property int $user_id
 * @property int $article_id
 * @property int $comment_id
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
    protected $fillable = ['comment_Text', 'user_id', 'article_id', 'comment_id', 'created_at'];

}