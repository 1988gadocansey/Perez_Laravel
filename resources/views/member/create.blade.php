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
 
 
 <h5>Add Members</h5>  
  
 <div class="md-card uk-margin-large-bottom">
                <div class="md-card-content">
                   <form  novalidate id="wizard_advanced_form" class="uk-form-stacked"   action="{!!  url('ordertranscript')  !!}" method="post" accept-charset="utf-8"  name="biodata"  v-form>

                {!!  csrf_field() !!}
                <div data-uk-observe="" id="wizard_advanced" role="application" class="wizard clearfix">
                    <div class="steps clearfix">
                        <ul role="tablist">
                            <li role="tab" class="fill_form_header first current" aria-disabled="false" aria-selected="true" v-bind:class="{ 'error' : !in_payment_section}">
                                <a aria-controls="wizard_advanced-p-0" href="#wizard_advanced-h-0" id="wizard_advanced-t-0">
                                    <span class="current-info audible">current step: </span><span class="number">1</span> <span class="title">Biodata</span>
                                </a>
                            </li>
                            <li role="tab" class="payment_header disabled" aria-disabled="true"   v-bind:class="{ 'error' : in_payment_section}" >
                                <a aria-controls="wizard_advanced-p-1" href="#wizard_advanced-h-1" id="wizard_advanced-t-1">
                                    <span class="number">2</span> <span class="title">Payment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class=" clearfix " style="box-sizing: border-box;display: block;padding:15px!important;position: relative;">

                        <!-- first section -->
                        {{-- <h3 id="wizard_advanced-h-0" tabindex="-1" class="title current">Fill Form</h3> --}}
                        <section id="fill_form_section" role="tabpanel" aria-labelledby="fill form section" class="body step-0 current" data-step="0" aria-hidden="false"   v-bind:class="{'uk-hidden': in_payment_section} ">

                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                         
                                        <label for="">Title <span style="color:red">*</span></label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('title',array("Mr"=>"Mr",'Mrs'=>"Mrs",'Miss'=>'Miss','Dr'=>'Dr','Prof'=>'Prof','Bishop'=>'Bishop','Rev'=>'Rev','Fr'=>'Fr','Rev. Prof'=>'Rev. Prof'),old('title',''),array('placeholder'=>'Select Title',"required"=>"required","class"=>"md-input","v-model"=>"title","v-form-ctrl"=>"","v-select"=>"title"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        <p class="uk-text-danger uk-text-small"  v-if="biodata.title.$error.required">Member title is required</p>                                        
                                    </div>
                                </div>
                               

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            {{-- <a href="#"><i class="uk-icon-phone"></i></a> --}}
                                        </span>
                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_email">First Name <span style="color:red">*</span></label><input type="text" id="fname" name="fname" class="md-input"  required="required"  v-model="fname"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="biodata.fname.$invalid">First Name is required</p>                                      
                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">

                                        <div class="md-input-wrapper md-input-filled"><label for="wizard_skype">Other Name (s) <span style="color:red">*</span></label><input type="text"  name="oname"  class="md-input"   value="{{ old('oname','') }}"        /><span class="md-input-bar"></span></div>         
                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                         
                                        <div class="md-input-wrapper md-input-filled"><label for="lname">Last Name <span style="color:red">*</span></label><input type="text" name="lname" class="md-input"  required="required" value="{{  old('lname','') }}"  v-model="lname"  v-form-ctrl   ><span class="md-input-bar"></span></div>
                                        <p class="uk-text-danger uk-text-small " v-if="biodata.lname.$error.required" >Last Name is required</p>                                           
                                    </div>
                                </div>

                            </div>

                            <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                                <div class="parsley-row" style="margin-left: -43px">
                                <div class="uk-input-group">
                                    <span class="uk-input-group-addon">
                                        {{-- <a href="#"><i class="uk-icon-email"></i></a> --}}
                                    </span>
                                    <div class="md-input-wrapper md-input-filled"><label for="wizard_email">Email :</label><input type="email" id="email" name="email" class="md-input"  value="{{ old('email','') }}"  v-model="email"v-form-ctrl  ><span class="md-input-bar"></span></div>                                            
                                    <div class="item checkbox ui-checkbox ui-checkbox-primary">
                                        <label>
                                            <input type="checkbox" id="member_email_general" name="member_email_unsubscribes" checked='checked' value="yes"  ><span> Receive general emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from general emails sent from Bible Believing Church ,,. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span>
                                        </label>
                                    </div>
                                    <div class="item checkbox ui-checkbox ui-checkbox-info">
                                        <label><input type="checkbox" id="member_email_scheduling" name="member_email_unsubscribes_schedule" checked='checked' value="yes"  checked><span> Receive scheduling emails <i class="fa fa-question-circle fa-fw" title="Uncheck this box to unsubscribe this person from service scheduling emails sent from Bible Believing Church ,,. This box could be unchecked because the person unsubscribed." data-toggle="tooltip"></i></span>
                                        </label>
                                    </div>
                                    <p class="uk-text-danger uk-text-small "  v-if="biodata.email.$invalid"  >Please enter a valid email address</p>
                                </div>
                            </div>

                            <div class="parsley-row">
                                <div class="uk-input-group">
                                     
                                       
                                    <div class="md-input-wrapper md-input-filled" >
                                        <label for="">Date of Birth <span style="color:red">*</span> </label> 
                                          <input type="text"   data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ old("dob") }}" name="dob" v-model="dob" v-form-ctrl  class="md-input">
                                    </div>                                            
                                  <p class="uk-text-danger uk-text-small"  v-if="biodata.dob.$invalid" >Date of birth is required</p>
                              </div>
                          </div>
                            <div class="parsley-row">
                                <div class="uk-input-group">
                                     
                                       
                                    <div class="md-input-wrapper md-input-filled" >
                                         <label for="">Date Baptised </label> 
                                          <input type="text"   data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ old("dateBaptised") }}" name="dateBaptised"   class="md-input">
                                    </div>                                            
                                   </div>
                          </div>

                      <div class="parsley-row">
                                <div class="uk-input-group">
                                     
                                       
                                    <div class="md-input-wrapper md-input-filled" >
                                         <label for="">Date Joined </label> 
                                          <input type="text"   data-uk-datepicker="{format:'DD-MM-YYYY'}" value="{{ old("dateJoined") }}" name="dateJoined"   class="md-input">
                                    </div>                                            
                                   </div>
                          </div>

                </div>

                <div data-uk-grid-margin="" class="uk-grid uk-grid-width-medium-1-4 uk-grid-width-large-1-4">

                    <div class="parsley-row" style="margin-left: -49px">
                        <div class="uk-input-group">
                            <span class="uk-input-group-addon">
                                <!-- <a href="#"><i class="uk-icon-phone"></i></a> -->
                            </span>
                            <label for="">Ethnic group</label>     
                            <div class="md-input-wrapper md-input-filled">
                                {!!   Form::select('ethnic',$ethnic,old("ethnic",''),array("required"=>"required","class"=>"md-input","v-model"=>"ethnic","v-form-ctrl"=>"","v-select"=>"ethnic","v-el:ethnic"=>""))  !!}
                                <span class="md-input-bar"></span>
                            </div>                                            
                            <p class="uk-text-danger uk-text-small"  v-if="biodata.ethnic.$invalid" >Ethnic is required</p>
                        </div>
                    </div>
                    
                                 <div class="parsley-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            {{-- <a href="#"><i class="uk-icon-phone"></i></a> --}}
                                        </span>
                                        <div class="md-input-wrapper md-input-filled"><label for="phone">Phone N<u>o</u> :</label><input type="text" id="tel" name="phone" class="md-input" data-parsley-type="digits" minlength="10"  required="required"   maxlength="10" value="{{ old('phone','') }}"  pattern='^[0-9]{10}$'  v-model="phone"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="biodata.phone.$invalid">Please enter a valid phone number of 10 digits</p>                                      
                                    </div>
                                </div>

                               <div class="parsley-row">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon">
                                            {{-- <a href="#"><i class="uk-icon-phone"></i></a> --}}
                                        </span>
                                        <div class="md-input-wrapper md-input-filled"><label for="phone">2nd Phone N<u>o</u> :</label><input type="text" id="phone2" name="phone2" class="md-input" data-parsley-type="digits" minlength="10"   maxlength="10" value="{{ old('phone2','') }}"  pattern='^[0-9]{10}$'  v-model="phone2"  v-form-ctrl><span class="md-input-bar"></span></div>                
                                        <p  class=" uk-text-danger uk-text-small  "   v-if="biodata.phone2.$invalid">Please enter a valid phone number of 10 digits</p>                                      
                                    </div>
                                </div>

                                <div class="parsley-row">
                                    <div class="uk-input-group">
                                         
                                        <label for="">Deceased <span style="color:red">*</span></label>     
                                        <div class="md-input-wrapper md-input-filled">
                                            {!!   Form::select('deceased',array("Alive"=>"Alive",'Dead'=>"Dead"),old('status',''),array('placeholder'=>'Select Title',"required"=>"required","class"=>"md-input","v-model"=>"title","v-form-ctrl"=>"","v-select"=>"title"))  !!}
                                            <span class="md-input-bar"></span>
                                        </div>    
                                        <p class="uk-text-danger uk-text-small"  v-if="biodata.title.$error.required">Member title is required</p>                                        
                                    </div>
                                </div>

                
            

          </div>


      </section>

      <!-- second section -->
      {{-- <h3 id="payment-heading-1" tabindex="-1" class="title">Payment</h3> --}}
      <section id="payment_section" role="tabpanel" aria-labelledby="payment section" class="body step-1 "  v-bind:class="{'uk-hidden': !in_payment_section} "  data-step="1"  aria-hidden="true">
        <h2 class="heading_a">
            {{-- Payment --}}
            <img class="uk-thumbnail uk-thumbnail-small" src='{!!  url("public/images/airtelmoney.jpg") !!}' alt="">
            <span class="sub-heading"></span>
        </h2>
        <hr class="md-hr">
        <div data-uk-grid-margin="" class="uk-grid uk-grid-width-large-1-2 uk-grid-width-xlarge-1-4">

           <div class="parsley-row">
            <div class="uk-input-group">
                <span class="uk-input-group-addon">
                    {{-- <a href="#"><i class="uk-icon-email"></i></a> --}}
                </span>
                <div class="md-input-wrapper md-input-filled md-input-focus"><label for="account">Airtel Mobile Money Number :</label><input minlength="10"  type="text" id="account" name="account" data-parsley-type="digits" pattern="^[0-9]{10}$"  class="md-input"  value="{{ old('account','') }}" v-model="account"   v-form-ctrl     v-bind:required=" in_payment_section "><span class="md-input-bar"></span></div>                                            
                <p  class=" uk-text-danger uk-text-small " v-if="biodata.account.$invalid" >Please enter a valid registered airtel mobile money number</p> 
            </div>

        </div>

    </div>


</section>

</div>
<div class="actions clearfix "  >
    <ul aria-label="Pagination" role="menu">
        <li class="button_previous " aria-disabled="true"  v-on:click="go_to_fill_form_section()"  v-show="in_payment_section==true"  >
            <a role="menuitem" href="#previous" >
                <i class="material-icons"></i> Previous
            </a>
        </li>
        <li class="button_next button"   v-on:click="go_to_payment_section()"  aria-hidden="false" aria-disabled="false"  v-show="biodata.$valid && in_payment_section==false"  > 
            <a role="menuitem" href="#next"  >Next 
                <i class="material-icons">
                </i>
            </a>
        </li>
        <li class="button_finish "    aria-hidden="true"  v-show="biodata.$valid && in_payment_section==true"  >
            <input class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order"  value="Submit"   v-on:click="submit_form"  />
        </li>
    </ul>
</div>
</div>
</form>

</div>
</div>

</div>
<!-- </div> -->
<!-- </div> -->

</div>
</div>
<div class="uk-modal" id="confirm_modal"   >
    <div class="uk-modal-dialog"  v-el:confirm_modal>
        <div class="uk-modal-header uk-text-large uk-text-success uk-text-center" >Confirm Order Details?</div>
          <table class="uk-table uk-table-condensed   uk-table-striped"   >
                            <tr>
                            <td  class="uk-width-2-10 uk-text-left">Contact Address</td>
                                <td class="uk-text-left uk-text-bold">@{{  contactAddress }}</td>
                                <td  class="uk-width-2-10 uk-text-left">Phone <u>No</u></td>
                                <td class="uk-text-left uk-text-bold">@{{  tel }}</td>
                            </tr>
                             <tr >
                                <td  class="uk-width-2-10 uk-text-left">Index N<u>o</u></td>                                
                                <td class="uk-text-left uk-text-bold">@{{ indexno}} </td>
                                <td  class="uk-width-2-10 uk-text-left">Name</td>
                                <td class="uk-text-left uk-text-bold">@{{  name}}</td>
                                </tr>
                                <tr>                                
                                <td  class="uk-width-1-10 uk-text-left">Email</td>
                                <td class="uk-text-left uk-text-bold">@{{  email}}</td>
                                <td  class="uk-width-1-10 uk-text-left">College</td>
                                <td class="uk-text-left uk-text-bold">@{{  college }}</td>
                                </tr>

                              <tr>                                
                                <td  class="uk-width-1-10 uk-text-left">Program</td>
                                <td class="uk-text-left uk-text-bold">@{{  program}}</td>
                                <td  class="uk-width-2-10 uk-text-left">Year of Admission</td>
                                <td class="uk-text-left uk-text-bold">@{{ yoa}}</td>                                  
                                </tr>                                
                                <tr>                              
                                <td  class="uk-width-2-10 uk-text-left">Year of Completion</td>
                                <td class="uk-text-left uk-text-bold">@{{ yoc}}</td>                                  
                                <td  class="uk-width-2-10 uk-text-left">Delivery Method</td>
                                  <td class="uk-text-left uk-text-bold">@{{  delivery }}</td>                                 
                                </tr>                                
                                <tr v-if="delivery=='POST TO DESTINATION' ">                               
                                <td class="uk-width-2-10 uk-text-left   ">Country of Delivery</td>
                                  <td class="uk-text-left uk-text-bold">@{{  country }}</td>                                 
                                  <td class="uk-width-2-10 uk-text-left   ">Mailing Address</td>
                                  <td class="uk-text-left uk-text-bold">@{{  address }}</td>                                 
                                </tr>
                               
          </table>
        {{-- <div class="uk-modal-footer ">
        <center>
          <button class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order" > Cancel</button>
          <button class="md-btn md-btn-primary uk-margin-small-top" type="submit" name="submit_order" > Ok</button>
          </center>
        </div> --}}
    </div>
</div>

@section('scripts')
 

<script>


//code for ensuring vuejs can work with select2 select boxes
Vue.directive('select', {
  twoWay: true,
  priority: 1000,
  params: [ 'options'],
  bind: function () {
    var self = this
    $(this.el)
      .select2({
        data: this.params.options,
         width: "resolve"
      })
      .on('change', function () {
        self.vm.$set(this.name,this.value)
        Vue.set(self.vm.$data,this.name,this.value)
      })
  },
  update: function (newValue,oldValue) {
    $(this.el).val(newValue).trigger('change')
  },
  unbind: function () {
    $(this.el).off().select2('destroy')
  }
})


var vm = new Vue({
  el: "body",
  ready : function() {
  },
 data : {
  college : "{{  old("college",'') }}",
  program : "{{  old("program",'') }}",
  yoa : "{{  old("yoa",'') }}",
  yoc : "{{  old("yoc",'') }}",
  delivery : "{{  old("delivery",'') }}",
  country : "{{  old("country",'') }}",
 options: [      
    ],
    in_payment_section : false,
  },
  methods : {
    go_to_payment_section : function (event){
    UIkit.modal.confirm(vm.$els.confirm_modal.innerHTML, function(){
      vm.$data.in_payment_section=true
})

    },
    submit_form : function(){
      return (function(modal){ modal = UIkit.modal.blockUI("<div class='uk-text-center'>Processing Transcript Order<br/><img class='uk-thumbnail uk-margin-top' src='{!! url('public/assets/img/spinners/spinner.gif')  !!}' /></div>"); setTimeout(function(){ modal.hide() }, 50000) })();
    }
        ,    
    go_to_fill_form_section : function (event){    
      vm.$data.in_payment_section=false
    }
  }
})

</script>
  
<script src="{!! url('public/js/jquery.min.js') !!}"></script>
 <script>
      
    $(input).kendoDatePicker({
  format: "d-MM-yyyy"
});
    </script>
@endsection
@endsection
