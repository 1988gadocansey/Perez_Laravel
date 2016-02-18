<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perez_Service_Type extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'perez_service_type';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['SERVICE'];

}
