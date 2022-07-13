<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property int $user_id
 * @property string $source
 * @property int $celestial_object_id
 */
class Article extends Model
{
    public $timestamps = false;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'article';

    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'description', 'image', 'user_id', 'source', 'celestial_object_id'];

}