<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>

            </h1>
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
                <h3 class="card-title">
                  <form id="filterForm" action="<?= base_url('lihatcatatan/filterlaporan') ?>" method="post">
                    <?php foreach ($peserta as $peserta) : ?>
                    <input type="hidden" value="<?= $peserta['id_peserta'] ?>" name="id_peserta">
                    <input type="date" id="start_date" name="start_date" required>
                    <input type="date" id="end_date" name="end_date" required>
                     <?php endforeach ?>
                    <button type="submit">Filter</button>
                    <!-- <button onclick="generatePDF()">Download PDF</button> -->
                  </form>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <?php if (isset($harian)): ?>
                    <thead>
                      <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Catatan Harian</th>
                      <th>Catatan Mentor</th>
                      <th>Foto Kegiatan</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach($harian as $harian) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($harian['tgl_catatan'])) ?></td>
                          <td><?= $harian['catatan_harian'] ?></td>
                          <td><?= $harian['catatan_mentor'] ?></td>
                          <td><center><a href="<?= base_url('lihatcatatan/downloadFile/') . $harian['id_catatan_harian']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                          <td><center>
                            <a class="" href="" data-toggle="modal" data-target="#edit<?= $harian['id_catatan_harian'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                            <button class="btn-s btn-light delete-btn" data-url="<?= base_url('lihatcatatan/delete/') . $harian['id_catatan_harian']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                          </center></td>
                        </tr>
                      <?php endforeach ?>
                  </tbody>
                  </table>
                <?php endif; ?>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php foreach ($hari as $harian) : ?>
  <div class="modal fade" id="edit<?= $harian['id_catatan_harian']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lihatcatatan/update');?>
          <label for="">Catatan</label>
          <input type="hidden" name="id_catatan_harian" value="<?= $harian['id_catatan_harian'] ?>" id="">
          <textarea name="catatan_mentor" id="" cols="30" rows="10"  class="form-control"><?= $harian['catatan_mentor'] ?></textarea>
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

