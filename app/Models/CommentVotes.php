<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $comment_id 
 * @property int $user_id 
 * @property string $vote 
 */
class CommentVotes extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'commentvotes';

    /**
     * @var array
     */
    protected $fillable = ['comment_id', 'user_id', 'vote'];

}