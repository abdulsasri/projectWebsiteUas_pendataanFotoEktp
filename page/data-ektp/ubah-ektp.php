<?php 
  
  $id = $_GET['id'];
  $sqlDataUbah = mysqli_query($con, "SELECT * FROM masyarakat WHERE id = '$id' ");
  $dataUbah = mysqli_fetch_assoc($sqlDataUbah);

  if(isset($_POST['simpan'])){

    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $nama = strtoupper($nama);
    $alamat = htmlspecialchars($_POST['alamat']);
    $kkLama = htmlspecialchars($_POST['kkLama']);

    // cek nik sama
    $sqlNik = mysqli_query($con, "SELECT nik FROM masyarakat WHERE nik = '$nik' ");
    $nikSama = mysqli_fetch_assoc($sqlNik);

    if($nik == $dataUbah['nik'] || !$nikSama ){

      function pdfFile(){
      $namaFile = $_FILES['kk']['name'];
      $ukuranFile = $_FILES['kk']['size'];
      $tmpFile = $_FILES['kk']['tmp_name'];
      $error = $_FILES['kk']['error'];

      $formatFileFalid = ['pdf'];
      $formatFile = explode(".", $namaFile);
      $formatFile = strtolower(end($formatFile));

      if(!in_array($formatFile, $formatFileFalid)){
        echo "
          <script>  
              window.location.href = 'index.php?page=tambah-ektp&format=1';
          </script>
          ";
        return false;
      }

      if($ukuranFile > 1000000){
      echo "
          <script>  
              window.location.href = 'index.php?page=tambah-ektp&size=1';
          </script>
          ";
          return false;
      }

      $namaFileBaru = uniqid();
      $namaFileBaru .= '.';
      $namaFileBaru .= $formatFile;

      move_uploaded_file($tmpFile, 'assets/berkas kk/'.$namaFileBaru);

      return $namaFileBaru;

    }

      if($_FILES['kk']['error'] == 4){
        $fileKK = $kkLama;

          $sqlUbah = "UPDATE masyarakat SET 
                nik = '$nik', 
                nama = '$nama', 
                kelurahan = '$alamat',
                file_kk = '$fileKK' WHERE id = '$id' ";
          $resUbah = mysqli_query($con, $sqlUbah);

          if($resUbah){
              echo " 
              <script src='plugins/alert/sweetalert2.all.min.js'></script>
              <script>
                 Swal.fire({
                      title: 'Sukses',
                      text: 'Data Berhasil Diubah', 
                      icon: 'success',
                      allowOutsideClick: false,
                }).then((result) => {
                      window.location.href = 'index.php?page=data-ektp';
                })
               </script>" ;
            
            }else{
              echo " 
              <script src='plugins/alert/sweetalert2.all.min.js'></script>
              <script>
                 Swal.fire({
                      title: 'Error',
                      text: 'Data Gagal Diubah', 
                      icon: 'error',
                      allowOutsideClick: false,
                }).then((result) => {
                      window.location.href = 'index.php?page=ubah-ektp';
                })
               </script>" ;
        }

      }else{
        $fileKK = pdfFile();
          if(!$fileKK){
            return false;
          }

      $sqlUbah = "UPDATE masyarakat SET 
            nik = '$nik', 
            nama = '$nama', 
            kelurahan = '$alamat',
            file_kk = '$fileKK' WHERE id = '$id' ";
      $resUbah = mysqli_query($con, $sqlUbah);

      if($resUbah){
            $fileKkLama = $dataUbah['file_kk'];
            $hapusFileKkLama = "assets/berkas kk/".$fileKkLama;
            unlink($hapusFileKkLama);
          echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Sukses',
                  text: 'Data Berhasil Diubah', 
                  icon: 'success',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=data-ektp';
            })
           </script>" ;
        
        }else{
          echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Error',
                  text: 'Data Gagal Diubah', 
                  icon: 'error',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=ubah-ektp';
            })
           </script>" ;
        }
    }

    }else if($nik != $dataUbah['nik'] && $nikSama ){
        echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Error',
                  text: 'NIK Yang Dimasukan Sudah Ada', 
                  icon: 'error',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=data-ektp';
            })
           </script>" ;
        return false;
    }


    

  }

 ?>
          <div class="section-header">
            <h1><i class="fas fa-id-card mr-2" style="font-size: 20pt;"></i>Ubah Data E-Ktp</h1>
          </div>
          
          <div class="card">
            <div class="row">
              <div class="card-header">
                 <div class="col-sm-6">
                    Form Ubah Data E-Ktp
                 </div>
                 <div class="col-sm-6 d-flex justify-content-end">
                    <!-- <a href="" class="btn btn-primary">Tambah Data</a> -->
                 </div>
              </div>
            </div>
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                   <div class="col-sm-6">
                      <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" class="form-control" id="nik" name="nik" required="" placeholder="Enter NIK" value="<?php echo $dataUbah['nik']; ?>">
                      </div>

                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required="" placeholder="Enter Nama" value="<?php echo $dataUbah['nama']; ?>">
                      </div>
                      
                   </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <select class="custom-select" id="alamat" name="alamat">
                        <option value="Kelurahan 1" 
                          <?php if($dataUbah['kelurahan'] == 'Kelurahan 1'){echo "selected";} ?>
                        >Kelurahan 1</option>
                        <option value="Kelurahan 2" 
                          <?php if($dataUbah['kelurahan'] == 'Kelurahan 2'){echo "selected";} ?>
                        >Kelurahan 2</option>
                        <option value="Kelurahan 3" 
                          <?php if($dataUbah['kelurahan'] == 'Kelurahan 3'){echo "selected";} ?>
                        >Kelurahan 3</option>
                        <option value="Kelurahan 4" 
                          <?php if($dataUbah['kelurahan'] == 'Kelurahan 4'){echo "selected";} ?>
                        >Kelurahan 4</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="kk">File KK</label>
                        <input type="file" class="form-control" id="kk" name="kk">
                        <small>PDF File</small>
                        <?php if(isset($_GET['format'])) : ?>
                          <small style="font-style: italic; color: red;"> - Yang Anda Masukan Bukan File PDF</small>
                        <?php endif; ?>
                        <?php if(isset($_GET['size'])) : ?>
                          <small style="font-style: italic; color: red;"> - File Tidak Boleh Lebih Dari 1MB</small>
                        <?php endif; ?>
                        <input type="hidden" class="form-control" id="kkLama" name="kkLama" placeholder="Enter Nama" value="<?php echo $dataUbah['file_kk']; ?>">
                    </div>

                   </div>   
                  </div>  
                  <div class="row mt-3 mb-5">
                     <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary mr-2" id="simpan" name="simpan">Simpan</button>
                        <a href="index.php?page=data-ektp" class="btn btn-success">Batal</a>
                     </div>
                  </div>
                </form>
            </div>
          </div>





          