<?php

namespace App\Repositories;

use App\User;
use App\Models\MembersModel;
use App\Models\MemberCategoryModel;
use App\Models\BranchModel;
use App\Models\MinistryModel;
use App\Models\DemographyModel;
use App\Models\GroupModel;
use App\Models\ServiceModel;
use App\Models\CountryModel;
class MemberRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return MembersModel::where('CREATED_BY', $user->id)
                    ->orderBy('CREATED_AT', 'ASC')
                    ->get();
    }
    
    public function category()
    {
        $category=MemberCategoryModel::lists('CATEGORY', 'ID');
        return $category->toArray();
        
                   
    }
    public function ethnicGroups()
    {
        $ethnic=\DB::table('perez_members')->distinct()->where('ETHNIC','!=',"")->lists('ETHNIC','ETHNIC');
        return $ethnic ;
        
                   
    }
    public function occupations()
    {
        $occupation=\DB::table('perez_members')->distinct()->where('OCCUPATION','!=',"")->lists('OCCUPATION','OCCUPATION');
        return $occupation ;
        
                   
    }
    public function languages()
    {
        $languages=\DB::table('perez_members')->distinct()->where('LANGUAGES','!=',"")->lists('LANGUAGES','LANGUAGES');
        return $languages ;
        
                   
    }
    public function ministry(){
       $ministry=  MinistryModel::lists('NAME', 'ID');
        return $ministry->toArray();
   }
    
   public function branch() {
       $branch= BranchModel::lists('NAME', 'ID');
        return $branch->toArray();
   }
   public function demography() {
       $branch= DemographyModel::lists('NAME', 'ID');
        return $branch->toArray();
   }
   public function groups() {
       $branch= GroupModel::lists('NAME', 'ID');
        return $branch->toArray();
   }
   public function services() {
       $branch= ServiceModel::lists('SERVICE', 'ID');
        return $branch->toArray();
   }
   public function country() {
       $branch= CountryModel::lists('Name', 'Code');
        return $branch->toArray();
   }
   public function age($birthdate, $pattern = 'eu') {
        $patterns = array(
            'eu' => 'd/m/Y',
            'mysql' => 'Y-m-d',
            'us' => 'm/d/Y',
            'gh' => 'd-m-Y',
        );

        $now = new \DateTime();
        $in = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
        $interval = $now->diff($in);
        return $interval->y;
    }

    public function picture($path, $target) {
        if (file_exists($path)) {
            $mypic = getimagesize($path);

            $width = $mypic[0];
            $height = $mypic[1];

            if ($width > $height) {
                $percentage = ($target / $width);
            } else {
                $percentage = ($target / $height);
            }

            //gets the new value and applies the percentage, then rounds the value
            $width = round($width * $percentage);
            $height = round($height * $percentage);

            return "width=\"$width\" height=\"$height\"";
        } else {
            
        }
    }

    public function pictureid($memberID) {

        return str_replace('/', '', $memberID);
    }
    public function password() {
        $alphabet = "ABCDEFGHJKMNPQRSTUWXYZ23456789";
        
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
     
         
     
     /**
      * @param sync $name CURL libray
      * @access public
      */
     public function sync_to_online($url,$data){
                $ch = \curl_init();
               \curl_setopt($ch, CURLOPT_URL,$url);
               \curl_setopt($ch, CURLOPT_POST,1);
               \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $result=\curl_exec($ch);
 
		\curl_close ($ch);
                return $result;
 
     }
     public function autopassword($len = 8){
    	return substr(md5(rand().rand()), 0, $len);
    }//end

}
