<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $external_link 
 * @property string $click_count 
 */
class Equipment extends Model
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
    protected $fillable = ['name', 'price', 'external_link', 'click_count'];

}