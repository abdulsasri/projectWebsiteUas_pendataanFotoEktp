<?php 

if(isset($_GET['foto'])){
  $id = $_GET['foto'];

  $sqlUbah = "UPDATE masyarakat SET 
            status = 'Telah Foto'  WHERE id = '$id' ";
      $resUbah = mysqli_query($con, $sqlUbah);

      if($resUbah){
          echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Sukses',
                  text: 'Data Ini Telah Foto', 
                  icon: 'success',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=data-ektp';
            })
           </script>" ;
        
        }
}

if(isset($_GET['fotobatal'])){
  $id = $_GET['fotobatal'];

  $sqlUbah = "UPDATE masyarakat SET 
            status = ''  WHERE id = '$id' ";
      $resUbah = mysqli_query($con, $sqlUbah);

      if($resUbah){
          echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Sukses',
                  text: 'Batalkan Foto Berhasil', 
                  icon: 'success',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=data-ektp';
            })
           </script>" ;
        
        }
}

if(isset($_GET['id'])){

  $id = $_GET['id'];

    $sqlHapusFileKk = mysqli_query($con, "SELECT * FROM masyarakat WHERE id = '$id' ");
    $dataHapus = mysqli_fetch_assoc($sqlHapusFileKk);
  
    $sqlHapus= "DELETE FROM masyarakat WHERE id = $id";
    $resHapus = mysqli_query ($con, $sqlHapus);

    if($resHapus){
      $fileKkLama = $dataHapus['file_kk'];
      $hapusFileKkLama = "assets/berkas kk/".$fileKkLama;
      unlink($hapusFileKkLama);
      echo " 
          <script src='plugins/alert/sweetalert2.all.min.js'></script>
          <script>
             Swal.fire({
                  title: 'Sukses',
                  text: 'Data Berhasil Dihapus', 
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
                  text: 'Data Gagal Dihapus', 
                  icon: 'error',
                  allowOutsideClick: false,
            }).then((result) => {
                  window.location.href = 'index.php?page=data-ektp';
            })
           </script>" ;
    }
}
 ?>



          <div class="section-header">
            <h1><i class="fas fa-id-card mr-2" style="font-size: 20pt;"></i>Pendataan Data E-Ktp</h1>
          </div>
          
          <div class="card">
            <div class="row">
              <div class="card-header">
                 <div class="col-sm-6">
                    Table Data Masyarakat
                 </div>
                 <div class="col-sm-6 d-flex justify-content-end">
                    <a href="index.php?page=tambah-ektp" class="btn btn-primary">Tambah Data</a>
                 </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>File KK</th>
                            <th style="text-align:center;">Status Foto</th>
                            <th style="text-align:center;">Olah</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $dataEktp = mysqli_query($con, "SELECT * FROM masyarakat ORDER BY nama"); ?>
                      <?php $no=1; ?>
                      <?php foreach ($dataEktp as $data) : ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;"><?php echo $no; ?></td>
                            <td> <?php echo $data['nik']; ?> </td>
                            <td> <?php echo $data['nama']; ?> </td>
                            <td> <?php echo $data['kelurahan']; ?> </td>
                            <td>
                              <a href="assets/berkas kk/<?php echo $data['file_kk']; ?>" class="btn btn-info" target="blank">Lihat</a>
                            </td>
                            <?php if($data['status'] == '') : ?>
                              <td style="text-align: center;"> <?php echo "Belum Foto" ; ?> </td>
                            <?php else : ?>
                              <td style="text-align: center;"><i class="fas fa-check"></i></td>
                            <?php endif; ?>
                            <td style="text-align: center;">
                              <?php if($data['status'] == 'Telah Foto') : ?>
                                <button class="btn btn-info" id="fotobatal" data-fotobatal="<?php echo $data['id']; ?>">Batal Foto</button>
                              <?php else : ?>
                                <button class="btn btn-primary" id="foto" data-foto="<?php echo $data['id']; ?>">Telah Foto</button>
                              <?php endif ; ?>
                              <a href="index.php?page=ubah-ektp&id=<?php echo $data['id']; ?>" class="btn btn-warning">Ubah</a>
                              <button class="btn btn-danger" id="hapus" data-hapus="<?php echo $data['id']; ?>">Hapus</button>
                            </td>
                        </tr>
                      <?php $no++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>




<script type="text/javascript" src="plugins/bootstrap/js/jquery.min.js"></script>
<script src='js/sweetalert2.all.min.js'></script>

<!-- hapus data -->
<script>

  $(document).on('click','#hapus', function(){
    var id = $(this).data('hapus');
    Swal.fire({
      title: 'Hapus Data ?',
      text: "Data Ini Akan Terhapus Dari Data E-KTP !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php?page=data-ektp&id='+id;
      }
    })
});

</script>

<!-- telah foto -->
<script>

  $(document).on('click','#foto', function(){
    var id = $(this).data('foto')
    Swal.fire({
      text: "Aktifkan Cetang Bahwa Data Ini Telah Foto",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php?page=data-ektp&foto='+id;
      }
    })
});

</script>

<!-- telah foto -->
<script>

  $(document).on('click','#fotobatal', function(){
    var id = $(this).data('fotobatal')
    Swal.fire({
      text: "Batalkan Foto",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'index.php?page=data-ektp&fotobatal='+id;
      }
    })
});

</script>
