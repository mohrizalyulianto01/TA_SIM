<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Nilai Peserta Magang</h1>
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
                 <!--  <form id="filterForm" action="<?= base_url('datalaporan/filterlaporan') ?>" method="post">
                    <?php foreach ($peserta as $peserta) : ?>
                    <input type="hidden" value="<?= $peserta['id_peserta'] ?>" name="id_peserta">
                    <?php endforeach ?>
                    <input type="date" id="start_date" name="start_date" required>
                    <input type="date" id="end_date" name="end_date" required>
                    <button type="submit">Filter</button>
                    <button onclick="generatePDF()">Download PDF</button> -->
                  </form> 
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Aspek</th>
                      <th>Nilai</th>
                      <th>Batas Nilai</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach($nilai as $nilai) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $nilai['aspek_penilaian'] ?></td>
                          <td><?= $nilai['nilai'] ?></td>
                          <td><?= $nilai['batas_nilai'] ?></td>
                          <td><center>
                            <a class="" href="" data-toggle="modal" data-target="#edit<?= $nilai['id_detail_nilai'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                            <button class="btn-s btn-light delete-btn" data-url="<?= base_url('penilaian/delete/') . $nilai['id_peserta']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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

  <?php foreach ($penilaian as $nilai) : ?>
  <div class="modal fade" id="edit<?= $nilai['id_detail_nilai']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Catatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <?php echo form_open_multipart('penilaian/update');?>
          <label for=""><?= $nilai['aspek_penilaian'] ?></label>
          <input type="hidden" name="id_detail_nilai" value="<?= $nilai['id_detail_nilai'] ?>">
          <input type="hidden" name="id_aspek" value="<?= $nilai['id_aspek'] ?>">
          <input type="text" name="nilai" id="nilai" value="<?= $nilai['nilai'] ?>" class="form-control">
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