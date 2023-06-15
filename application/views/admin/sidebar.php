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
        <img src="<?= base_url('assets/') ?>dist/img/login.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= base_url('admin') ?>" class="nav-link <?php echo (current_url() == base_url('admin')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link <?php echo (current_url() == base_url('datamentor')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Mentor
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
            <a href="<?= base_url('datamentor') ?>" class="nav-link <?php echo (current_url() == base_url('datamentor')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Data Mentor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('datamentor/mentoring') ?>" class="nav-link <?php echo (current_url() == base_url('datamentor/mentoring')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Data Mentoring
              </p>
            </a>
          </li>
               </ul>
          </li>
           
          <li class="nav-item">
            <a href="<?= base_url('datapeserta') ?>" class="nav-link <?php echo (current_url() == base_url('datapeserta')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Peserta Magang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('divisi') ?>" class="nav-link <?php echo (current_url() == base_url('divisi')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Data Divisi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('point') ?>" class="nav-link <?php echo (current_url() == base_url('point')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-star"></i>
              <p>
                Data Point Penilaian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('datapresensi') ?>" class="nav-link <?php echo (current_url() == base_url('datapresensi')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Data Presensi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dataharian') ?>" class="nav-link <?php echo (current_url() == base_url('dataharian')) ? 'active' : ''; ?>">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Laporan Harian
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= base_url('datalaporan') ?>" class="nav-link <?php echo (current_url() == base_url('datalaporan')) ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                Laporan Magang
              </p>
            </a>
          </li>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          </div>
          <li class="nav-item">
            <a href="<?= base_url('loginadmin/logout') ?>" class="nav-link">
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