<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Harian</h1>
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
<!--                 <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Catatan</button> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Mentor</th>
                      <th>Catatan</th>
                      <th>Catatan Mentor</th>
                      <th>Foto Kegiatan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach($catatan as $catatan) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($catatan['tgl_catatan'])) ?></td>
                          <td><?= $catatan['nama_mentor'] ?></td>
                          <td><?= $catatan['catatan_harian'] ?></td>
                          <td><?= $catatan['catatan_mentor'] ?></td>
                          <?php if($catatan['foto_kegiatan'] != null) { ?>
                          <td><center><a href="<?= base_url('laporanharian/downloadFile/') . $catatan['id_catatan_harian']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                        <?php }else{ ?>
                          <td><center><?= "Belum ada foto kegiatan" ?></center></td>
                        <?php } ?>
                          <td><center>
                          <a class="" href="" data-toggle="modal" data-target="#edit<?= $catatan['id_catatan_harian'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                          <!-- <button class="btn-s btn-light delete-btn" data-url="<?= base_url('laporanharian/delete/') . $catatan['id_catatan_harian']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button> -->
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
        <h4 class="modal-title">Tambah Catatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('laporanharian/tambah');?>
          <label for="">Catatan</label>
          <textarea class="form-control" name="catatan_harian" cols="30" rows="10"></textarea>
          <label>Foto Kegiatan</label>
          <input type="file" name="foto_kegiatan" class="form-control" accept=".jpg,.jpeg,.png" required="">
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

<?php foreach ($catat as $catatan) : ?>
  <div class="modal fade" id="edit<?= $catatan['id_catatan_harian']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('laporanharian/update');?>
          <label for="">Catatan</label>
          <input type="hidden" name="id_catatan_harian" value="<?= $catatan['id_catatan_harian'] ?>" id="">
          <textarea name="catatan_harian" id="" cols="30" rows="10"  class="form-control"><?= $catatan['catatan_harian'] ?></textarea>
          <label>Foto Kegiatan</label>
          <input type="file" name="foto_kegiatan" class="form-control" accept=".jpg,.jpeg,.png">
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