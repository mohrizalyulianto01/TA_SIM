<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">

				</div>
				<div class="col-sm-6">

				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-12">
					<div class="info-box">
						<span class="info-box-icon bg-info"><i class="fas fa-clock"></i></span>
						<div class="info-box-content">
							<center><h1 id="clock"></h1></center>
						</div>

					</div>

				</div>

				<div class="col-md-3 col-sm-6 col-12">
					<div class="info-box">
						<span class="info-box-icon bg-success"><i class="fas fa-calendar"></i></span>
						<div class="info-box-content">
							<center><h1><?= date('d-m-y') ?></h1></center>
						</div>

					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<?php
					$cekabsen = $this->db->query("SELECT * FROM absensi a, peserta_magang b where a.id_peserta = b.id_peserta and a.id_peserta= ".$this->session->userdata('id_peserta'))->row();
					$jam = date('H:i:s');
					$hari_ini = date('Y-m-d');
					$cekabsen2 = $this->db->query("SELECT * FROM absensi WHERE tgl_absen = '$hari_ini' AND id_peserta = " . $this->session->userdata('id_peserta'));
					if ($cekabsen2->num_rows() != 0) {
						$absenData = $cekabsen2->row();

						if ($absenData->jam_keluar == '00:00:00') {
							if($jam < '16:00:00'){
								echo "					<div class='row'>
						<div class='col-md-12'>
						<div class='info-box'>
						<div class='info-box-content'>
							<center><h3>Belum Saatnya Pulang</h3></center>
							</div>
							</div>
						</div>
					</div>";
							}else{
							echo "<p>Absen Keluar</p>";
							?>
							<form method="post" action="<?php echo base_url('presensi/absen_selesai_act'); ?>">

								<button type="submit" class="btn btn-danger btn-circle" style="font-size: 20px; width: 100%; height: 100%">
									<i class="fas fa-fw fa-sign-in-alt fa-2x"></i>
								</button>
							</form>
							<?php } ?>
							<?php

						} else {
							echo "					<div class='row'>
						<div class='col-md-12'>
						<div class='info-box'>
						<div class='info-box-content'>
							<center><h3>Terima Kasih Atas Kehadirannya</h3></center>
							</div>
							</div>
						</div>
					</div>";
						}
					} else {
						?>
						<!-- Belum absen masuk -->
						<div class="row">
							<div class="col-md">
								<form method="post" action="<?php echo base_url('presensi/absen_act'); ?>">
									<label class="">Absen</label>
									<button type="submit" class="btn btn-info btn-circle mt-2" style="font-size: 20px; width: 100%; height: 100%">
										<i class="fas fa-fw fa-sign-in-alt fa-2x"></i>
									</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="" class="mt-3">Keterangan</label>
							<input type="textarea" id="keterangan" name="keterangan" class="form-control" style="height: 100px;width: 535px">
							</form>
						<?php } ?>
						</div>
					</div>
				</div>
			</section>
		</div>