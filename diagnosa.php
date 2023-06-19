<?php include "conn.php"; ?>
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
            <h2>Diagnosa</h2>
            <table class="table table-bordered table-hover">
              <tr>
                <th><center>No</center></th>
                <th><center>Gejala</center></th>
                <th><center>Cek</center></th>
              </tr>

            <?php if (isset($_GET['error'])) {echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong>Ups! </strong> $_GET[error]
          </div>";} else { echo "";} ?>
            <form method="POST" action="hasil.php" name="diagnosa" enctype="form-data/multipart">
            <?php 
              $query = mysqli_query($koneksi,"SELECT * FROM gejala ORDER BY kd_gejala ASC");
                  $no=0;
              while ($data=mysqli_fetch_array($query)) {
                  $a = $data['gejala'];
                      $no++;
            ?>
            <tr>
            <td><center><?php echo $no; ?>.    </center></td>
            <td><?php echo $data['gejala']; ?><br /></td>
            <td><center><input type="checkbox" value="<?php echo $data['kd_gejala'];?>" name="cek[]" /></center></td> 
                <?php }?><br />
            </tr>
                <input type="submit" class="btn btn-medium btn-primary mb-4 float-right" value="Cek Diagnosa" name="proses" />
            </form>
            </table>
            </div>
        </div>
        <br /><br />
      </main>
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
   <!-- <script type="text/javascript">
      $(document).ready(function(){
          $("#myModal").modal('show');
      });
  </script> -->
  </body>
</html>
