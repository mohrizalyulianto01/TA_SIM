<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Hasil Magang</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Laporan Hasil</button>
                <h3 class="card-title">
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Mentor</th>
                      <th>Laporan Hasil</th>
                      <th>Catatan Mentor</th>
                      <th>File</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach($hasil as $hasil) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($hasil['tgl_buat'])) ?></td>
                          <td><?= $hasil['nama_mentor'] ?></td>
                          <td><?= $hasil['laporan_hasil'] ?></td>
                          <td><?= $hasil['catatan_hasil_mentor'] ?></td>
                          <td><center><a href="<?= base_url('laporanhasil/downloadFile/') . $hasil['id_laporan_hasil']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                          <td><?= $hasil['status'] ?></td>
                          <td><center>
                          <a class="" href="" data-toggle="modal" data-target="#edit<?= $hasil['id_laporan_hasil'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                          <button class="btn-s btn-light delete-btn" data-url="<?= base_url('laporanhasil/delete/') . $hasil['id_laporan_hasil']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                        </center></td>
                          
                        </tr>
                      <?php endforeach ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Laporan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('laporanhasil/tambah');?>
          <label for="">Laporan</label>
          <textarea class="form-control" name="laporan_hasil" cols="30" rows="10"></textarea>
          <label>File</label>
          <input type="file" name="file" class="form-control" required="" accept=".pdf">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php foreach ($hasil1 as $hasil) : ?>
  <div class="modal fade" id="edit<?= $hasil['id_laporan_hasil']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('laporanhasil/update');?>
          <label for="">Laporan Hasil</label>
          <input type="hidden" name="id_laporan_hasil" value="<?= $hasil['id_laporan_hasil'] ?>" id="">
          <textarea name="laporan_hasil" id="" cols="30" rows="10"  class="form-control"><?= $hasil['laporan_hasil'] ?></textarea>
          <label>File Laporan</label>
          <input type="file" name="file" class="form-control" accept=".pdf">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<?php endforeach ?>