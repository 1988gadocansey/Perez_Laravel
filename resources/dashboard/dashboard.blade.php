@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{!! url('public/assets/css/bootstrap.min.css') !!}" media="all">
@endsection
@section('content')
 
	<div class="uk-overflow-container">
                        <table class="uk-table uk-table-nowrap"> 
                                  <thead>
                                        <tr>
                                            <!--<th class="col-xs-1 col-sm-1"><input type="checkbox" id="select-all"></th>-->
                                            <th class=" ">No</th>
                                            <th class=" ">Account Code</th>
                                            <th class=" ">Account Name</th>
                                            <th class=" ">Account Type</th>
                                            <th class=" "style='text-align:center'>Balance (GH&cent;)</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selects">
                                       
                                        
                                    </tbody>
                             </table>
            
                             
        </div>
  
@endsection
