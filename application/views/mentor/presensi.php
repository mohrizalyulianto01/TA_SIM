<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
   <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Absensi</h1>
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
                 <!--  <form id="filterForm" action="<?= base_url('lihatpresensi/filterabsen') ?>" method="post">
                    <?php foreach ($peserta as $peserta) : ?>
                    <input type="hidden" value="<?= $peserta['id_peserta'] ?>" name="id_peserta">
                    <?php endforeach ?>
                    <input type="date" id="start_date" name="start_date" required>
                    <input type="date" id="end_date" name="end_date" required>
                    <button type="submit">Filter</button>
                    <button onclick="generatePDF()">Download PDF</button>
                  </form> -->
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach($absensi as $absensi) : 
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= date('d-m-Y', strtotime($absensi['tgl_absen'])) ?></td>
                          <td><?= $absensi['jam_masuk'] ?></td>
                          <td><?= $absensi['jam_keluar'] ?></td>
                          <td><?= $absensi['status_masuk'] ?></td>
                          <td><center>
                            <button class="btn-s btn-light delete-btn" data-url="<?= base_url('datapresensi/delete/') . $absensi['id_absen']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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