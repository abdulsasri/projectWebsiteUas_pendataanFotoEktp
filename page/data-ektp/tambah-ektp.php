<?php 

  if(isset($_POST['simpan'])){

    $nik = htmlspecialchars($_POST['nik']);
    $nama = htmlspecialchars($_POST['nama']);
    $nama = strtoupper($nama);
    $alamat = htmlspecialchars($_POST['alamat']);


    // cek nik sama
    $sqlNik = mysqli_query($con, "SELECT nik FROM masyarakat WHERE nik = '$nik' ");
    $nikSama = mysqli_fetch_assoc($sqlNik);

    if(isset($nikSama)){
      echo "
          <script>  
              window.location.href = 'index.php?page=tambah-ektp&nik=1';
          </script>
          ";
        return false;
    }

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

      $fileKK = pdfFile();
      if(!$fileKK){
        return false;
      }


      $sqlInsert = "INSERT INTO masyarakat VALUES('','$nik','$nama','$alamat','$fileKK','')";
      $resInsert = mysqli_query($con, $sqlInsert);

      if($resInsert){
          echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Sukses',
                  text: 'Data Berhasil Disimpan', 
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
                  text: 'Data Gagal Disimpan', 
                  icon: 'error',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=tambah-ektp';
            })
           </script>" ;
        }


  }

 ?>
          <div class="section-header">
            <h1><i class="fas fa-id-card mr-2" style="font-size: 20pt;"></i>Tambah Data E-Ktp</h1>
          </div>
          
          <div class="card">
            <div class="row">
              <div class="card-header">
                 <div class="col-sm-6">
                    Form Tambah Data E-Ktp
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
                        <input type="number" class="form-control" id="nik" name="nik" required="" placeholder="Enter NIK">
                        <?php if(isset($_GET['nik'])) : ?>
                          <small style="font-style: italic; color: red;">NIK Sudah Ada di Pendatan E-KTP</small>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required="" placeholder="Enter Nama">
                      </div>
                      
                   </div>
                   <div class="col-sm-6">
                    <div class="form-group">
                      <label for="">Alamat</label>
                      <select class="custom-select" id="alamat" name="alamat">
                        <option value="Kelurahan 1">Kelurahan 1</option>
                        <option value="Kelurahan 2">Kelurahan 2</option>
                        <option value="Kelurahan 3">Kelurahan 3</option>
                        <option value="Kelurahan 4">Kelurahan 4</option>
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





          