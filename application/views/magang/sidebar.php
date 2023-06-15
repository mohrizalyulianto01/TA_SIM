<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: " >
  <!-- Brand Logo -->
<!--   <a href="<?= base_url('assets/') ?>index3.html" class="brand-link">
    <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a> -->

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/') ?>dist/img/man.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('nama_peserta') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= base_url('peserta') ?>" class="nav-link <?php echo (current_url() == base_url('peserta')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('presensi') ?>" class="nav-link <?php echo (current_url() == base_url('presensi')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Presensi Magang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('presensi/history') ?>" class="nav-link <?php echo (current_url() == base_url('presensi/history')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-history"></i>
              <p>
                History Magang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('laporanharian') ?>" class="nav-link <?php echo (current_url() == base_url('laporanharian')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Catatan Harian Magang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('laporanhasil') ?>" class="nav-link <?php echo (current_url() == base_url('laporanhasil')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Laporan Hasil Magang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('datanilai') ?>" class="nav-link <?php echo (current_url() == base_url('datanilai')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Nilai Hasil Magang
              </p>
            </a>
          </li>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          </div>
          <li class="nav-item">
            <a href="<?= base_url('loginpeserta/logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>