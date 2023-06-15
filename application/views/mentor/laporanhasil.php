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
                <h3 class="card-title">
                 <!-- <form id="filterForm" action="<?= base_url('datalaporan/filterlaporan') ?>" method="post">
                    <?php foreach ($peserta as $peserta) : ?>
                    <input type="hidden" value="<?= $peserta['id_peserta'] ?>" name="id_peserta">
                    <?php endforeach ?>
                    <input type="date" id="start_date" name="start_date" required>
                    <input type="date" id="end_date" name="end_date" required>
                    <button type="submit">Filter</button>
                     <button onclick="generatePDF()">Download PDF</button> 
                  </form>-->
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Laporan</th>
                      <th>Catatan Mentor</th>
                      <th>File</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach($laporan as $laporan) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($laporan['tgl_buat'])) ?></td>
                          <td><?= $laporan['laporan_hasil'] ?></td>
                          <td><?= $laporan['catatan_hasil_mentor'] ?></td>
                          <td><center><a href="<?= base_url('lihatlaporan/downloadFile/') . $laporan['id_laporan_hasil']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                          <td><?= $laporan['status'] ?></td>
                          <td><center>
                            <a class="" href="" data-toggle="modal" data-target="#edit<?= $laporan['id_laporan_hasil'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                            <button class="btn-s btn-light delete-btn" data-url="<?= base_url('lihatlaporan/delete/') . $laporan['id_laporan_hasil']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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

  <?php foreach ($lapor as $laporan) : ?>
  <div class="modal fade" id="edit<?= $laporan['id_laporan_hasil']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('lihatlaporan/update');?>
          <label for="">Catatan</label>
          <input type="hidden" name="id_laporan_hasil" value="<?= $laporan['id_laporan_hasil'] ?>" id="">
          <textarea name="catatan_hasil_mentor" id="" cols="30" rows="10"  class="form-control"><?= $laporan['catatan_hasil_mentor'] ?></textarea>
          <label>Status</label>
          <select name="status" id="" class="form-control">
            <?php if($laporan['status'] == "Revisi") { ?>
            <option value="Revisi">Tidak Berubah</option>
            <option value="Diterima">Diterima</option>
          <?php }elseif($laporan['status'] == "Diterima"){ ?>
            <option value="Diterima">Tidak Berubah</option>
            <option value="Revisi">Revisi</option>
          <?php } ?>
          </select>
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