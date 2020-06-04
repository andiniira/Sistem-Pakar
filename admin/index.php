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
                            <div class="col-md-12 padding-0">
                                <div class="col-md-3">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-teal border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Total Gejala</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                        <?php $tampil=mysqli_query($koneksi, "select * from gejala order by kd_gejala desc");
                                              $total=mysqli_num_rows($tampil);
                                         ?>
                                      <div class="panel-body text-center">
                                        <h1><?php echo $total; ?></h1>
                                        <p>Gejala</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-orange border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Penyakit Tanaman</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <?php $tampil1=mysqli_query($koneksi, "select * from penyakit order by kode desc");
                                              $total1=mysqli_num_rows($tampil1);
                                         ?>
                                      <div class="panel-body text-center">
                                        <h1><?php echo $total1; ?></h1>
                                        <p>Kasus</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-purple border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Pencegahan</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <?php $tampil2=mysqli_query($koneksi, "select * from pencegahan order by kd_pencegahan desc");
                                              $total2=mysqli_num_rows($tampil2);
                                         ?>
                                      <div class="panel-body text-center">
                                        <h1><?php echo $total2; ?></h1>
                                        <p>Cara</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-blue border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">Solusi</h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                       <?php $tampil3=mysqli_query($koneksi, "select * from solusi order by kd_solusi");
                                              $total3=mysqli_num_rows($tampil3);
                                         ?>
                                      <div class="panel-body text-center">
                                        <h1><?php echo $total3; ?></h1>
                                        <p>Solusi</p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                           
                            <div class="col-md-12">
                                <div class="panel box-v4">
                                    <div class="panel-heading bg-white border-none">
                                      <h4><span class="icon-notebook icons"></span> Gejala Baru</h4>
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                        <?php
                    $qry="select * from gejala order by kd_gejala limit 10";
        
                    $tmpl=mysqli_query($koneksi, $qry) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-bordered">
                  <thead>
                      <tr>
                        <th><center>No </center></th>
                        <th><center>Kode</center></th>
                        <th><center>Gejala</center></th>
                        
                      </tr>
                  </thead>
                     <?php 
                     $no=0;
                     while($data=mysqli_fetch_array($tmpl))
                    { $no++; ?>
                    <tbody>
                    <tr>
                    <td><center><?php echo $no; ?></center></td>
                    <td><center><?php echo $data['kd_gejala'];?></center></td>
                    <td><?php echo $data['gejala'];?></td>
                   </tbody>
                    <?php } ?>
                   </table>
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