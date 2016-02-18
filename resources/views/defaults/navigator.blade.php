<!doctype html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>Perez Chapel</title>


    <!-- uikit -->
    <link rel="stylesheet" href="{!! url('public/plugins/uikit/css/uikit.almost-flat.min.css') !!} " media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="{!! url('public/assets/icons/flags/flags.min.css') !!}" media="all">

    <!-- altair admin -->
    <link rel="stylesheet" href="{!! url('public/assets/css/main.min.css') !!}" media="all">
     <link rel="stylesheet" href="{!! url('public/plugins/sweet-alert/sweet-alert.min.css') !!}" media="all">
     <!-- font awesome -->
    <link rel="stylesheet" href="{!! url('public/assets/css/fonts/font-awesome.min.css') !!}" media="all">
     <link rel="stylesheet" href="{!! url('public/assets/css/select2.min.css') !!}" media="all">
      @yield('css')
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body class=" sidebar_main_open ">
     
   <!-- main sidebar -->
<!--     <aside id="">
        
       <div class="sidebar_main_header" style="background-position: 30px">
            <div class="sidebar_logo">
                  </div>
           <p></p>
            <div class="sidebar_actions">
               
                
            </div>
        </div>
        <div class="menu_section">
            <ul>
                <li title="Dashboard">
                    <a target='main' href="dashboard">
                         <span class="menu_icon"><i class="material-icons md-24">&#xE88A;</i></span>
                        <span class="menu_title">Home</span>
                    </a>
                </li>
                 <li>
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                        <span class="menu_title">Setup</span>
                    </a>
                    <ul>
                        
                        <li class=''><a target='main' href="{{ url('setup') }}" > <i class='fa fa-plus-circle'></i> Church Setup </a></li>
                          
                        <li class=''><a target='main' href="{{ url('createDepartment') }}" > <i class='fa fa-plus-circle'></i> Departments </a></li>
                          
                        <li class=''><a target='main' href="{{ url('addDemographics') }}" > <i class='fa fa-plus-circle'></i> Demographics </a></li>
                        <li class=''><a target='main' href="{{ url('addBranches') }}" ><i class='fa fa-plus-circle'></i>  Branches </a></li>
                          
                        <li class=''><a target='main' href="{{ url('addMinistries') }}" > <i class='fa fa-plus-circle'></i> Ministries </a></li>
                         
                         
                    </ul>
                </li>
                <li>
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="fa fa-users"></i></span>
                        <span class="menu_title">Members</span>
                    </a>
                    <ul>
                        
                        <li class=''><a target='main' href="{{ url('addMembers') }}" > <i class='fa fa-plus-circle'></i> Add New Member </a></li>
                          
                        <li class=''><a target='main' href="{{ url('viewMembers') }}" > <i class='fa fa-file-text'></i> View Members </a></li>
                          
                        <li class=''><a target='main' href="{{ url('addFlows') }}" > <i class='fa fa-plus-circle'></i> Add Flows </a></li>
                        <li class=''><a target='main' href="{{ url('flows') }}" ><i class='fa fa-file-text'></i>  View FLows </a></li>
                          
                           
                    </ul>
                </li>
                <li>
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Group Manager</span>
                    </a>
                     <ul> 
                         <li class=''><a target='main' href="{{ url('addGroup') }}" > <i class='fa fa-plus-circle'></i> Add New Group </a></li>
                        
                         <li class=''><a target='main' href="{{ url('viewGroup') }}" > <i class='fa fa-file-text'></i>View Groups</a></li>
                         <li class=''><a target='main' href="{{ url('addCategory') }}" ><i class='fa fa-file-text'></i> Add New Group Categories </a></li>
                         <li class=''><a target='main' href="{{ url('viewCategory') }}" ><i class='fa fa-file-text'></i>View Group Categories </a></li>
                       
                           
                     
                     </ul>
                </li>
                <li>
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="fa fa-database"></i></span>
                        <span class="menu_title">Finance</span>
                    </a>
                    <ul>
                         <li class=''><a target='main' href="{{ url('addPledges') }}"  ><i class='fa fa-plus-circle'></i>Add Pledges</a></li>
                         <li class=''><a target='main' href="{{ url('viewPledges') }}"  ><i class='fa fa-file-text'></i>  View Pledges </a></li>
                         <li class=''><a target='main' href="{{url('charts') }}"  ><i class='fa fa-file-text'></i>  Charts of Account </a></li>
                         <li class=''><a target='main' href="{{url('addTransactions') }}"  ><i class='fa fa-plus-circle'></i>Add Transactions </a></li>
                         <li class=''><a target='main' href="{{url('transactions') }}"  ><i class='fa fa-file-text'></i>View Transactions </a></li>
                   
                    </ul>
                </li>
                
                
                <li >
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8CB;</i></span>
                        <span class="menu_title">Asset Manager</span>
                    </a>
                    <ul>
                         <li class=''><a target='main' href="{{ url('addassets') }}" > <i class='fa fa-plus-circle'></i>Add Assets </a></li>
                          <li class=''><a target='main' href="{{url('viewAssets') }}"  ><i class='fa fa-file-text'></i>View Assets </a></li>
                           <li class=''><a target='main' href="{{url('assetsMovement') }}"  ><i class='fa fa-file-text'></i>Assets Movements</a></li>
                   
                         <li class=''><a target='main' href='asset_manager' ><i class='fa fa-file-text'></i>  Asset Register </a></li>
                    </ul>
                </li>
                 <li >
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="fa fa-calendar"></i></span>
                        <span class="menu_title">Events Manager</span>
                    </a>
                    <ul>
                         <li class=''><a target='main' href="{{ url('addEvents') }}" > <i class='fa fa-plus-circle'></i>Add Events </a></li>
                          <li class=''><a target='main' href="{{url('viewEvents') }}"  ><i class='fa fa-clock-o'></i>Upcoming Events </a></li>
                           <li class=''><a target='main' href="{{url('pastEvents') }}"  ><i class='fa fa-clock-o'></i>Past Events</a></li>
                   
                         <li class=''><a target='main' href="{{url('invitePeople') }}" ><i class='fa fa-clock-o'></i>  Invite People </a></li>
                    </ul>
                </li>
                
                <li >
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE24D;</i></span>
                        <span class="menu_title">Services</span>
                    </a>
                    <ul>
                      
                         <li class=''><a target='main' href="{{url('addServices') }}"  ><i class='fa fa-file-text'></i>Add services </a></li>
                        <li class=''><a target='main' href="{{ url('dueServices') }}"  ><i class='fa fa-file-text'></i> Upcoming Services </a></li>
                        <li class=''><a target='main' href="{{ url('passServices') }}"  ><i class='fa fa-file-text'></i> Past Services </a></li>
                        <li class=''><a target='main' href="{{ url('serviceCategories') }}" ><i class='fa fa-file-text'></i>  Service Categories </a></li>
                     
                    </ul>
                </li>
                 <li>
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Reports</span>
                    </a>
                     <ul>
                       <li class=''><a target='main' href='trial_balance' ><i class='fa fa-file-text'></i>  Trial Balance </a></li>
                          <li class=''><a target='main' href='balance_sheet' ><i class='fa fa-file-text'></i>  Balance Sheet </a></li>
                          <li class=''><a target='main' href='income_expenditure' ><i class='fa fa-file-text'></i>  Income and Expenditure </a></li>
                          <li class=''><a target='main' href='cashbook' ><i class='fa fa-file-text'></i>  Cash book </a></li>
                          
                          <li class=''><a target='main' href='receipt_payment' ><i class='fa fa-file-text'></i>  Receipts and Payment </a></li>
                         

                    </ul>
                </li>
                <li >
                    <a target='main' href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                        <span class="menu_title">Settings</span>
                    </a>
                    <ul>
                       <li class=''><a target='main' href='{{ url('reset') }}' ><i class='fa fa-file-text'></i>  Reset Account </a></li>
                         
                       <li class=''><a target='main' href='{{ url('system_log') }}' ><i class='fa fa-file-text'></i>  View Log </a></li>
                    <li class=''><a target='main' href='{{ url('users') }}' ><i class='fa fa-file-text'></i>  Users </a></li>
                    
            
                        <li class=''><a target='main' href="{{ url('auth/logout') }}" ><i class='fa fa-file-text'></i>  Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside> main sidebar end -->

        <div class="uk-grid">
        <div class="uk-width-1-1" >
            <div class="md-card" style="background-color: transparent!important;">
                <div class="md-card-toolbar md-bg-light-blue-400" style="margin-top:-49px;background-color: ##1976D2!important;">
                    <a style=""  href="{{ url('/')}}"><h4 style="margin-top: 12px;color:white;font-weight:bolder">Perez Chapel International</h4></a>  
            </div>
        @show
        
            <div class="md-card-content">
                <div class=" uk-accordion"  data-uk-accordion>
                    
                    <h3 class="uk-accordion-title">
                       <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                       <span class="menu_title">Start Ups</span>
                     </h3>                    
                    <div class="uk-accordion-content">

                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('setup') }}" > <i class='fa fa-plus-circle'></i> Church Setup </a></span>
                                </p>
                           
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('createDepartment') }}" > <i class='fa fa-folder-open'></i> Create Departments </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{  url('addDemographics') }} " ><i class='fa fa-plus-circle'></i>  Demographics </a></span>
                                </p>
                               <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('membersCategories') }}" > <i class='fa fa-folder-open'></i> Member Categories </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addBranches') }}" ><i class='fa fa-plus-circle'></i>  Create Flows </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{url('addMinistries') }}" > <i class='fa fa-folder-open'></i> View Flows </a></span>
                                </p>
                                
                                
                            
                     </div>
                  
                    <h3 class="uk-accordion-title">
                          <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Member Management</span>
                        </h3>
                        <div class="uk-accordion-content">
<p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addMembers') }}" > <i class='fa fa-plus-circle'></i> Add New Member </a></span>
                                </p>
                           
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('viewMembers') }}" > <i class='fa fa-folder-open'></i> View Members </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addMemberCategory') }}" ><i class='fa fa-plus-circle'></i>  Create Members Categories </a></span>
                                </p>
                               <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('membersCategories') }}" > <i class='fa fa-folder-open'></i> View Member Categories </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('addFlows') }}" ><i class='fa fa-plus-circle'></i>  Create Flows </a></span>
                                </p>
                                <p class="">
                                    <span class="md-list-heading"><a target='main'  href="{{ url('flows') }}" > <i class='fa fa-folder-open'></i> View Flows </a></span>
                                </p>
                                

                        </div>

                     <h3 class="uk-accordion-title">
                        <span class="menu_icon"><i class="fa fa-database"></i></span>
                        <span class="menu_title">Transactions Manager</span>
                     </h3>                    
                    <div class="uk-accordion-content">

                                <p class=''><a target='main'  href="{{ url('journal_entry') }}"  ><i class='fa fa-file-text'></i>  Journal Entry </a></p>
                         <p class=''><a target='main'  href="{{ url('journal_inquiry') }}"  ><i class='fa fa-file-text'></i>  Journal Inquiry </a></p>
                         
                           
                            
                        </div>
                      
                    
                        <h3 class="uk-accordion-title" onclick="">
                            <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                            <span class="menu_title">Settings</span>
                        </h3>
                        <div class="uk-accordion-content">
                        <p class=''><a target='main'  href='{{ url('reset') }}' ><i class='fa fa-file-text'></i>  Reset Account </a></p>

                          <p class=''><a target='main'  href='{{ url('system_log') }}' ><i class='fa fa-file-text'></i>  View Log </a></p>
                       <p class=''><a target='main'  href='{{ url('users') }}' ><i class='fa fa-file-text'></i>  Users </a></p>


                        <p class=''><a target='main' onclick="window.parent.location='{!! url("logout")!!}'"  href="{{ url('logout') }}" ><i class='fa fa-file-text'></i>  Logout </a></p>
                  
                            
                        </div>
                  
                  
                </div>
            </div>

            @yield('app_content')   
        </div>
            </div>
    </div> 
     
</body>
   
<script src="{!! url('public/assets/js/common.min.js') !!}"></script>
<!-- uikit functions -->
<script src="{!! url('public/assets/js/uikit_custom.min.js') !!}"></script>
<!-- altair common functions/helpers -->
<script src="{!! url('public/assets/js/altair_admin_common.min.js') !!}"></script>
<script src="{!! url('public/js/select2.full.min.js') !!}"></script>    <!-- tablesorter -->
<script src="public/assets/tablesorter/dist/js/jquery.tablesorter.min.js"></script>
<script src="public/assets/tablesorter/dist/js/jquery.tablesorter.widgets.min.js"></script>
<script src="public/assets/tablesorter/dist/js/widgets/widget-alignChar.min.js"></script>
<script src="public/assets/tablesorter/dist/js/extras/jquery.tablesorter.pager.min.js"></script>
<script src="public/assets/js/plugins_tablesorter.min.js"></script>
<script src="{!! url('public/js/vue.min.js') !!}"></script> 
<script src="{!! url('public/js/vue-form.min.js') !!}"></script> 

     @yield('scripts')

     <script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    </script>
    
    
   <script>
        $(function() {
            // enable hires images
            altair_helpers.retina_images();
            // fastClick (touch devices)
            if(Modernizr.touch) {
                FastClick.attach(document.body);
            }
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
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400bold:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    
    <script>
      
    
    </script>
 </html>