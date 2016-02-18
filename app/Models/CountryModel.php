<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'perez_country';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function countries() {
        return $this->hasMany('App\Models\MembersModel', 'COUNTRY','ID');
    }
}
