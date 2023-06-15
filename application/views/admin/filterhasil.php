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
                  <form id="filterForm" action="<?= base_url('datalaporan/filterlaporan') ?>" method="post">
                    <?php foreach ($laporan as $abasensi => $value) :?>
                    <input type="hidden" name="id_peserta" value="<?= $value['id_peserta']  ?>">
                    <?php endforeach ?>
                    <input type="date" id="start_date" name="start_date" required>
                    <input type="date" id="end_date" name="end_date" required>
                    <button type="submit">Filter</button>
                    <!-- <button onclick="generatePDF()">Download PDF</button> -->
                  </form>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <?php if (isset($laporan)): ?>
                    <thead>
                      <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Mentor</th>
                      <th>Laporan</th>
                      <th>File Laporan</th>
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
                          <td><?= $laporan['nama_mentor'] ?></td>
                          <td><?= $laporan['laporan_hasil'] ?></td>
                          <td><center><a href="<?= base_url('datalaporan/downloadFile/') . $laporan['id_laporan_hasil']; ?>"><button  class="btn-s btn-light"><i class="fas fa-download"></i></button></a></center></td>
                          <td><center>
                            <button class="btn-s btn-light delete-btn" data-url="<?= base_url('datalaporan/delete/') . $laporan['id_laporan_hasil']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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

