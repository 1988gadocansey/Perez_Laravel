<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $table = 'perez_service_type';
    protected $primaryKey="ID";
    protected $guilded=array( "ID");
    public function services() {
        return $this->hasMany('App\Models\MembersModel', 'SERVICE_TYPE','ID');
    }
}
