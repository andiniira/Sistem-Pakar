<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SISTEM PAKAR DIAGNOSA PENYAKIT SAYUR ORGANIK | www.hakkoblogs.com">
    <link rel="icon" href="">

    <title>SISTEM PAKAR DIAGNOSA PENYAKIT PADA SAYURAN ORGANIK</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <?php include "header.php"; ?>

      <main role="main">

        <!-- Example row of columns -->
        <div class="row">
          <div class="col-lg-12">
            <h2>Daftar Penyakit Tanaman Sayur Organik</h2>
            <table class="table table-bordered table-hover mt-4">
		<tr>
            <th><center>No</center></th>
			<th><center>Kode </center></th>
			<th><center>Nama Penyakit</center></th>
            <th><center>Penyebab</center></th>
            <th><center>Deskripsi</center></th>
		</tr>
		<?php 
        include "conn.php";
          $query = mysqli_query($koneksi,"SELECT * FROM penyakit ORDER BY kode ASC");
          $no=0;
		  while ($data=mysqli_fetch_array($query)) {
              $no++;
		?>
		<tr>
        <td><center><?php echo $no; ?>. </center></td>
			<td><center><?php echo $data['kode']; ?></center></td>
			<td><?php echo $data['nama_penyakit']; ?></td>
  	        <td><?php echo $data['penyebab']; ?></td>
            <td><center><a href="deskripsi.php?id=<?php echo $data['kode']; ?>" class="btn btn-sm btn-primary">Detail</a></center></td>
            </tr>
            <?php } ?>
            </table>
          </div>
        </div>

      </main>

      <!-- Modal Popup -->
      <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
                </div>
                <div class="modal-body">
                    <p>Selamat datang di sistem pakar gejala penyakit pada tumbuhan.</p>
                    <p>Di aplikasi ini anda bisa mengetahui penyakit tumbuhan dengan gejala yang ditimbulkannya</p>
                    <b>Sistem Pakar Penyakit Tumbuhan</b>
                </div>
            </div>
        </div>
    </div>
<!-- end Modal Popup -->

      <!-- Site footer -->
      <nav class="navbar navbar-expand-md navbar-light rounded justify-content-center mt-5" style="background-color: #229954; color: white;"><h6 style="padding-top: 10px; padding-bottom: 10px;">Copyright &copy; 2023 Kelompok 4 </h6></nav>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="js/jquery-slim.min.js"></script> -->
    <!-- <script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script> -->
    <script src="js/popper.min.js"></script>
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  <!--  <script type="text/javascript">
      $(document).ready(function(){
          $("#myModal").modal('show');
      });
  </script>-->
  </body>
</html>
