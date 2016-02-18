<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembersModel extends Model
{
    //
    protected $table = 'perez_members';
    protected $primaryKey="ID";
    protected $guilded=array( "ID","MEMBER_CODE");
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    public function branch()
    {
       return $this->belongsTo('App\Models\BranchModel', "BRANCH","ID");
    }
    public function ministry()
    {
        return $this->belongsTo('App\Models\MinistryModel','MINISTRY','ID');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\MemberCategoryModel','PEOPLE_CATEGORY','ID');
    }
    public function demography() {
        return $this->belongsTo('App\Models\DemographyModel', 'DEMOGRAPHICS','ID');
    }
    public function group() {
        return $this->belongsTo('App\Models\GroupModel', 'GROUPS','ID');
    }
    public function service() {
        return $this->belongsTo('App\Models\ServiceModel', 'SERVICE_TYPE','ID');
    }
    public function countries() {
        return $this->belongsTo('App\Models\MembersModel', 'COUNTRY','ID');
    }
    
}
