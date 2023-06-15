<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Mentor</h1>
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
              <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Mentor</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mentor</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    $no = 1;
                    foreach($mentor as $mentor) :
                     ?>
                     <td><?= $no++ ?></td>
                     <td><?= $mentor['nama_mentor']  ?></td>
                     <td><?= date('d-m-Y', strtotime($mentor['tgl_lahir'])) ?></td>
                     <td><?= $mentor['alamat'] ?></td>
                     <td><?= $mentor['no_telp'] ?></td>
                     <td><?php
                      $id_divisi = $mentor['id_divisi'];
                      $div = $this->db->get_where('divisi', array('id_divisi' => $id_divisi))->row_array();
                      echo $div['nama_divisi'];
                      ?></td>
                     <td><center>
                          <a class="" href="" data-toggle="modal" data-target="#edit<?= $mentor['id_mentor'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                          <button class="btn-s btn-light delete-btn" data-url="<?= base_url('datamentor/delete/') . $mentor['id_mentor']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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
        <h4 class="modal-title">Tambah Mentor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('datamentor/tambah') ?>" method="post">
          <label for="">Nama Mentor</label>
          <input type="text" name="nama_mentor" id="nama_mentor" class="form-control mb-2">
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
          <label>Divisi</label>
          <select name="id_divisi" id="id_divisi" class="form-control mb-2">
            <option value="">-- Pilih Divisi --</option>
            <?php foreach ($divisi as $row): ?>
              <option value="<?= $row['id_divisi'] ?>"><?= $row['nama_divisi'] ?></option>
            <?php endforeach ?>
          </select>

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

<?php foreach ($tor as $mentor) : ?>
  <div class="modal fade" id="edit<?= $mentor['id_mentor']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Mentor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('datamentor/update') ?>" method="post">
          <label for="">Nama Mentor</label>
          <input type="hidden" name="id_mentor" value="<?= $mentor['id_mentor'] ?>" id="">
          <input type="text" name="nama_mentor" id="nama_mentor" class="form-control mb-2" value="<?= $mentor['nama_mentor'] ?>">
          <label for="">Tanggal lahir</label>
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-2" value="<?= $mentor['tgl_lahir'] ?>">
          <label for="">Alamat</label>
          <input type="text" name="alamat" id="alamat" class="form-control mb-2" value="<?= $mentor['alamat'] ?>">
          <label>No Telepon</label>
          <input type="text" name="no_telp" id="no_telp" class="form-control mb-2" value="<?= $mentor['no_telp'] ?>">
          <label>Username</label>
          <input type="text" name="username" id="username" class="form-control mb-2" value="<?= $mentor['username'] ?>">
          <label>Password</label>
          <input type="text" name="password" id="password" class="form-control mb-2">
          <label>Divisi</label>
          <select name="id_divisi" id="id_divisi" class="form-control mb-2">
            <option value="<?= $mentor['id_divisi'] ?>">Divisi : <?= $div['nama_divisi'] ?></option>
            <?php foreach ($divisi as $row): ?>
              <option value="<?= $row['id_divisi'] ?>"><?= $row['nama_divisi'] ?></option>
            <?php endforeach ?>
          </select>

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

