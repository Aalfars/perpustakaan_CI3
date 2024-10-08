<div class="container-xxl flex-grow-1 container-p-y">
	<div class="row">
		<div class="col-lg-8 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-primary">Halo <?= $this->session->userdata('username') ?>! </h5>
							<p class="mb-4">
								Hari Ini Mau ngapain??
							</p>

						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img
								src="<?= base_url('assets/sneat/') ?>/assets/img/illustrations/man-with-laptop-light.png"
								height="140"
								alt="View Badge User"
								data-app-dark-img="illustrations/man-with-laptop-dark.png"
								data-app-light-img="illustrations/man-with-laptop-light.png" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Total Revenue -->

		<!--/ Total Revenue -->
		<div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
			<div class="row">
				<div class="col-12 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
								<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
									<div class="card-title">
										<h5 class="text-nowrap mb-2">Jumlah Buku</h5>
									</div>
									<div class="mt-sm-auto">
										<h3 class="mb-0"><?=$this->db->count_all_results('buku');?></h3>
									</div>
								</div>
								<div id="profileReportChart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<!-- Order Statistics -->
		<div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
			<div class="row">
				<div class="col-12 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
								<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
									<div class="card-title">
										<h5 class="text-nowrap mb-2">Jumlah User</h5>
									</div>
									<div class="mt-sm-auto">
										<h3 class="mb-0"><?=$this->db->count_all_results('users');?></h3>
									</div>
								</div>
								<div id="profileReportChart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Order Statistics -->

		<!-- Expense Overview -->
		<div class="col-md-6 col-lg-4 order-1 mb-4">
			<div class="row">
				<div class="col-12 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
								<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
									<div class="card-title">
										<h5 class="text-nowrap mb-2">Jumlah Kategori</h5>
									</div>
									<div class="mt-sm-auto">
										<h3 class="mb-0"><?=$this->db->count_all_results('kategori');?></h3>
									</div>
								</div>
								<div id="profileReportChart"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->

		<!-- Transactions -->
		<div class="col-md-6 col-lg-4 order-2 mb-4">
			<div class="row">
				<div class="col-12 mb-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
								<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
									<div class="card-title">
										<h5 class="text-nowrap mb-2">Jumlah Peminjaman </h5>
									</div>
									<div class="mt-sm-auto">
										<h3 class="mb-0"><?=$this->model->hitung_peminjaman()?></h3>
										<button
											type="button"
											class="btn btn-primary mt-2"
											data-bs-toggle="modal"
											data-bs-target="#basicModal">
											Cetak Laporan
										</button>
										<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel1">Pilih Periode</h5>
														<button
															type="button"
															class="btn-close"
															data-bs-dismiss="modal"
															aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form action="<?= base_url('Admin/cetak_laporan') ?>" target="_blank" method="post">
															<div class="row g-2">
																<div class="col mb-0">
																	<label for="emailBasic" class="form-label">Tanggal Awal</label>
																	<input type="date" required id="emailBasic" name="tanggal_awal" class="form-control" placeholder="Masukkan Nama" />
																</div>
																<div class="col mb-0">
																	<label for="emailBasic" class="form-label">Tanggal Akhir</label>
																	<input type="date" required id="emailBasic" name="tanggal_akhir" class="form-control" placeholder="Masukkan Nama" />
																</div>
															</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
															Close
														</button>
														<button type="submit" class="btn btn-primary">Save</button>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div id="profileReportChart"></div>
									</div>
									<table>
										
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ Transactions -->
			</div>
		</div>
	</div>
</div>
