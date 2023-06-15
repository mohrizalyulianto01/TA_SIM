<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3>Data Presensi Peserta Magang</h3>
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
													<a href="<?php echo base_url('lihatpresensi/absen/'); ?><?= $peserta['id_peserta']; ?>" class="btn btn-light btn-sm">Detail</a>
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