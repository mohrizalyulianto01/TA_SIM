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
        <img src="<?= base_url('assets/') ?>dist/img/profile.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $this->session->userdata('nama_mentor') ?></a>
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
            <a href="<?= base_url('lihatpresensi') ?>" class="nav-link<?php echo (current_url() == base_url('lihatpresensi')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Lihat Data Presensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('lihatcatatan') ?>" class="nav-link <?php echo (current_url() == base_url('lihatcatatan')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan Harian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('lihatlaporan') ?>" class="nav-link <?php echo (current_url() == base_url('lihatlaporan')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Laporan Hasil Magang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('penilaian') ?>" class="nav-link <?php echo (current_url() == base_url('penilaian')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-star"></i>
              <p>Nilai</p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?= base_url('penilaian/lihatnilai') ?>" class="nav-link <?php echo (current_url() == base_url('penilaian/lihatnilai')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-certificate"></i>
              <p>Sertifikat</p>
            </a>
          </li>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          </div>
          <li class="nav-item">
            <a href="<?= base_url('loginmentor/logout') ?>" class="nav-link ">
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