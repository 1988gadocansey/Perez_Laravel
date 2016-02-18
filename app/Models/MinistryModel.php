<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MinistryModel extends Model
{
    //
    protected $table = 'perez_ministries';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
     
    public function parent_ministry() {
        return $this->hasMany('App\Models\MembersModel', 'MINISTRY','ID');
    }
}
