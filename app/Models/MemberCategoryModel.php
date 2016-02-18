<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberCategoryModel extends Model
{
    //
    protected $table = 'perez_member_category';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function parent_category() {
        return $this->hasMany('App\Models\MembersModel', 'PEOPLE_CATEGORY','ID');
    }
}
