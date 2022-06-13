<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $type 
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
    protected $fillable = ['name', 'type'];

}