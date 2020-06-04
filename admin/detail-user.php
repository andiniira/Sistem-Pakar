<?php
session_start();
if (empty($_SESSION['username'])){
  header('location:../index.php');
} else {
    include "../conn.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php"; ?>

<body id="mimin" class="dashboard">
     
     <?php include "header.php"; ?>

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
            <?php include "menu.php"; ?>
          <!-- end: Left Menu -->
<?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../index.php"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>

            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">User</h3>
                        <p class="animated fadeInDown">
                          User <span class="fa-angle-right fa"></span> Detail Data User
                        </p>
                    </div>
                  </div>
              </div>

              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Detail Data User</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <?php
            $query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$_GET[id]'");
            $data  = mysqli_fetch_array($query);
            ?>
                      <table id="example" class="table table-hover table-bordered">
                      <tr>
                      <td>User ID</td>
                      <td><?php echo $data['user_id']; ?></td>
                      <td rowspan="9"><div class="pull-right image">
                            <img src="asset/img/avatar.jpg" class="img-rounded" height="300" width="250" alt="User Image" style="border: 2px solid #666;" />
                        </div></td>
                      </tr>
                      <tr>
                      <td width="250">Username</td>
                      <td width="565" colspan="1"><?php echo $data['username']; ?></td>
                      </tr>
                      <tr>
                      <td>Password</td>
                      <td ><input class="form-password" value="<?php echo $data['password']; ?>" type="password" readonly="readonly"> <input type="checkbox" class="form-checkbox"> Show password</td>
                      </tr>
                      <tr>
                      <td>Fullname</td>
                      <td>Elok Erika Siska</td>
                      </tr>
                      <tr>
                      <td>Level</td>
                      <td><?php echo $data['level']; ?></td>
                      </tr>
                      </table>
                      </div>
                      <div class="text-right">
                  <a href="admin.php" class="btn btn-sm btn-primary">Kembali <i class="fa fa-arrow-circle-right"></i></a>
              
                </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
            
          <!-- end: content -->
          
          <!-- start: right menu -->
           <?php include "rightmenu.php"; ?>
          <!-- end: right menu -->
          
      </div>
     
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
       <!-- end: Mobile -->

<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>



<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.datatables.min.js"></script>
<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('.form-password').attr('type','text');
			}else{
				$('.form-password').attr('type','password');
			}
		});
	});
</script>
<!-- end: Javascript -->
</body>
</html>