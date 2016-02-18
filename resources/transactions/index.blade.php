@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{!! url('public/assets/css/bootstrap.min.css') !!}" media="all">

@endsection
@section('content')
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                {{ Session::get('success_message') }}
            </div>
         @endif
          @if(Session::has('error_message'))
            <div class="alert alert-danger">
                {{ Session::get('error_message') }}
            </div>
         @endif
@if($data->isEmpty())
    <div >
      <p> No Transactions found!</p>
      <a href="{{ url('gl_transactions') }}">Back</a>
    </div>
@else
 <h5>General Ledger Transactions</h5>  
 <div style="">
     <div class="uk-width-medium-1-2 uk-text-center" style="margin-left: 670px"  >                            
                            
                            <i title="click to print"  class="material-icons md-36 uk-text-success" onclick="window.open('{!! action('TransactionsController@print_transactions',old()) !!}','','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500');"  >print</i>
                       
                             
                            <a  onClick ="$('#gad').tableExport({type:'excel',escape:'false'});" title="Click to export to excel"class="btn-success btn-sm uk-margin-small-top">Export<i title="click to export" class=" fa fa-file-excel-o" ></i></a>
                            
                            <a  href="{{ url('journal_entry') }}" title="Click to add gl transactions"class="btn-danger btn-sm">Transactions<i title="click to add more gl accounts" class=" fa fa-plus-circle" ></i></a>
                         
 </div>
 </div>
<div class="md-card">
                <div class="md-card-content">

                <form action="{!!    url('gl_transactions')  !!}"  method="get" accept-charset="utf-8" novalidate id="group">
                   {!!  csrf_field()  !!}
                    <div class="uk-grid" data-uk-grid-margin="">

                         
                       <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('account', 
                                (['' => 'Select Group Category'] + $account), 
                                  old("account"),
                                    ['class' => 'md-input parent','id'=>"parent", 'data-md-selectize'=>''] )  !!}
                             </div>
                        </div>
                          

                          <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('type', 
                                (['' => 'Select Transaction type'] + $type), 
                                  old("type"),
                                    ['class' => 'md-input parent','id'=>"parent", 'data-md-selectize'=>''] )  !!}
                             </div>
                        </div>
                         
                        <div class="uk-width-medium-1-5">
                            <div class="uk-margin-small-top">
                                    {!! Form::select('actor', 
                                (['' => 'Select Actors'] + $actor), 
                                  old("actor"),
                                    ['class' => 'md-input parent','id'=>"parent", 'data-md-selectize'=>''] )  !!}
                             </div>
                        </div>
                        
                        
                         <div class="uk-width-medium-1-10">                                                        
                             <input type="text"  style="width: 130px" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ old("from_date") }}" name="from_date" id="invoice_dp" class="md-input" placeholder="date from ">
                        </div>

                        <div class="uk-width-medium-1-10">                            
                            <input type="text" style="margin-left: 37px;width: 130px" data-uk-datepicker="{format:'DD/MM/YYYY'}" value="{{ old("to_date") }}" name="to_date"  class="md-input" placeholder="date to">
                        </div
                        <div class="uk-width-medium-1-10 uk-text-center" >                            
                            <input class="md-btn md-btn-primary" style="margin-left: 109px;margin-top: 10px" type="submit" name="search_button"  value="Search" />
                        </div>
             
                         
                      </form>          

                        
                   
                      
                    </div>
                    
                    
                </div>
            </div>
 
	<div class="uk-overflow-container">
            
                        <table class="uk-table uk-table-nowrap uk-table-hover" id="gad"> 
                                  <thead>
                                        <tr>
                                            <!--<th class="col-xs-1 col-sm-1"><input type="checkbox" id="select-all"></th>-->
                                           <th class=" ">No</th>
                                            <th class=" ">Date</th>
                                            
                                            <th class=" ">Account</th>
                                            <th class=" ">Transaction Type</th>
                                            
                                            <th class=" ">Debit(GH&cent;)</th>
                                            <th class=" ">Credit(GH&cent;)</th>
                                            
                                            <th class=" ">Period</th>
                                            <th class=" ">Actor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="selects">
                                         
                                        <?php 
                                         $year=(date("Y")) ."/". (date("Y") + 1);
                                         $period=date("d/m/Y");
                                        ?>
                                        @foreach($data as $datas=> $item) 
                                         
                                        
                                        
                                         
                                        <tr align="">
                                            <td>   {!! $datas+1 !!} </td>
                                            <td> {{ $item->TRANS_DATE }}</td>
                                            
                                            <td> {{ @$item->account->ACCOUNT_NAME }}</td>
                                            <td> {{ @$item->transactionType->typename }}</td>
                                            <td> {{ $item->DEBIT }}</td>
                                            <td> {{ $item->CREDIT }}</td>
                                            
                                            <td> {{ $item->PERIOD }}</td>
                                            <td> {{ $item->actor->USERNAME }}</td>

                                                           
                                              
                                        </tr>
                                         @endforeach
                                    </tbody>
                             </table>
            
                             {!! $data->appends(old())->render() !!}
        </div>
 @endif
@endsection
@section('scripts')


<script type="text/javascript">
      
$(document).ready(function(){
// console.log($('select[name="status"]'));
$(".parent").on('change',function(e){
 
   $("#group").submit();
 
});
});

</script>
@endsection
