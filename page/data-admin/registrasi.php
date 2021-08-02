<?php 

include('../function/koneksi.php');
  
    if(isset($_POST['simpan'])){

    $nama = htmlspecialchars($_POST['nama']);
    $jk = htmlspecialchars($_POST['jk']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $konPass = htmlspecialchars($_POST['konPass']);
    $level = htmlspecialchars($_POST['level']);

    $cekUsername = mysqli_query($con, "SELECT username FROM admin WHERE username = '$username' ");
    $usernameSama = mysqli_fetch_assoc($cekUsername);

    if($usernameSama){

      $usernameError = true;

    }else if($password != $konPass){

      $konPassError = true;

    }else{

      $password = password_hash($password, PASSWORD_DEFAULT);

      $sqlInsert = mysqli_query($con, "INSERT INTO admin VALUES('','$nama','$jk','$username','$password','$level') ");

      if(mysqli_affected_rows($con) > 0){
        echo " 
        <script>
           window.location.href = 'registrasi.php?sukses=1';
         </script>" ;
      }

    }


    
  }

 ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">

    <title>Registrasi - Admin</title>
  </head>
  <body style="background-color: lightblue;">
    
    <div class="container">
        <div class="container-fluid">
          <div class="d-flex justify-content-center mt-3">
            <img src="../../assets/img/logo.png" alt="logo" class="img-fluid" style="width: 130px; height: 130px;">
          </div>
          <div class="d-flex justify-content-center">
            <div class="card mt-2 mb-5" style="width: 800px;">
              <div class="card-header d-flex justify-content-center">
                <h2 class="text-center">Registrasi Data Admin</h2>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label for="nama">Nama Lengkap</label>
                              <input type="text" class="form-control" id="nama" name="nama" required="" placeholder="Nama Lengkap" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="custom-select" id="jk" name="jk">
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username" required="" placeholder="Username" aria-describedby="emailHelp">
                              <?php if(isset($usernameError)) : ?>
                                <small style="color: red; font-style: italic;font-size: 9pt;">Username telah digunakan</small>
                              <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                              <label for="password">Password</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <input type="checkbox" class="form-check-input" id="lihatKonpass" style="font-size: 10pt;" onclick="lihatPass();">
                                    </div>
                                  </div>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="konPass">Konfirmasi Password</label>
                                <div class="input-group mb-2">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text">
                                      <input type="checkbox" class="form-check-input" id="lihatKonpass" style="font-size: 10pt;" onclick="lihatKonPass();">
                                    </div>
                                  </div>
                                  <input type="password" class="form-control" id="konPass" name="konPass" placeholder="Konfirmasi Password" required="">
                                </div>
                                <?php if(isset($konPassError)) : ?>
                                    <small style="color: red; font-style: italic;font-size: 9pt;">Konfirmasi Password Salah</small>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <select class="custom-select" id="level" name="level">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                              </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="simpan" name="simpan" style="width: 100px;">Daftar</button>

                </form>

                <div class="d-flex justify-content-end mb-3">
                  <a href="login.php" style="text-decoration: none;">Login</a>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>

   
    <script src="../../plugins/bootstrap/js/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src='../../plugins/alert/sweetalert2.all.min.js'></script>

    <script>
      function lihatPass(){
        var password = document.getElementById('password');
          if(password.type == 'password'){
             password.type = 'text';
          }else{
            password.type = 'password';
          }
      }
    </script>
    <script>
      function lihatKonPass(){
        var konPass = document.getElementById('konPass');
          if(konPass.type == 'password'){
             konPass.type = 'text';
          }else{
            konPass.type = 'password';
          }
      }
    </script>

    <!-- notifikasi daftar -->
    <?php if(isset($_GET['sukses'])) : ?>
      <div id="sukses" data-sukses="<?php echo $_GET['sukses']; ?>"></div>
    <?php endif; ?>

      <script>
        $(document).ready(function(){
          var sukses = $('#sukses').data('sukses');

          if(sukses){
              Swal.fire({
                title: 'Sukses',
                text: 'Data Berhasil Disimpan', 
                icon: 'success',
                allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'login.php';
            })
          }

        })
       </script>
  
  </body>
</html>