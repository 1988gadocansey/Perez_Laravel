<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    //
    protected $table = 'perez_branches';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function parent_branch() {
        return $this->hasMany('App\Models\MembersModel', 'BRANCH','ID');
    }
}
