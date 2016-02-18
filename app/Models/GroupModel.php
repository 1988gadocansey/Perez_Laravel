<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{
    //
    protected $table = 'perez_group';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function group() {
        return $this->hasMany('App\Models\MembersModel', 'GROUPS','ID');
    }
}

