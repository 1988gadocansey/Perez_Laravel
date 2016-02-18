<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
   
  <title>Login Page | Perez Temple</title>

  <!-- Favicons-->
  <link rel="icon" href="public/favicon.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="public/favicon.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="public/favicon.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
   
  <link rel="stylesheet" href="{!! url('public/login/css/materialize.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="{!! url('public/login/css/style.css') !!}"/>
  <link rel="stylesheet" href="{!! url('public/login/css/page-center.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="{!! url('public/login/css/perfect-scrollbar.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="{!! url('public/login/css/prism.css') !!}" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
        <!-- if there are login errors, show them here -->
		 @if (count($errors) > 0)

                <div class="uk-form-row">
                    <div class="alert alert-danger" style="background-color: red;color: white">
                       
                          <ul>
                            @foreach ($errors->all() as $error)
                              <li> {{  $error  }} </li>
                            @endforeach
                      </ul>
                </div>
              </div>
            @endif
        <form class="login-form"  method="POST" action="login">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="{!! url('public/assets/img/logo.png') !!}" alt="" class="Perez Temple">
            <p class="center login-form-text">The Ultimate Church App</p>
          </div>
        </div>
            
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            
             <input type="email" name="email" required="" value="{{ old('email') }}">
                   
            <label for="username" class="center-align">Email</label>
          </div>
        </div>
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            
            <input  type="password" id="login_password" name="password" required="" value="{{ old('password') }}"/>
                    
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
               
              <input type="checkbox" name="remember" id="remember-me"   />
                            
              <label for="remember-me">Remember me</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
              <table>
                  <tr>
                      <Td><button type="submit" class="btn waves-effect waves-light col s12">Login</button></Td>
                      <td><button type="submit" class="btn waves-effect waves-light col s12">  facebook</button></td>
                  </tr>
              </table>
          </div>
        </div>
        <div class="row">
            <center><small style="font-size: 11px">&copy <?php echo date ("Y"); ?> | BethPeniel Solutions Ltd</small></center>         
        </div>

      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
   
  <script src="{!! url('public/login/js/jquery-1.11.2.min.js') !!}"></script>

  <!--materialize js-->
   
   <script src="{!! url('public/login/js/materialize.js') !!}"></script>

  <script src="{!! url('public/login/js/prism.js') !!}"></script>

  <!--scrollbar-->
    <script src="{!! url('public/login/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') !!}"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
   
 <script src="{!! url('public/login/js/plugins.js') !!}"></script>

</body>

</html>