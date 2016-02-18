<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
Use App\Models\BranchModel;
Use App\Models\MemberCategoryModel;
Use App\Models\MinistryModel;
Use App\Models\MembersModel;
Use App\User;
use App\Repositories\MemberRepository;

class MembersController extends Controller
{
     /**
     * The task repository instance.
     *
     * @var MembersRepository
     */
    protected $members;
    public function __construct(MemberRepository $members)
    {
        
       $this->middleware('auth');
       $this->members = $members;
        
    }
    public function index(Request $request)
    {
          $obj = MembersModel::query();
            
            
            if($request->has('category')){
               $obj->where("PEOPLE_CATEGORY","=",$request->input("category",""));
             }

            if ($request->has('ministry') && trim($request->input('ministry')) != "") {
                $obj->where("MINISTRY","=",$request->input("ministry",""));
            }
            if ($request->has('branch') && trim($request->input('branch')) != "") {
                 $obj->where("BRANCH","=",$request->input("branch",""));
            }
            if ($request->has('gender') && trim($request->input('gender')) != "") {
                 $obj->where("GENDER","=",$request->input("gender",""));
            }
            if ($request->has('ethnic') && trim($request->input('ethnic')) != "") {
                 $obj->where("ETHNIC","=",$request->input("ethnic",""));
            }
            if ($request->has('group') && trim($request->input('group')) != "") {
                 $obj->where("GROUPS","=",$request->input("group",""));
            }
            if ($request->has('country') && trim($request->input('country')) != "") {
                 $obj->where("COUNTRY","=",$request->input("country",""));
            }
            if ($request->has('service') && trim($request->input('service')) != "") {
                 $obj->where("SERVICE_TYPE","LIKE","%".$request->input("service","")."%");
            }
             if ($request->has('demography') && trim($request->input('demography')) != "") {
                 $obj->where("DEMOGRAPHICS","LIKE","%".$request->input("demography","")."%");
            }
            if ($request->has('occupation') && trim($request->input('occupation')) != "") {
                 $obj->where("OCCUPATION","=",$request->input("occupation",""));
            }
            if ($request->has('language') && trim($request->input('language')) != "") {
                 $obj->where("LANGUAGES","=",$request->input("language",""));
            }
            if($request->has('search') &&     trim($request->input('search') ) !="" ){
            $obj->where($request->input('by'), "LIKE","%".$request->input("by", "")."%");
            }
                
            $from=  $request->input("from_date"); 

            $to=  $request->input("to_date"); 
            
              
                
            if($request->has('from_date')){
                 $obj->where("TRANS_DATE",">=",  $from);
            }
             if($request->has('to_date')){
              $obj->where("TRANS_DATE","<=",  $to);
              }
             
               
            $data = $obj->with("branch")
                    ->with("ministry")
                    ->with("category")
                    ->with("user")
                    ->paginate(5);
            // sending sms
            
             \Session::put('members', $data);
             
        //the line below ensures the links on the pagination buttons are set to the correct route or url  for this particular search
            $data->setPath(url("dashboard"));

            $request->flash();
             $mem=  $this->members->category();
            
            return view("dashboard.dashboard")->with("members", $data)
                    ->with("categories",$mem)
                    ->with("branch",  $this->members->branch())
                    ->with("ministry",  $this->members->ministry())
                    ->with("demography",  $this->members->demography())
                    ->with("group",  $this->members->groups())
                    ->with("service",  $this->members->services())
                    ->with("country",  $this->members->country())
                    ->with("language",  $this->members->languages())
                    ->with("occupation",  $this->members->occupations())
                    ->with("ethnic",  $this->members->ethnicGroups());
                 
    }
    

    public function age($birthdate, $pattern = 'eu')
        {
            $patterns = array(
                'eu'    => 'd/m/Y',
                'mysql' => 'Y-m-d',
                'us'    => 'm/d/Y',
                'gh'    => 'd-m-Y',
            );

            $now      = new \DateTime();
            $in       = \DateTime::createFromFormat($patterns[$pattern], $birthdate);
            $interval = $now->diff($in);
            return $interval->y;
        }
       public function picture($path,$target){
                if(file_exists($path)){
                        $mypic = getimagesize($path);

                 $width=$mypic[0];
                        $height=$mypic[1];

                if ($width > $height) {
                $percentage = ($target / $width);
                } else {
                $percentage = ($target / $height);
                }

                //gets the new value and applies the percentage, then rounds the value
                 $width = round($width * $percentage);
                $height = round($height * $percentage);

               return "width=\"$width\" height=\"$height\"";



            }else{}
        
       
        }
        
        
	public function pictureid($stuid) {

        return str_replace('/', '', $stuid);
    }

    public function memberPrint(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
                
           return view("member.create")->with("categories",$this->members->category())
                    ->with("branch",  $this->members->branch())
                    ->with("ministry",  $this->members->ministry())
                    ->with("demography",  $this->members->demography())
                    ->with("group",  $this->members->groups())
                    ->with("service",  $this->members->services())
                    ->with("country",  $this->members->country())
                    ->with("language",  $this->members->languages())
                    ->with("occupation",  $this->members->occupations())
                    ->with("ethnic",  $this->members->ethnicGroups());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    // sending sms to members
    public function smsMembers(Request $request){
        $query=\Session::get('members');
        $sms= new SMSController();
        
        foreach($query as $rtmt=> $member) {
           
            
             if ($sms->sendSMS($member->PHONE, $request->input("id", ""), "Reminder")) {

                \Session::forget('members');
            } else {
                return redirect("dashboard")->withErrors("SMS could not be sent.. please verify if you have sms data and internet access.");
            }
        }
    }

    public function sendMail(Request $request){
        $query=\Session::get('members');
         
        
        foreach($query as $rtmt=> $member) {
          
            
          $mail=  \Mail::queue('dashboard.dashboard', $query, function($message) use ($query) {
                $message->to($query->EMAIL, $query->FIRSTNAME)
                        ->subject('From Perez Chapel!');
            });
            if($mail){
                 \Session::forget('members');
            }
            else {
                return redirect("dashboard")->withErrors("SMS could not be sent.. please verify if you have sms data and internet access.");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function upload_csv(Request $request) {
        if (!$request->hasFile('csv')) {
            return redirect("/")->withErrors(array("No file selected"));
        }
        if (!$request->file('csv')->isValid()) {
            return redirect("/")->withErrors(array("No file selected"));
            ;
        }

        $new_name = str_random(6) . "__" . $request->file("csv")->getClientOriginalName();
// .".".$request->file("csv")->guessExtension();
        $request->file("csv")->move(storage_path("app/csv"), $new_name);

        Models\Uploads::create(array(
            "filetype" => $request->file("csv")->getClientMimeType(),
            "filename" => $new_name
        ));

        $csv_file = storage_path("app/csv") . "/" . $new_name;

        //   \DB::listen(function($sql,$binding,$timing){
        //    print_r("<pre>");
        //    var_dump($sql);
        //    var_dump($binding);
        // }
        //  );

        $row = 1;
        if (($handle = fopen($csv_file, "r")) !== FALSE) {
            set_time_limit(1800);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                // for ($c=0; $c < $num; $c++) {
                //     echo $data[$c] . "<br />\";
                // }
                if (strtoupper(trim($data[0])) == "NAME") {
                    continue;
                }
                $contact_name = new Models\ContactName();
                $contact_info = new Models\ContactInfo();
                $find_old = Models\ContactInfo::where(\DB::raw("upper(trim(value))"), "like", "%" . strtoupper(trim($data[4])) . "%")->get();
                if (!$find_old->isEmpty()) {
                    continue;
                }

                echo "<pre>";
                // print_r($find_old);

                \DB::transaction(function () use ($contact_name, $contact_info, $data) {

                    if (trim($data[0]) == "") {
                        $contact_name->name = "";
                    } else {
                        $contact_name->name = trim($data[0]);
                    }
                    if (trim($data[1]) == "") {
                        $contact_name->status = "";
                    } else {
                        $contact_name->status = trim($data[1]);
                    }
                    if (trim($data[2]) == "") {
                        $contact_name->section = "";
                    } else {
                        $contact_name->section = trim($data[2]);
                    }

                    $contact_name->save();

                    $contact_info->owner_id = $contact_name->id;
                    $contact_info->type = "email";
                    $contact_info->value = trim($data[4]);
                    $contact_info->save();
                });

                echo "<br>";
                echo "---->" . $row;
                print_r($data[4]);
                echo "<br>";
            }
            fclose($handle);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
