<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3>Detail Nilai Peserta Magang</h3>
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
							<button class="btn btn-light float-sm-right" data-toggle="modal" data-target="#tambah">Tambah Nilai</button>
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
	<?php $ceknilai = $this->db->query("SELECT * FROM detail_nilai WHERE  id_peserta = " . $peserta['id_peserta']); 
	if ($ceknilai->num_rows() != 0) {
	$nilaiData = $ceknilai->row();
	?>
	<a href="<?php echo base_url('Penilaian/penilaian/'); ?><?= $peserta['id_peserta']; ?>"><button class="btn-s btn-light">Detail</button></a>
<?php }else{ ?>
	<p>Belum ada nilai</p>
<?php } ?>
	
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
	<!-- END OF MODAL TAMBAH-->

		<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="VeirivikasiLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="EditKriteriaLabel">Edit Mentor</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('penilaian/nilai') ?>" method="post">
							<label for="">Nama Peserta</label>
							<select name="id_peserta" id="id_peserta" class="form-control" required="">
								<option value="">--Pilih Peserta--</option>
								<?php foreach($magang as $peserta) : ?>
									<option value="<?= $peserta['id_peserta'] ?>"><?= $peserta['nama_peserta']  ?></option>
							<?php endforeach ?>
							</select>
							<?php foreach($aspek as $aspek) : ?>
								<label><?= $aspek['aspek_penilaian'] ?></label>
								<input type="hidden" value="<?= $aspek['id_aspek'] ?>" name="id_aspek[]" id="id_aspek" required="">
								<input type="text" name="nilai[]" class="form-control" required="">
							<?php endforeach ?>

						</div>
						<div class="modal-footer justify-content-between">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit"  class="btn btn-primary">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>  