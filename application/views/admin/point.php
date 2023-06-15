<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Point Penilaian</h1>
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
                    <th>Aspek Penilaian</th>
                    <th>Batas Nilai</th>
                    <th><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php 
                    $no = 1;
                    foreach($point as $point) :
                     ?>
                     <td><?= $no++ ?></td>
                     <td><?= $point['aspek_penilaian']  ?></td>
                     <td><?= $point['batas_nilai']  ?></td>
                     <td><center>
                      <a class="" href="" data-toggle="modal" data-target="#edit<?= $point['id_aspek'] ?>"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a>
                      <button class="btn-s btn-light delete-btn" data-url="<?= base_url('point/delete/') . $point['id_aspek']; ?>"><i class="nav-icon fas fa-trash-alt"></i></button>
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
        <h4 class="modal-title">Tambah Point Penilaian</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('point/tambah') ?>" method="post">
          <label for="">Aspek Penilaian</label>
          <input type="text" name="aspek_penilaian" id="aspek_penilaian" class="form-control mb-2">
          <label for="">Batas Nilai</label>
          <input type="text" name="batas_nilai" id="batas_nilai" class="form-control mb-2">
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
<?php foreach ($poin as $point) : ?>
  <div class="modal fade" id="edit<?= $point['id_aspek']; ?>" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditKriteriaLabel">Edit Point Penilaian</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="<?= base_url('point/update') ?>" method="post">
          <label for="">Aspek Penilaian</label>
          <input type="hidden" value="<?= $point['id_aspek'] ?>"  name="id_aspek"> 
          <input type="text" name="aspek_penilaian" id="aspek_penilaian" class="form-control mb-2" value="<?= $point['aspek_penilaian'] ?>">
          <label for="">Batas Nilai</label>
          <input type="text" name="batas_nilai" id="batas_nilai" class="form-control mb-2" value="<?= $point['batas_nilai'] ?>">
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

