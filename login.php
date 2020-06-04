<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="SISTEM PAKAR DIAGNOSA PENYAKIT SAYUR ORGANIK">
  <meta name="author" content="Kelompok 10">
  <meta name="keyword" content="SISTEM PAKAR, DIAGNOSA, PENYAKIT SAYUR ORGANIK">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISTEM PAKAR DIAGNOSA PENYAKIT SAYUR ORGANIK</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="admin/asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="admin/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="admin/asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="admin/asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">
    
      <div class="container" style="margin-top: 100px;">

        <form class="form-signin" action="proseslogin.php" method="POST">
          <div class="panel periodic-login">
              <span class="atomic-number"></span>
              <div class="panel-body text-center">
                  <p class="atomic-mass"><img src="login.png" height="100" width="100" style="border-radius: 50px; border: 2px solid white; margin-bottom: 10px;" /></p>
                  <p class="atomic-mass">Login Admin</p>
                  <p class="element-name" style="color: red;"><?php if (isset($_GET['error'])) {echo 
                  "<div class='alert alert-danger alert-gradient alert-dismissible fade in' role='alert'>
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>x</span></button>
                            <strong>Error!</strong> $_GET[error]
                          </div>";} else { echo "";} ?></p>

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="username" id="username" autocomplete="off" required>
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="password" id="password" required>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <input type="submit" class="btn col-md-12" value="SignIn"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <!-- <a href="forgotpass.html">Forgot Password </a>-->
                    
                </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="admin/asset/js/jquery.min.js"></script>
      <script src="admin/asset/js/jquery.ui.min.js"></script>
      <script src="admin/asset/js/bootstrap.min.js"></script>

      <script src="admin/asset/js/plugins/moment.min.js"></script>
      <script src="admin/asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="admin/asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>