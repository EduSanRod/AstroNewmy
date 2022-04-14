<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class CelestialObject extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'celestialobject';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'image'];

}