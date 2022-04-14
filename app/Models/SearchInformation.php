<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $country
 * @property float $city
 * @property string $date 
 */
class CelestialObjectImages extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'searchinformation';

    /**
     * @var array
     */
    protected $fillable = ['country', 'city', 'date'];

}