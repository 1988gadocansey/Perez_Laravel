@extends('layouts.master')
@section('css')
  @endsection
@section('content')
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
         @endif
          @if(Session::has('error_message'))
            <div class="alert alert-danger">
                {{ Session::get('flash_message') }}
            </div>
         @endif
@if($members->isEmpty())
    <div >
      <p> No Members found!</p>
      <a href="{{ url('addMember') }}">Add members</a>
    </div>
@else
  <div class="uk-modal" id="sms">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Type sms here</h3>
        </div>
         <form action="" method="post" class="form-horizontal row-border"   id="form" data-validate="parsley" >
             <div class="uk-grid" data-uk-grid-margin>
                  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="uk-width-medium-1-1">
                             
                            <div class="uk-form-row">
                              <textarea name="message" required="" row="9"  id="message"  class="md-input md-input-width-large"></textarea>
						    
                            </div>
                            
                        </div>
                        
                    </div>
                     
              

       
        
                <div class="uk-modal-footer uk-text-right">
                    <button type="submit" id="submit" class="md-btn md-btn-flat md-btn-flat-primary sms"><i class="fa fa-phone"></i>Send</button><button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                </div>
         </form>
    </div>
                
        
</div>
<div class="uk-modal" id="mail">
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Type sms here</h3>
        </div>
         <form action="" method="post" class="form-horizontal row-border"   id="form" data-validate="parsley" >
             <div class="uk-grid" data-uk-grid-margin>
                  <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="uk-width-medium-1-1">
                             
                            <div class="uk-form-row">
                              <textarea name="mail" required="" row="9"  id="mail"  class="md-input md-input-width-large"></textarea>
						    
                            </div>
                            
                        </div>
                        
                    </div>
                     
              

       
        
                <div class="uk-modal-footer uk-text-right">
                    <button type="submit" id="submit" class="md-btn md-btn-flat md-btn-flat-primary mail"><i class="fa fa-send"></i>Send Email</button><button type="button" class="md-btn md-btn-flat uk-modal-close">Close</button>
                </div>
         </form>
    </div>
                
        
</div>
 <h5>Members</h5>  
 <div style="">
     <div class="uk-width-medium-1-2 uk-text-center" style="margin-left: 541px"  >                            
         <div style="margin-top:-1.6%;margin-left: -26px">
         
             <button  style="margin-top: -59px" name="mail" data-uk-modal="{target:'#mail'}"  class="md-btn md-btn-flat-warning md-36">Mail<i class="md md-email"></i></button>
             <button  style="margin-top: -59px"  data-target="#mount" data-toggle="modal"  class="md-btn md-btn-flat-warning md-36">Import csv<i class="md md-cloud-upload"></i></button>
             <button  style="margin-top: -59px"   class="md-btn md-btn-flat-warning md-36"  data-uk-modal="{target:'#sms'}">Send SMS<i class="md md-sms"></i></button>
             <button   class="md-btn md-btn-flat-warning md-36" style="margin-top: -59px" onClick ="$('#ts_pager_filter').tableExport({type:'excel',escape:'false'});" title="Export data to excel file"><i class="fa fa-file-excel-o"></i> Export Data</button>
             <div style="margin-top: -59px;margin-left: -568px">
             <i    title="click to print"  class="material-icons md-36 uk-text-warning" onclick="window.open('{!! action('MembersController@memberPrint',old()) !!}','','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500');"  >print</i>

             </div>
         </div><p></p>
          
          
     </div>
 </div>
                <div class="md-card">
                <div class="md-card-content">

                <form action="{!!    url('dashboard')  !!}"  method="get" accept-charset="utf-8" novalidate id="group">
                   {!!  csrf_field()  !!}
                    <div class="uk-grid" data-uk-grid-margin="">

                         
                       <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('category', 
                                (['' => 'Select Member Category'] + $categories), 
                                  old("category"),
                                    ['class' => 'md-input parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                         <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('category', 
                                (['' => 'Filter by Ministry'] + $ministry), 
                                  old("ministry"),
                                    ['class' => 'md-input parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                         
                         <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('branch', 
                                (['' => 'FIlter by branch'] + $branch), 
                                  old("branch"),
                                    ['class' => 'md-input parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                          
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!!   Form::select('gender',array(""=>"All gender","Male"=>"Males","Female"=>"Females"),old("gender",""),array('class'=>"md-input1 parent"))  !!}
                       
                            </div>
                        </div>
                        
                        <div class="uk-width-medium-1-5"  >
                            <div class="uk-margin-small-top">
                                    {!! Form::select('ethnic', 
                                (['' => 'Filter by Ethnic group'] + $ethnic), 
                                  old("ethnic"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('demography', 
                                (['' => 'Filter by demography'] + $demography), 
                                  old("demography"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('group', 
                                (['' => 'Filter by groups'] + $group), 
                                  old("group"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('service', 
                                (['' => 'Filter by Service Types'] + $service), 
                                  old("service"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('country', 
                                (['' => 'Filter by Nationality'] + $country), 
                                  old("country"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                             </div>
                        </div>
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('language', 
                                (['' => 'Filter by Languages'] + $language), 
                                  old("language"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                        </div>
                        </div>
                       <div class="uk-width-medium-1-5" style="margin-top: 48px">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('occupation', 
                                (['' => 'Filter by Occupation'] + $occupation), 
                                  old("occupation"),
                                    ['class' => 'md-input1 parent','id'=>"parent"] )  !!}
                        </div>
                       </div>
                        <div class="uk-width-medium-1-5 ">
                             <input type="text" placeholder="Type Search" class="md-input" placeholder="Search " name="search" value="{{  old("search")  }}">
                        </div>


                            <div class="uk-width-medium-1-5 " style="margin-top: 48px">
                                    {!!   Form::select('by',array(""=>"Search by","MEMBER_CODE"=>"Member Code","FIRSTNAME"=>"First Name","LASTNAME"=>"Last Name"),old("by",""),array('class'=>"md-input1"))  !!}
                       
                            </div>
                        

                        <div class="" style="margin-top: 40px">
                            <input class="md-btn md-btn-primary " type="submit" name="submit"  value="Search" />
                        </div>
                         
                      </form>          

                        
                   
                      
                    </div>
                    
                    
                </div>
                </div>
              <div class="md-card-content">
                  <h4><center>{!!  $members->total() !!} Record(s)</center></h4>
                   <div class="uk-overflow-container uk-margin-bottom">
                       <table class="uk-table uk-table-align-vertical uk-table-nowrap tablesorter tablesorter-altair member" id="ts_pager_filter">
                           <thead>
                               <tr>
                                   <th></th>
                                   <th><input type="checkbox" class="ts_checkbox_all"></th>
                                   <th class="filter-false remove sorter-false">Photo</th>
                                   <th>Member Code</th>
                                   <th>Name</th>
                                   <th>Gender</th>
                                   <th>Date Joined</th>
                                   <th>Date Baptised</th>

                                   <th>Phone</th>
                                   <th>Branch</th>
                                   <th>Ministry</th>
                                   <th>Demographic</th>
                                   <th>Occupation</th>
                                   <th>Category</th>
                                   <th colspan="5" class="uk-width-2-10 uk-text-center filter-false remove sorter-false uk-text-center" style="text-align: center">Actions</th>
                               </tr>        
                           </thead>
                                    
                                    <tbody>
                                       @foreach($members as $rtmt=> $member) 
                                            
                                           
                                            @inject('obj', 'App\Http\Controllers\MembersController')
                                            
                                        <tr>
                                            <td>   {!! $rtmt+1 !!} </td>
                                            <td> <input type="checkbox" data-md-icheck class="ts_checkbox"></td>
                                            <td><a href="addMember.php?member={{ $member->MEMBER_CODE }}&&update"><img class=""  <?php   $pic=  $obj->pictureid($member->MEMBER_CODE); echo $obj->picture("public/photos/members/$pic.JPG",90)  ?>   src="<?php echo file_exists("public/photos/members/$pic.JPG") ? "public/photos/members/$pic.JPG":"public/photos/members/user.jpg";?>" alt=" Picture of Member Here"    /></a></td> 
                                            <td> {{ $member->MEMBER_CODE }}</td>
                                            <input type="hidden" name="member[]" value=" {{ $member->MEMBER_CODE }}"/>
                                            <input type="hidden" name="total" value="{!! $rtmt+1 !!}"/>
                                            <td> {{ $member->TITLE.' '.$member->FIRSTNAME.' '.$member->LASTNAME }}</td>
                                            <td> {{ $member->GENDER }}</td>
                                            <td> {{ @date('d/m/Y',$member->DATE_JOINED) }}</td>
                                            <td> {{ @date('d/m/Y',$member->DATE_BAPTISED) }}</td>
                                            <td> {{ $member->PHONE}}</td>
                                            <td> {{ $member->branch->NAME}}</td>
                                            <td> {{ @$member->ministry->NAME}}</td>
                                            <td> {{ $member->DEMOGRAPHICS}}</td>
                                            <td> {{ $member->OCCUPATION}}</td>
                                            <td> {{ @$member->category->CATEGORY}}</td>
                                            
                                            <td class="uk-text-center">
                                                <a href="components_tables_examples.html#"><i class="md-icon material-icons">&#xE254;</i></a>
                                                <a href="components_tables_examples.html#"><i class="md-icon material-icons">&#xE88F;</i></a>
                                                <a href="plugins_tablesorter.html#" class="ts_remove_row"><i class="md-icon material-icons">&#xE872;</i></a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                             </table>
                              
                              {!!  (new App\Presenters\UIKitPresenter($members->appends(old()) ))->render() !!}
     
       
                  </div></div>
 
 @endif
 
@section('scripts')
 


<script type="text/javascript">
      
$(document).ready(function(){
// console.log($('select[name="status"]'));
$(".parent").on('change',function(e){
 
   $("#group").submit();
 
});
});

</script>
 <script>
$(document).ready(function(){
  $('select').select2({ width: "resolve" });

  $("select").on("change",function(){
    $("input[name=submit]").trigger("click");
  });
});



</script>
<script>
$(document).ready(function (){
$('.sms').on('click', function(e) {
        e.preventDefault();
        //var ok=confirm("Are you sure you want to delete this user??");        
        var url = 'dashboard';
        var data = $('#message').val();
UIkit.modal.confirm("Are you sure you want to sms this user??"
               , function(){
        modal = UIkit.modal.blockUI("<div class='uk-text-center'>Sending sms<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); 
        //setTimeout(function(){ modal.hide() }, 500) })()            
        $.ajax({
        url: url,
        type:"POST",
        data:'id='+data
        }).done(function(data){
           modal.hide();
           //console.log(data);
           //location.reload();
//        return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Processing Transcript Order<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 500) })();
        });
               
    
                    
    }
                       );
   
        
   

   
 
});
     
 
});
</script>

<script>
$(document).ready(function (){
$('.mail').on('click', function(e) {
        e.preventDefault();
        //var ok=confirm("Are you sure you want to delete this user??");        
        var url = 'dashboard';
        var data = $('#mail').val();
UIkit.modal.confirm("Are you sure you want to Email this Members??"
               , function(){
        modal = UIkit.modal.blockUI("<div class='uk-text-center'>Emailing Members<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); 
        //setTimeout(function(){ modal.hide() }, 500) })()            
        $.ajax({
        url: url,
        type:"POST",
        data:'mail='+data
        }).done(function(data){
           modal.hide();
           //console.log(data);
           //location.reload();
//        return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Processing Transcript Order<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 500) })();
        });
               
    
                    
    }
                       );
   
        
   

   
 
});
     
 
});
</script>
@endsection
@endsection
