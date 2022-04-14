<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $image
 * @property string $description
 * @property string $celestial_object_id 
 */
class CelestialObjectImages extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'celestialobjectimages';

    /**
     * @var array
     */
    protected $fillable = ['image', 'description', 'celestial_object_id'];

}