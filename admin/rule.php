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
                                      <h4><span class="icon-notebook icons"></span> Rule Kondisi</h4>
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                        <!-- Modal Tambah Data -->
   <div class="modal fade bs-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel">
	  <div class="modal-dialog  modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="tambahDataLabel">Tambah Gejala</h4>
	      </div>
	      <div class="modal-body">
	       	<form class="form-horizontal" action="" method="POST">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">Kondisi</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="jika" placeholder="Kondisi" required="required">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Penyakit</label>
			    <div class="col-sm-10">
	            <select class="form-control" name="maka" required>
               <option value="">--- Pilih Penyakit --</option>
               <?php 
                    $query1="select * from penyakit order by kode";
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    while($data1=mysqli_fetch_array($tampil))
                    {
                    ?>
                              
                                  
							
							<option value="<?php echo $data1['kode'];?>"><?php echo $data1['kode'];?> - <?php echo $data1['nama_penyakit'];?></option>
						    <?php } ?>
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
		$jika = $_REQUEST['jika'];
		$maka = $_REQUEST['maka'];

		$result = mysqli_query($koneksi,"INSERT INTO rule (jika,maka) 
									  values ('$jika','$maka')");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil disimpan</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !!</strong> Data gagal disimpan</div>";
		}
	}
  
    // Script update data
	if (isset($_POST['update'])) {
		$jika = $_REQUEST['jika'];
		$maka = $_REQUEST['maka'];

		$result = mysqli_query($koneksi,"UPDATE rule SET 
									  maka='$maka'
									  WHERE jika='$jika'");
									  
		if ($result) {
			echo "<br><div class='alert alert-success alert-dismiss'><strong>Success,</strong> Data berhasil diedit</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !</strong> Data gagal disimpan</div>";
		}
	}
	// Akhir update data

	if (isset($_REQUEST['hapus'])) {
		$kd=$_REQUEST['jika'];

		$result = mysqli_query($koneksi,"DELETE FROM rule WHERE jika='$kd'");
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
            <th><center>NO</center></th>
			<th><center>KONDISI</center></th>
			<th><center>PENYAKIT</center></th>
			<th><center>TOOLS</center></th>
		</tr>
		<?php 
          $query = mysqli_query($koneksi,"SELECT * FROM rule ORDER BY jika ASC");
          $no=0;
		  while ($data=mysqli_fetch_array($query)) {
              $no++;
		?>
		<tr>
        <td><?php echo $no; ?></td>
			<td><?php echo $data['jika']; ?></td>
			<td><?php echo $data['maka']; ?></td>
			<td>
			    <!-- Edit Data -->
			    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['jika']; ?>" title="Edit Data"><span class="glyphicon glyphicon-pencil"></span> Edit</a>

				<div class="modal fade bs-example-modal-lg" id="edit<?php echo $data['jika']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog  modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Edit Data Gejala</h4>
				      </div>
				      <div class="modal-body">
				        <form class="form-horizontal" action="" method="POST">
				          <!--<input type="hidden" name="kd_gejala" value="<?php //echo $data['jika']; ?>">-->
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Jika</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="inputEmail3" name="jika" placeholder="Rule Kondisi" value="<?php echo $data['jika']; ?>" readonly="readonly">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Penyakit</label>
						    <div class="col-sm-10">
                            <select class="form-control" name="maka" required>
               <option value="">--- Pilih Penyakit --</option>
               <?php 
                    $query1="select * from penyakit order by kode";
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    while($data1=mysqli_fetch_array($tampil))
                    {
                    ?>
                              
                                  
							
							<option value="<?php echo $data1['kode'];?>"><?php echo $data1['kode'];?> - <?php echo $data1['nama_penyakit'];?></option>
						    <?php } ?>
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
				<a href="#" class="btn btn-danger btn-sm"title="Hapus Data" data-target=".bs-example-modal-lg<?php echo $data['jika']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Hapus</a>

				<div class="modal fade bs-example-modal-lg<?php echo $data['jika']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus data</h4>
				      </div>
				      <div class="modal-body">
				        <h4>Apakah anda benar-benar ingin menghapus data ini ?</h4>
				        <form action="" method="POST">
				        <input type="hidden" name="jika" value="<?php echo $data['jika']; ?>">
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