<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $image 
 * @property string $external_link 
 * @property string $click_count 
 */
class CelestialObjectImages extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'equipment';

    /**
     * @var array
     */
    protected $fillable = ['name', 'price', 'image', 'external_link', 'click_count'];

}