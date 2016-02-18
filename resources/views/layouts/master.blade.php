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
     <link rel="stylesheet" href="{!! url('public/assets/css/kendo.common-material.min.css') !!}" media="all">
      <link rel="stylesheet" href="{!! url('public/assets/css/kendo.material.min.css') !!}" media="all">
     
     @yield('css')
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <header id="header_main">
        
        <div class="header_main_content">
            <nav class="uk-navbar">
                                
                <!-- main sidebar switch -->
                <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                    <span class="sSwitchIcon"></span>
                </a>
                
                <!-- secondary sidebar switch -->
                <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                    <span class="sSwitchIcon"></span>
                </a>
                
                    <div id="menu_top_dropdown" class="uk-float-left uk-hidden-small">
                        <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
                            <a href="#" class="top_menu_toggle"><i class="material-icons md-24">&#xE8F0;</i></a>
                            <div class="uk-dropdown uk-dropdown-width-3">
                                <div class="uk-grid uk-dropdown-grid" data-uk-grid-margin>
                                    <div class="uk-width-2-3">
                                        <div class="uk-grid uk-grid-width-medium-1-3 uk-margin-top uk-margin-bottom uk-text-center" data-uk-grid-margin>
                                            <a href="page_mailbox.html">
                                                <i class="material-icons md-36">&#xE158;</i>
                                                <span class="uk-text-muted uk-display-block">Mailbox</span>
                                            </a>
                                            <a href="page_invoices.html">
                                                <i class="material-icons md-36">&#xE53E;</i>
                                                <span class="uk-text-muted uk-display-block">Invoices</span>
                                            </a>
                                            <a href="page_chat.html">
                                                <i class="material-icons md-36 md-color-red-600">&#xE0B9;</i>
                                                <span class="uk-text-muted uk-display-block">Chat</span>
                                            </a>
                                            <a href="page_scrum_board.html">
                                                <i class="material-icons md-36">&#xE85C;</i>
                                                <span class="uk-text-muted uk-display-block">Scrum Board</span>
                                            </a>
                                            <a href="page_snippets.html">
                                                <i class="material-icons md-36">&#xE86F;</i>
                                                <span class="uk-text-muted uk-display-block">Snippets</span>
                                            </a>
                                            <a href="page_user_profile.html">
                                                <i class="material-icons md-36">&#xE87C;</i>
                                                <span class="uk-text-muted uk-display-block">User profile</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="uk-width-1-3">
                                        <ul class="uk-nav uk-nav-dropdown uk-panel">
                                            <li class="uk-nav-header">Components</li>
                                            <li><a href="components_accordion.html">Accordions</a></li>
                                            <li><a href="components_buttons.html">Buttons</a></li>
                                            <li><a href="components_notifications.html">Notifications</a></li>
                                            <li><a href="components_sortable.html">Sortable</a></li>
                                            <li><a href="components_tabs.html">Tabs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="uk-navbar-flip">
                    <ul class="uk-navbar-nav user_actions">
                        <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                        <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                         
                         <li data-uk-dropdown="{mode:'click'}">
                             <a href="#" class="user_action_image"><img class="md-user-image" src="{!! url('public/assets/profile/webmaster.jpg') !!}" alt=""/></a>
                            <div class="uk-dropdown uk-dropdown-small uk-dropdown-flip">
                                <ul class="uk-nav js-uk-prevent">
                                    <li><a href="page_user_profile.html"> 
             my profile
         </a></li>
                                    <li><a href="page_settings.html">Settings</a></li>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="header_main_search_form">
            <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
            <form class="uk-form">
                <input type="text" class="header_main_search_input" />
                <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
            </form>
        </div>
    </header><!-- main header end -->
    <!-- main sidebar -->
<!--    <aside id="sidebar_main">
        
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
                    <a href="dashboard">
                         <span class="menu_icon"><i class="material-icons md-24">&#xE88A;</i></span>
                        <span class="menu_title">Home</span>
                    </a>
                </li>
                 <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                        <span class="menu_title">Setup</span>
                    </a>
                    <ul>
                        
                        <li class=''><a href="{{ url('setup') }}" > <i class='fa fa-plus-circle'></i> Church Setup </a></li>
                          
                        <li class=''><a href="{{ url('createDepartment') }}" > <i class='fa fa-plus-circle'></i> Departments </a></li>
                          
                        <li class=''><a href="{{ url('addDemographics') }}" > <i class='fa fa-plus-circle'></i> Demographics </a></li>
                        <li class=''><a href="{{ url('addBranches') }}" ><i class='fa fa-plus-circle'></i>  Branches </a></li>
                          
                        <li class=''><a href="{{ url('addMinistries') }}" > <i class='fa fa-plus-circle'></i> Ministries </a></li>
                         
                         
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="fa fa-users"></i></span>
                        <span class="menu_title">Members</span>
                    </a>
                    <ul>
                        
                        <li class=''><a href="{{ url('addMembers') }}" > <i class='fa fa-plus-circle'></i> Add New Member </a></li>
                          
                        <li class=''><a href="{{ url('viewMembers') }}" > <i class='fa fa-file-text'></i> View Members </a></li>
                          
                        <li class=''><a href="{{ url('addFlows') }}" > <i class='fa fa-plus-circle'></i> Add Flows </a></li>
                        <li class=''><a href="{{ url('flows') }}" ><i class='fa fa-file-text'></i>  View FLows </a></li>
                          
                           
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Group Manager</span>
                    </a>
                     <ul> 
                         <li class=''><a href="{{ url('addGroup') }}" > <i class='fa fa-plus-circle'></i> Add New Group </a></li>
                        
                         <li class=''><a href="{{ url('viewGroup') }}" > <i class='fa fa-file-text'></i>View Groups</a></li>
                         <li class=''><a href="{{ url('addCategory') }}" ><i class='fa fa-file-text'></i> Add New Group Categories </a></li>
                         <li class=''><a href="{{ url('viewCategory') }}" ><i class='fa fa-file-text'></i>View Group Categories </a></li>
                       
                           
                     
                     </ul>
                </li>
                <li>
                    <a href="#">
                        <span class="menu_icon"><i class="fa fa-database"></i></span>
                        <span class="menu_title">Finance</span>
                    </a>
                    <ul>
                         <li class=''><a href="{{ url('addPledges') }}"  ><i class='fa fa-plus-circle'></i>Add Pledges</a></li>
                         <li class=''><a href="{{ url('viewPledges') }}"  ><i class='fa fa-file-text'></i>  View Pledges </a></li>
                         <li class=''><a href="{{url('charts') }}"  ><i class='fa fa-file-text'></i>  Charts of Account </a></li>
                         <li class=''><a href="{{url('addTransactions') }}"  ><i class='fa fa-plus-circle'></i>Add Transactions </a></li>
                         <li class=''><a href="{{url('transactions') }}"  ><i class='fa fa-file-text'></i>View Transactions </a></li>
                   
                    </ul>
                </li>
                
                
                <li >
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8CB;</i></span>
                        <span class="menu_title">Asset Manager</span>
                    </a>
                    <ul>
                         <li class=''><a href="{{ url('addassets') }}" > <i class='fa fa-plus-circle'></i>Add Assets </a></li>
                          <li class=''><a href="{{url('viewAssets') }}"  ><i class='fa fa-file-text'></i>View Assets </a></li>
                           <li class=''><a href="{{url('assetsMovement') }}"  ><i class='fa fa-file-text'></i>Assets Movements</a></li>
                   
                         <li class=''><a href='asset_manager' ><i class='fa fa-file-text'></i>  Asset Register </a></li>
                    </ul>
                </li>
                 <li >
                    <a href="#">
                        <span class="menu_icon"><i class="fa fa-calendar"></i></span>
                        <span class="menu_title">Events Manager</span>
                    </a>
                    <ul>
                         <li class=''><a href="{{ url('addEvents') }}" > <i class='fa fa-plus-circle'></i>Add Events </a></li>
                          <li class=''><a href="{{url('viewEvents') }}"  ><i class='fa fa-clock-o'></i>Upcoming Events </a></li>
                           <li class=''><a href="{{url('pastEvents') }}"  ><i class='fa fa-clock-o'></i>Past Events</a></li>
                   
                         <li class=''><a href="{{url('invitePeople') }}" ><i class='fa fa-clock-o'></i>  Invite People </a></li>
                    </ul>
                </li>
                
                <li >
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE24D;</i></span>
                        <span class="menu_title">Services</span>
                    </a>
                    <ul>
                      
                         <li class=''><a href="{{url('addServices') }}"  ><i class='fa fa-file-text'></i>Add services </a></li>
                        <li class=''><a href="{{ url('dueServices') }}"  ><i class='fa fa-file-text'></i> Upcoming Services </a></li>
                        <li class=''><a href="{{ url('passServices') }}"  ><i class='fa fa-file-text'></i> Past Services </a></li>
                        <li class=''><a href="{{ url('serviceCategories') }}" ><i class='fa fa-file-text'></i>  Service Categories </a></li>
                     
                    </ul>
                </li>
                 <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8F1;</i></span>
                        <span class="menu_title">Reports</span>
                    </a>
                     <ul>
                       <li class=''><a href='trial_balance' ><i class='fa fa-file-text'></i>  Trial Balance </a></li>
                          <li class=''><a href='balance_sheet' ><i class='fa fa-file-text'></i>  Balance Sheet </a></li>
                          <li class=''><a href='income_expenditure' ><i class='fa fa-file-text'></i>  Income and Expenditure </a></li>
                          <li class=''><a href='cashbook' ><i class='fa fa-file-text'></i>  Cash book </a></li>
                          
                          <li class=''><a href='receipt_payment' ><i class='fa fa-file-text'></i>  Receipts and Payment </a></li>
                         

                    </ul>
                </li>
                <li >
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE87B;</i></span>
                        <span class="menu_title">Settings</span>
                    </a>
                    <ul>
                       <li class=''><a href='{{ url('reset') }}' ><i class='fa fa-file-text'></i>  Reset Account </a></li>
                         
                       <li class=''><a href='{{ url('system_log') }}' ><i class='fa fa-file-text'></i>  View Log </a></li>
                    <li class=''><a href='{{ url('users') }}' ><i class='fa fa-file-text'></i>  Users </a></li>
                    
            
                        <li class=''><a href="{{ url('auth/logout') }}" ><i class='fa fa-file-text'></i>  Logout </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside> main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">

            <div class="md-card">
                <div class="md-card-content">
                  @yield('content')
                </div>
            </div>

          
            </div>

        </div>
    </div>
    <footer><center><small>Gad Ocansey Design &copy {{ date('Y')}} | All Rights Reserved</small></center></footer>
    <!-- google web fonts -->
     
</body>
  
<script src="{!! url('public/assets/js/common.min.js') !!}"></script>
<!-- uikit functions -->
<script src="{!! url('public/assets/js/uikit_custom.min.js') !!}"></script>
 <script src="{!! url('public/plugins/parsleyjs/dist/parsley.min.js')  !!}"></script>
 

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

     <!-- jquery steps -->
    <script  src="{!! url('public/js/wizard_steps.min.js')!!}"></script>

    <!--  forms wizard functions -->
    <script  src="{!! url('public/js/forms_wizard.min.js')!!}"></script>
    
    <script  src="{!! url('public/js/kendoui_custom.min.js')!!}"></script>
    <script  src="{!! url('public/js/kendoui.min.js')!!}"></script>


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
    
   
    
 </html>