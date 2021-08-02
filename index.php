<?php 
session_start();

include('page/function/koneksi.php');

if(!isset($_SESSION['login'])){
  echo "
        <script>
          window.location.href = 'page/data-admin/login.php';
        </script>
      ";
}

if(isset($_GET['logout'])){

  session_destroy();

  echo "
        <script>
          window.location.href = 'page/data-admin/login.php';
        </script>
       ";

}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Pendataan Foto E-Ktp Kec. MI-6</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css">

  <!-- icons -->
  <link rel="stylesheet" type="text/css" href="plugins/font-awesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="plugins/template/css/style.css">
  <link rel="stylesheet" href="plugins/template/css/components.css">

  <!-- data table -->
  <link href="plugins/data-tabel/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
              <li class="nav-link">Kecamatan MI-6</li>
            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <?php if($_SESSION['jk'] == 'Laki-Laki') : ?>
              <img alt="image" src="assets/img/icon-2.png" class="img-fluid mr-1" style="width: 50px; height: 50px;border-radius: 50%;">
            <?php else : ?>
              <img alt="image" src="assets/img/icon-1.png" class="img-fluid mr-1" style="width: 50px; height: 50px;border-radius: 50%;">
            <?php endif; ?>
            <div class="d-sm-none d-lg-inline-block"><?php echo $_SESSION['nama']; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item has-icon">
                <?php if($_SESSION['jk'] == 'Laki-Laki') : ?>
                  <img alt="image" src="assets/img/icon-2.png" class="img-fluid mr-1" style="width: 50px; height: 50px;border-radius: 50%;">
                <?php else : ?>
                  <img alt="image" src="assets/img/icon-1.png" class="img-fluid mr-1" style="width: 50px; height: 50px;border-radius: 50%;">
                <?php endif; ?>
                <?php if($_SESSION['level'] == 'User') : ?>
                  User
                <?php else : ?>
                  Admin
                <?php endif; ?>
              </a>
              <a class="dropdown-item has-icon">
                 <?php echo $_SESSION['nama']; ?>
              </a>
              <a class="dropdown-item has-icon">
                 <?php echo $_SESSION['jk']; ?>
              </a>

              <div class="dropdown-divider"></div>
              <a href="" id="logout" name="logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- sidebar -->
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <!-- <a href="index.html">Stisla</a> -->
            <img src="assets/img/logo.png" class="img-fluid mt-2" alt="logo" style="width: 70px; height: 70px;">
            <span class="ml-2"><b>Pendataan E-Ktp</b></span>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">E-Ktp</a>
          </div>
          <ul class="sidebar-menu mt-5">
            <li><a class="nav-link" href="index.php?page=dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <?php if($_SESSION['level'] == 'Admin') : ?>
              <li>
                <a class="nav-link" href="index.php?page=data-ektp"><i class="fas fa-pencil-ruler"></i> <span>Pendataan</span></a>
              </li>
            <?php else : ?>
            <?php endif; ?>
              <li class="nav-item dropdown">
                <a href="" class="nav-link has-dropdown"><i class="fas fa-th-large"></i><span>Lihat Data Kelurahan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="index.php?page=kel-1">Data Kelurahan 1</a></li>
                  <li><a class="nav-link" href="index.php?page=kel-2">Data Kelurahan 2</a></li>
                  <li><a class="nav-link" href="index.php?page=kel-3">Data Kelurahan 3</a></li>
                  <li><a class="nav-link" href="index.php?page=kel-4">Data Kelurahan 4</a></li>
                </ul>
              </li>
              <!-- <li><a class="nav-link" href="index.php?page=dashboard"><i class="fas fa-users"></i> <span>Data Admin</span></a></li> -->
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">


          <?php 

              if(isset($_GET['page'])){
                $page = $_GET['page'];

                switch ($page) {
                  case 'dashboard':
                    include('page/dashboard/dash.php');
                    break;

                  case 'data-ektp':
                    include('page/data-ektp/data-ektp.php');
                    break;
                  case 'tambah-ektp':
                    include('page/data-ektp/tambah-ektp.php');
                    break;
                  case 'ubah-ektp':
                    include('page/data-ektp/ubah-ektp.php');
                    break;

                  case 'kel-1':
                    include('page/data-ektp-kelurahan/kel-1.php');
                    break;
                  case 'kel-2':
                    include('page/data-ektp-kelurahan/kel-2.php');
                    break;
                  case 'kel-3':
                    include('page/data-ektp-kelurahan/kel-3.php');
                    break;
                  case 'kel-4':
                    include('page/data-ektp-kelurahan/kel-4.php');
                    break;

                  default:
                    echo "Halaman Kosong";
                    break;
                }

              }else{
                  include('page/dashboard/dash.php');
              }

           ?>


        </section>
      </div>
      <!-- akhir main content -->

      <footer class="main-footer">
        <div class="footer-left">
           MI-6 <div class="bullet"></div> Abdul Sasri Laedi-Sulistyo La Ode-Mega Aurawati-Triwulan Tomia
        </div>
        <div class="footer-right">
          <small>UAS - Pemrograman Website 2 | Dosen Pengampu : <b>Subhan Ramdhani, S. Kom</b></small>
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script type="text/javascript" src="plugins/bootstrap/js/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/popper.min.js" ></script>
  <script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/bootstrap/js/jquery.nicescroll.min.js"></script>
  <script src="plugins/bootstrap/js/moment.min.js"></script>
  <script src="plugins/template/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="plugins/template/js/scripts.js"></script>
  <script src="plugins/template/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="plugins/template/js/page/index-0.js"></script>

  <!-- data table -->
  <script src="plugins/data-tabel/js/jquery.dataTables.min.js"></script>
  <script src="plugins/data-tabel/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/data-tabel/js/datatables-demo.js"></script>

  <script src='plugins/alert/sweetalert2.all.min.js'></script>


<!-- hapus data -->
<script>

  $(document).on('click','#logout', function(e){
    e.preventDefault();

    Swal.fire({
      title: 'Logout ?',
      text: "Anda Akan Keluar Dari Aplikasi",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php?logout=1';
      }
    })
});
</script>

</body>
</html>
