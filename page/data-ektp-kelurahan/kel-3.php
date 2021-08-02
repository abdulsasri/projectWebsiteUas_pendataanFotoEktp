
          <div class="section-header">
            <h1><i class="fas fa-id-card mr-2" style="font-size: 20pt;"></i>Pendataan Data E-Ktp Kelurahan 3</h1>
          </div>
          
          <div class="card">
            <div class="row">
              <div class="card-header">
                 <div class="col-sm-6">
                    Table Data Masyarakat
                 </div>
                 <div class="col-sm-6 d-flex justify-content-end">
                    <!-- <a href="index.php?page=tambah-ektp" class="btn btn-primary">Tambah Data</a> -->
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
                        </tr>
                    </thead>
                    <tbody>
                      <?php $dataEktp = mysqli_query($con, "SELECT * FROM masyarakat WHERE kelurahan = 'Kelurahan 3' ORDER BY nama"); ?>
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
                        </tr>
                      <?php $no++; ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>

