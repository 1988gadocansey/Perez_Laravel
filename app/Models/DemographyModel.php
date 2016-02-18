<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemographyModel extends Model
{
    //
    protected $table = 'perez_demographics';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function demography() {
        return $this->hasMany('App\Models\MembersModel', 'DEMOGRAPHICS','ID');
    }
}
