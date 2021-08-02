<?php 
session_start();

include('../function/koneksi.php');

  if(isset($_POST['login'])){

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $cekUsername = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' ");

    if(mysqli_num_rows($cekUsername) == 1 ){

      $data = mysqli_fetch_assoc($cekUsername);

      if($username == $data['username']){

        if(password_verify($password, $data['password'])){

          $_SESSION['login'] = true;
          $_SESSION['jk'] = $data['jk'];
          $_SESSION['nama'] = $data['nama'];
          $_SESSION['username'] = $data['username'];
          $_SESSION['level'] = $data['level'];

          $loginBerhasil = true;
         
        }

      }

    }

    $loginError = true;


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

    <title>Login - Admin</title>
  </head>
  <body style="background-color: lightblue;">
    
    <div class="container">
        <div class="container-fluid">
          <div class="d-flex justify-content-center mt-3">
           <img src="../../assets/img/logo.png" alt="logo" class="img-fluid" style="width: 130px; height: 130px;">
          </div>
          <div class="d-flex justify-content-center">
            <div class="card mt-2" style="width: 500px;">
              <div class="card-header d-flex justify-content-center">
                <h1>Login Guru</h1>
              </div>
              <div class="card-body">
                
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required="" placeholder="Username" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required="" placeholder="Password">
                      <?php if (isset($loginError)) : ?>
                        <small style="color: red; font-style: italic;">Username atau password salah</small>
                      <?php endif; ?>
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lihatPassword" style="font-size: 10pt;" onclick="lihatPass();">
                        <label class="form-check-label" for="lihatPassword" style="font-size: 10pt;">Lihat Password</label>
                      </div>
                  </div>
                  
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" id="login" name="login" style="width: 100px;">Login</button>
                  </div>
                </form>

                <div class="d-flex justify-content-center mt-3 mb-3">
                  <a href="registrasi.php" style="text-decoration: none;">Registrasi Data Login</a>
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

    <!-- login -->
    <?php if(isset($loginBerhasil)) : ?>
      <div id="loginBerhasil"></div>
    <?php endif; ?>

    <script>
      $(document).ready(function(){
        var login = $('#loginBerhasil');

        if(loginBerhasil){
             Swal.fire({
              title: 'Sukses',
              text: 'Login Sukses', 
              icon: 'success',
              allowOutsideClick: false,
          }).then((result) => {
                window.location.href = '../../index.php';
          })
        }
      })
    </script>

  
  </body>
</html>