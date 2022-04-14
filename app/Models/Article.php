<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $author
 * @property string $source
 * @property int $celestial_object_id
 */
class Article extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'article';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'image', 'author', 'source', 'celestial_object_id'];

}