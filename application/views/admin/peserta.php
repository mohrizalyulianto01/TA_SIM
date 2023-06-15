<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Peserta</h1>
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
              <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Peserta</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    $no = 1;
                    foreach($peserta as $peserta) :
                     ?>
                     <td><?= $no++ ?></td>
                     <td><?= $peserta['nama_peserta']  ?></td>
                     <td><?= date('d-m-Y', strtotime($peserta['tgl_lahir'])) ?></td>
                     <td><?= $peserta['alamat'] ?></td>
                     <td><?= $peserta['no_telp'] ?></td>
                     <td><center>
                          <a class="" href="" data-toggle="modal" data-target="#edit<?= $peserta['id_peserta'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                          <button class="btn-s btn-light delete-btn" data-url="<?= base_url('datapeserta/delete/') . $peserta['id_peserta']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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
        <h4 class="modal-title">Tambah Peserta</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('datapeserta/tambah') ?>" method="post">
          <label for="">Nama Peserta</label>
          <input type="text" name="nama_peserta" id="nama_peserta" class="form-control mb-2">
          <label for="">Tanggal lahir</label>
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-2">
          <label for="">Alamat</label>
          <input type="text" name="alamat" id="alamat" class="form-control mb-2">
          <label>No Telepon</label>
          <input type="text" name="no_telp" id="no_telp" class="form-control mb-2">
          <label>Username</label>
          <input type="text" name="username" id="username" class="form-control mb-2">
          <label>Password</label>
          <input type="text" name="password" id="password" class="form-control mb-2">
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

<?php foreach ($magang as $peserta) : ?>
  <div class="modal fade" id="edit<?= $peserta['id_peserta']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Peserta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('datapeserta/update') ?>" method="post">
          <label for="">Nama Mentor</label>
          <input type="hidden" name="id_peserta" value="<?= $peserta['id_peserta'] ?>" id="">
          <input type="text" name="nama_peserta" id="nama_peserta" class="form-control mb-2" value="<?= $peserta['nama_peserta'] ?>">
          <label for="">Tanggal lahir</label>
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-2" value="<?= $peserta['tgl_lahir'] ?>">
          <label for="">Alamat</label>
          <input type="text" name="alamat" id="alamat" class="form-control mb-2" value="<?= $peserta['alamat'] ?>">
          <label>No Telepon</label>
          <input type="text" name="no_telp" id="no_telp" class="form-control mb-2" value="<?= $peserta['no_telp'] ?>">
          <label>Username</label>
          <input type="text" name="username" id="username" class="form-control mb-2" value="<?= $peserta['username'] ?>">
          <label>Password</label>
          <input type="text" name="password" id="password" class="form-control mb-2">
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


