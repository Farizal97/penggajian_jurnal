<?php
 $pagedesc = "Data User";
 include("sess_check.php");
	$now = date("Y-m-d");
	
	if(isset($_GET['usr'])) {
		$sql = "SELECT user.*, karyawan.* FROM user, karyawan 
				WHERE user.karyawan_id=karyawan.karyawan_id 
				AND user.user_id='". $_GET['usr'] ."'";
		$ress = mysqli_query($conn, $sql);
		$data = mysqli_fetch_array($ress);
	}

	if(isset($_POST['simpan'])) {
		$id = addslashes($_POST['id']);
		$kry = addslashes($_POST['kry']);
		$jenis = addslashes($_POST['jenis']);
		$stt = addslashes($_POST['stt']);
		
		$sql = "UPDATE user SET
					user_akses='". $jenis ."',
					user_stt='". $stt ."'
				WHERE user_id='". $id ."'";
		$ress = mysqli_query($conn, $sql);		
		if($ress){
			echo "<script>alert('Update Data Berhasil!');</script>";
			echo "<script type='text/javascript'> document.location = 'user.php'; </script>";
		}else{
		//	echo("Error description: " . mysqli_error($conn));
			echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
			echo "<script type='text/javascript'> document.location = 'user_tambah.php?usr=$id'; </script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $sysname;?> - <?php echo $pagedesc;?></title>
  <link href="../img/honda.jpg" rel="icon" type="images/x-icon">

  <!-- Custom fonts for this template -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

<?php
 include("sidebar.php");
?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
<?php
 include("navbar.php");
?>
        </nav>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data User</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
            </div>
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
            <div class="card-body">

				<div class="row">
					<div class="col-lg-12 col-md-12">										
						<form class="user" action="" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Karyawan</label>
							<div class="col-sm-6">
								<input type="text" name="kry" class="form-control" value="<?php echo $data['karyawan_id'].' - '.$data['karyawan_nama'];?>" readonly>
								<input type="hidden" name="id" class="form-control" value="<?php echo $data['user_id'];?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Hak Akses</label>
							<div class="col-sm-6">
								<select name="jenis" class="form-control" required>
									<option value="<?php echo $data['user_akses'];?>" selected><?php echo $data['user_akses'];?></option>
									<option value="Admin HRD">Admin HRD</option>
									<option value="Manager">Manager</option>
								</select>									
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-sm-3" align="right">Status</label>
							<div class="col-sm-6">
								<select name="stt" class="form-control" required>
									<option value="<?php echo $data['user_stt'];?>" selected><?php echo $data['user_stt'];?></option>
									<option value="Aktif">Aktif</option>
									<option value="Nonaktif">Nonaktif</option>
								</select>									
							</div>
						</div>
						<hr/>
						</div>
						<div class="panel-footer">
							<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
							<a href="user.php" class="btn btn-info">Batal</a>
						</div>
						</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->

			</div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
	  <?php 
		include("layout_bottom.php");
	  ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>
