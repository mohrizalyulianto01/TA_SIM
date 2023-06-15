<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <?php foreach($nilai as $nilai) : ?>
               <div class="inner">
                <h5>Total Nilai</h5>
                <h2><?= $nilai['total_nilai'] ?></h2>
              </div>
            </div>

          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <div class="inner">
                <h5>Nama Mentor</h5>
                <h2><?= $nilai['nama_mentor'] ?></h2>
              </div>
            </div>

          </div>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <div class="inner">
                <h5>Sertifikat</h5>
                <?php if($nilai['sertifikat_file'] != null) { ?>
                <a href="<?= base_url('datanilai/downloadFile/') . $nilai['id_nilai']; ?>"><h2>Download Sertifikat</h2></a>
              <?php }else{ ?>
                <?php echo "Sertifikat belum diupload" ?>
              <?php } ?>
              <center>
              </div>

            </div>
          <?php endforeach ?>
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

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Aspek</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach($detail as $detail) : 
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $detail['aspek_penilaian'] ?></td>
                      <td><?= $detail['nilai'] ?></td>
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