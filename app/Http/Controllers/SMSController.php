<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    public function sendSMS($phone,$message,$type){
        $phone = "+233" . \substr($phone, 1, 9);
        $url = 'http://txtconnect.co/api/send/';
        $fields = array(
            'token' => \urlencode('a166902c2f552bfd59de3914bd9864088cd7ac77'),
            'msg' => \urlencode($message),
            'from' => \urlencode("Tpoly"),
            'to' => \urlencode($phone),
        );
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        \rtrim($fields_string, '&');
        $ch = \curl_init();
        \curl_setopt($ch, \CURLOPT_URL, $url);
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_FOLLOWLOCATION, true);
        \curl_setopt($ch, \CURLOPT_POST, count($fields));
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $fields_string);
        \curl_setopt($ch, \CURLOPT_SSL_VERIFYPEER, 0);
        $result = \curl_exec($ch);
        \curl_close($ch);
        $data = \json_decode($result);
        if ($data->error == "0") {

            $info = "Message was successfully sent";

            return $info;
        } else {

            $info = $data->error;
            return $info;
        }
    }

    /* send sms to applicant on status change
     * example status change to printed ... fire sms
     * to applicant
     */
    
    public function fireSMS(Requests $request){
        
    }
    public function sms($phone,$sms) {
         $sms=urlencode($sms);
           $url="http://powertxtgh.com/access.php?company=ALOT&ccode=ALT101&sender=GN-Pay&message=$sms&recipient=$phone";
           $homepage = @file_get_contents($url);
         
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
