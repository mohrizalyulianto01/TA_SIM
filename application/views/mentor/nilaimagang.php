<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h3>Nilai Magang dan Sertifikat</h3>
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
                  <!--<form id="filterForm" action="<?= base_url('lihatcatatan/filterlaporan') ?>" method="post">
                   
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
                      <th>Nilai</th>
                      <th>Sertifikat</th>
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
                          <td><?= date('d-m-Y', strtotime($nilai['tgl_buat'])) ?></td>
                          <td><?= $nilai['total_nilai'] ?></td>
                          <?php if($nilai['sertifikat_file'] != null) { ?>
                          <td><center><a href="<?= base_url('lihatcatatan/downloadFile/') . $nilai['id_nilai']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                        <?php }else{ ?>
                          <td><center><?php echo "Sertifikat belum diupload" ?></center></td>
                        <?php } ?>
                          <td><center>
                            <a class="" href="" data-toggle="modal" data-target="#edit<?= $nilai['id_nilai'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                            <!-- <button class="btn-s btn-light delete-btn" data-url="<?= base_url('lihatcatatan/delete/') . $nilai['id_nilai']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button> -->
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

 <?php foreach ($sertifikat as $nilai) : ?>
    <div class="modal fade" id="edit<?= $nilai['id_nilai'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Sertifikat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('penilaian/unilaimagang');?>
          <label for="">Sertifikat</label>
          <input type="hidden" name="id_nilai" value="<?= $nilai['id_nilai'] ?>">
          <input type="file" name="sertifikat_file" accept=".pdf" class="form-control" required="">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<?php endforeach ?>

<!--   <?php foreach ($hari as $harian) : ?>
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
<?php endforeach ?> -->