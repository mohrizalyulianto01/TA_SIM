<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Divisi</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Divisi</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Divisi</th>
                    <th><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    $no = 1;
                    foreach($divisi as $divisi) :
                     ?>
                     <td><?= $no++ ?></td>
                     <td><?= $divisi['nama_divisi']  ?></td>
                     <td><center>
                      <a class="" href="" data-toggle="modal" data-target="#edit<?= $divisi['id_divisi'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                      <button class="btn-s btn-light delete-btn" data-url="<?= base_url('divisi/delete/') . $divisi['id_divisi']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
                    </center></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL TAMBAH -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah divisi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('divisi/tambah') ?>" method="post">
          <label for="">Nama divisi</label>
          <input type="text" name="nama_divisi" id="nama_divisi" class="form-control mb-2">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- END OF MODAL TAMBAH-->

<!-- MODAL -->
<?php foreach ($div as $divisi) : ?>
  <div class="modal fade" id="edit<?= $divisi['id_divisi']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Divisi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('divisi/update') ?>" method="post">
          <label for="">Nama divisi</label>
          <input type="hidden" name="id_divisi" value="<?= $divisi['id_divisi'] ?>">
          <input type="text" name="nama_divisi" id="nama_divisi" value="<?= $divisi['nama_divisi'] ?>" class="form-control mb-2">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>  
<?php endforeach ?>

