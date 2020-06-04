<?php 
$conn = mysqli_connect("localhost","root","","test");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Belajar CRUD modal Bootstrap | Sederhana</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<div id="container">
<div id="wrapper">
<div class="col-lg-12">
  
   <!-- Modal Tambah Data -->
   <div class="modal fade bs-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="tambahDataLabel">
	  <div class="modal-dialog  modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="tambahDataLabel">Tambah Member</h4>
	      </div>
	      <div class="modal-body">
	       	<form class="form-horizontal" action="" method="POST">
			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label">No Member</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="inputEmail3" name="no_member" value="<?php echo rand(1000000,2000000) ?>" placeholder="No Member" readonly="readonly">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="nama" placeholder="Nama" required="required">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" placeholder="Alamat" name="alamat" required="required"></textarea>
			    </div>
			  </div>
				<div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
					<input type="email" class="form-control"  name="email" placeholder="Email" required="required">
			    </div>
			  </div>
				<div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
			    <div class="col-sm-10">
					<input type="text" class="form-control"  name="telepon" placeholder="Telepon" required="required">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="status">
			      	<option>Pilih Status</option>
			      	<option value="PEM">Pembeli</option>
			      	<option value="PEL">Pelanggan</option>
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
		$no_member = $_REQUEST['no_member'];
		$nama      = $_REQUEST['nama'];
		$alamat    = $_REQUEST['alamat'];
		$email     = $_REQUEST['email'];
		$telepon   = $_REQUEST['telepon'];
		$status    = $_REQUEST['status'];

		$result = mysqli_query($conn,"INSERT INTO data (no_member,nama,alamat,email,telepon,status) 
									  values ('$no_member','$nama','$alamat','$email','$telepon','$status')");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil disimpan</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !!</strong> Data gagal disimpan</div>";
		}
	}
  
    // Script update data
	if (isset($_POST['update'])) {
		$no_member = $_POST['no_member'];
		$nama      = $_POST['nama'];
		$alamat    = $_POST['alamat'];
		$email     = $_POST['email'];
		$telepon   = $_POST['telepon'];
		$status    = $_POST['status'];

		$result = mysqli_query($conn,"UPDATE data SET 
									  nama='$nama', 
									  alamat='$alamat', 
									  email='$email', 
									  telepon='$telepon',
										status='$status' 
									  WHERE no_member='$no_member'");
									  
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil diedit</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !</strong> Data gagal disimpan</div>";
		}
	}
	// Akhir update data

	if (isset($_REQUEST['hapus'])) {
		$no_member=$_REQUEST['no_member'];

		$result = mysqli_query($conn,"DELETE FROM data WHERE no_member='$no_member'");
		if ($result) {
			echo "<br><div class='alert alert-success'><strong>Success,</strong> Data berhasil dihapus</div>";
		}else{
	        echo "<br><div class='alert alert-danger'><strong>Ups !</strong> Data gagal dihapus</div>";
		}
	}
	?>
<!-- Akhir insert data -->
 <!-- Menampilkan data  -->
 
 <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#tambahData"><span class="glyphicon glyphicon-plus"></span> Tambah</button>
 <a href="send-bulk-email.php" class="btn btn-info btn-md"><span class="glyphicon glyphicon-send"></span> Kirim Email</a><br/><br/>
	<table class="table table-bordered">
		<tr>
			<th>NO MEMBER</th>
			<th>NAMA</th>
			<th>ALAMAT</th>
			<th>EMAIL</th>
			<th>TELEPON</th>
			<th>STATUS</th>
			<th>TOOLS</th>
		</tr>
		<?php 
		  $query = mysqli_query($conn,"SELECT * FROM data ORDER BY no_member DESC");
		  while ($data=mysqli_fetch_array($query)) {
		?>
		<tr>
			<td><?php echo $data['no_member']; ?></td>
			<td><?php echo $data['nama']; ?></td>
			<td><?php echo $data['alamat']; ?></td>
			<td><?php echo $data['email']; ?></td>
			<td><?php echo $data['telepon']; ?></td>
			<td><?php echo $data['status']; ?></td>
			<td>
			    <!-- Edit Data -->
				<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data['no_member']; ?>" title="Edit Data"><span class="glyphicon glyphicon-pencil"></span></a>

				<div class="modal fade bs-example-modal-lg" id="edit<?php echo $data['no_member']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog  modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Edit Data Member</h4>
				      </div>
				      <div class="modal-body">
				        <form class="form-horizontal" action="" method="POST">
				          <input type="hidden" name="no_member" value="<?php echo $data['no_member']; ?>">
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">No Member</label>
						    <div class="col-sm-4">
						      <input type="text" class="form-control" id="inputEmail3" name="no_member" placeholder="No Member" value="<?php echo $data['no_member']; ?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Nama</label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="inputPassword3" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Alamat</label>
						    <div class="col-sm-10">
						      <textarea class="form-control" placeholder="Alamat" name="alamat" value="<?php echo $data['alamat']; ?>"><?php echo $data['alamat']; ?></textarea>
						    </div>
						  </div>
						  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
					<input type="email" class="form-control"  name="email" value="<?php echo $data['email']; ?>" placeholder="Email" required="required">
			    </div>
			  </div>
				<div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Telepon</label>
			    <div class="col-sm-10">
					<input type="text" class="form-control"  name="telepon"value="<?php echo $data['telepon']; ?>" placeholder="Telepon" required="required">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-10">
			      <select class="form-control" name="status">
			      	<option>Pilih Status</option>
			      	<option value="PEM" <?php if($data['status']=="PEM"){echo "selected";} ?>>Pembeli</option>
			      	<option value="PEL" <?php if($data['status']=="PEL"){echo "selected";} ?>>Pelanggan</option>
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
				<a href="#" class="btn btn-danger btn-sm"title="Hapus Data" data-target=".bs-example-modal-lg<?php echo $data['no_member']; ?>" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></a>

				<div class="modal fade bs-example-modal-lg<?php echo $data['no_member']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus data</h4>
				      </div>
				      <div class="modal-body">
				        <h4>Apakah anda benar-benar ingin menghapus data ini ?</h4>
				        <form action="" method="POST">
				        <input type="hidden" name="no_member" value="<?php echo $data['no_member']; ?>">
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
<script>
 $(window).load(function(){        
   $('#myModal').modal('toggle');
    }); 
</script>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>