<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $article_id 
 * @property int $equipment_id 
 */
class ArticleEquipment extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'articleequipment';

    /**
     * @var array
     */
    protected $fillable = ['article_id', 'equipment_id'];

}