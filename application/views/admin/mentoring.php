<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Mentoring</h1>
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
              <button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mentor</th>
                    <th>Nama Peserta</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    $no = 1;
                    foreach($mentoring as $mentor) :
                     ?>
                     <td><?= $no++ ?></td>
                     <td><?= $mentor['nama_mentor']  ?></td>
                     <td><?= $mentor['nama_peserta'] ?></td>
                     <td><center>
                          <a class="" href="" data-toggle="modal" data-target="#edit<?= $mentor['id_detail_mentoring'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                          <button class="btn-s btn-light delete-btn" data-url="<?= base_url('datamentor/delete/') . $mentor['id_detail_mentoring']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('datamentor/tambahMentoring') ?>" method="post">
          <label for="">Nama Mentor</label>
          <select name="id_mentor" id="id_mentor" class="form-control">
            <option value="">Pilih Mentor</option>
            <?php foreach($tor as $mentor) : ?>
            <option value="<?= $mentor['id_mentor'] ?>"><?= $mentor['nama_mentor'] ?></option>
            <?php endforeach ?>
          </select>
          <label for="" class="mt-2">Nama Peserta</label>
          <select name="id_peserta" id="id_peserta" class="form-control">
            <option value="">Pilih Peserta</option>
            <?php foreach($peserta as $peserta) : ?>
            <option value="<?= $peserta['id_peserta'] ?>"><?= $peserta['nama_peserta'] ?></option>
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

<?php foreach ($mentoring as $mentoring) : ?>
  <div class="modal fade" id="edit<?= $mentoring['id_detail_mentoring']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('datamentor/updateMentoring') ?>" method="post">
          <label for="">Nama Mentor</label>
          <select name="id_mentor" id="id_mentor" class="form-control">
            <option value="<?= $mentoring['id_mentor'] ?>">Mentor : <?= $mentor['nama_mentor'] ?></option>
            <?php foreach($tor as $mentor) : ?>
            <option value="<?= $mentor['id_mentor'] ?>"><?= $mentor['nama_mentor'] ?></option>
            <?php endforeach ?>
          </select>
          <label for="" class="mt-2">Nama Peserta</label>
          <select name="id_peserta" id="id_peserta" class="form-control">
            <option value="<?= $mentoring['id_peserta'] ?>">Mentor : <?= $peserta['nama_peserta'] ?></option>
            <?php foreach($pes as $peserta) : ?>
            <option value="<?= $peserta['id_peserta'] ?>"><?= $peserta['nama_peserta'] ?></option>
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

