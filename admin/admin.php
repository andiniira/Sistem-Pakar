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
      <!-- start: Header -->
<?php include "header.php"; ?>
      <!-- end: Header -->

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
  		
          <!-- start: content -->
            <div id="content">

                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-12 padding-0">
                            <div class="col-md-12">
                                <div class="panel box-v4">
                                    <div class="panel-heading bg-white border-none">
                                      <h4><span class="icon-notebook icons"></span> Data Admin</h4>
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                        <!-- Modal Tambah Data -->
   <div class="modal fade bs-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel">
	  <div class="modal-dialog  modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="tambahDataLabel">Tambah Data</h4>
	      </div>
	      <div class="modal-body">
	       	<form class="form-horizontal" action="" method="POST">
            <input type="hidden" name="user_id" placeholder="Username" required="required">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="username" placeholder="Username" required="required">
			    </div>
			  </div>
              <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="password" placeholder="Password" required="required">
			    </div>
			  </div>
              <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Fullname</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="fullname" placeholder="Fullname" required="required">
			    </div>
			  </div>
              <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Level</label>
			    <div class="col-sm-4">
			   <select class="form-control" name="level" required>
               <option value="">--- Pilih Level --</option>
               <option value="Admin">Admin</option>
               <option value="User">User</option>
               </select>   
                </div>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
	        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
	       </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- Akhir modal tambah data -->
   <br>
   <br>
   <!-- Aksi Insert Data dalam DB -->
	<?php 
	if (isset($_REQUEST['simpan'])) {
	    $user_id = $_REQUEST['user_id'];
		$username = $_REQUEST['username'];
 	    $password = $_REQUEST['password'];
        $fullname = $_REQUEST['fullname'];
        $level = $_REQUEST['level'];
        
		$result = mysqli_query($koneksi,"INSERT INTO user (user_id,username,password,fullname,level) 
									  values ('$user_id','$username','$password','$fullname','$level')");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil disimpan</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !!</strong> Data gagal disimpan</div>";
		}
	}
  
    // Script update data
	if (isset($_POST['update'])) {
		$user_id = $_REQUEST['user_id'];
		$username = $_REQUEST['username'];
 	    $password = $_REQUEST['password'];
        $fullname = $_REQUEST['fullname'];
        $level = $_REQUEST['level'];

		$result = mysqli_query($koneksi,"UPDATE user SET 
									  username='$username',
                                      password='$password',
                                      fullname='$fullname',
                                      level='$level'
									  WHERE user_id='$user_id'");
									  
		if ($result) {
			echo "<br><div class='alert alert-success alert-dismiss'><strong>Success,</strong> Data berhasil diedit</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !</strong> Data gagal disimpan</div>";
		}
	}
	// Akhir update data

	if (isset($_REQUEST['hapus'])) {
		$kd=$_REQUEST['user_id'];

		$result = mysqli_query($koneksi,"DELETE FROM user WHERE user_id='$kd'");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil dihapus</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !</strong> Data gagal dihapus</div>";
		}
	}
	?>
<!-- Akhir insert data -->
 <!-- Menampilkan data  -->
 
 <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#tambahData"><span class="glyphicon glyphicon-plus"></span> Tambah</button><br/><br/>
 	<table class="table table-bordered table-hover">
		<tr>
            <th><center>USER ID</center></th>
			<th><center>USERNAME</center></th>
			<th><center>PASSWORD</center></th>
            <th><center>FULLNAME</center></th>
            <th><center>LEVEL</center></th>
			<th><center>TOOLS</center></th>
		</tr>
		<?php 
          $query = mysqli_query($koneksi,"SELECT * FROM user ORDER BY user_id ASC");
          $no=0;
		  while ($data=mysqli_fetch_array($query)) {
              $no++;
		?>
		<tr>
        <td><?php echo $data['user_id']; ?></td>
			<td><?php echo $data['username']; ?></td>
			<td><?php  $data['password']; ?> ******</td>
  	        <td><?php echo $data['fullname']; ?></td>
            <td><?php echo $data['level']; ?></td>
			<td>
			    <!-- Edit Data -->
			    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['user_id']; ?>" title="Edit Data"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

				<div class="modal fade bs-example-modal-lg" id="edit<?php echo $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog  modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
				      </div>
				      <div class="modal-body">
				        <form class="form-horizontal" action="" method="POST">
				          <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                          <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
			               <div class="col-sm-4">
			               <input type="text" class="form-control" id="inputEmail3" name="username" value="<?php echo $data['username']; ?>" placeholder="Username" required="required">
			               </div>
			              </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
						    <div class="col-sm-10">
						      <textarea class="form-control" placeholder="Password" name="password" value="<?php echo $data['password']; ?>"><?php echo $data['password']; ?></textarea>
						    </div>
						  </div>
                          <div class="form-group">
			                <label for="inputEmail3" class="col-sm-2 control-label">Fullname</label>
			               <div class="col-sm-4">
			               <input type="text" class="form-control" id="inputEmail3" name="fullname" value="<?php echo $data['fullname']; ?>" placeholder="Fullname" required="required">
			               </div>
			              </div>
						  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Level</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="level">
			      	<option>-- Pilih Level --</option>
			      	<option value="Admin" <?php if($data['level']=="Admin"){echo "selected";} ?>>Admin</option>
			      	<option value="User" <?php if($data['level']=="User"){echo "selected";} ?>>User</option>
			      </select>
			    </div>
			  </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
				        <button type="submit" class="btn btn-primary" name="update">Simpan</button>
				       </form>
				      </div>
				    </div>
				  </div>
				</div>
                <!-- Akhir edit data -->
                <!-- Hapus data -->
				<a href="#" class="btn btn-danger btn-sm"title="Hapus Data" data-target=".bs-example-modal-lg<?php echo $data['user_id']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Hapus</a>

				<div class="modal fade bs-example-modal-lg<?php echo $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus data</h4>
				      </div>
				      <div class="modal-body">
				        <h4>Apakah anda benar-benar ingin menghapus data ini ?</h4>
				        <form action="" method="POST">
				        <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
				      </div>
				       <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
				        <button type="submit" class="btn btn-primary" name="hapus">Hapus</button>
				       </form>
				      </div>
				    </div>
				  </div>
				</div>

				<!-- Akhir hapus data -->
			</td>
		</tr>
		<?php } ?>
	</table>
<!-- Menampilkan Data -->
</div>
</div>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Subscribe our Newsletter</h4>
            </div>
            <div class="modal-body">
                <p>Subscribe to our mailing list to get the latest updates straight in your inbox.</p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
                   
                                        </div>
                                        
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
      <?php include "footer.php"; ?>
  </body>
</html>