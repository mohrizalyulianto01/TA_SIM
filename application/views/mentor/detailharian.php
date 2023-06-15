<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3>Data Laporan Harian Peserta Magang</h3>
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
							<!-- <a class="" href="" data-toggle="modal" data-target="#Tambah"><button class="btn-s btn-light"><i class="nav-icon fas fa-edit"></i></button></a> -->
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Peserta</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php foreach ($peserta as $peserta) : ?>
										<tr>
											<td><?= $i; ?></td>
											<td><?= $peserta['nama_peserta'];?></td>
									
											<td>
												<center>
													 <a class="" href="" data-toggle="modal" data-target="#edit<?= $peserta['id_peserta'] ?>"><button class="btn btn-light btn-sm">Tambah Tugas</i></button></a>
													<a href="<?php echo base_url('lihatcatatan/laporan/'); ?><?= $peserta['id_peserta']; ?>" class="btn btn-outline-light btn-sm">Detail</a>
												</center>
											</td>
										</tr>
										<?php $i++; ?>  
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

  <!-- /.content-wrapper -->
<?php foreach ($magang as $peserta) : ?>
  <div class="modal fade" id="edit<?= $peserta['id_peserta'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Catatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart('lihatcatatan/tambah');?>
          <input type="hidden" name="id_peserta" id="" value="<?= $peserta['id_peserta'] ?>">
          <label for="">Catatan</label>
          <textarea class="form-control" name="catatan_mentor" cols="30" rows="10"></textarea>
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
<?php endforeach ?>

<!--   <div class="modal fade" id="Tambah">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Catatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart('lihatcatatan/tambahbanyak');?>
          <label for="">Catatan</label>
          <textarea class="form-control" name="catatan_mentor" cols="30" rows="10"></textarea>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit"  class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div> -->