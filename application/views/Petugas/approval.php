<div class="card">
	<div class="card-body">
		<button
			type="button"
			data-bs-toggle="modal"
			data-bs-target="#basicModal"
			class="btn btn-primary mb-4">
			Print Laporan

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
						<form action="<?= base_url('Petugas/cetak_laporan') ?>" target="_blank" method="post">
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
							<div class="row g-2 mx-auto mt-2">
								<div class="form-check">
									<input class="form-check-input" value="dipesan" name="status[]" type="checkbox" id="defaultCheck2">
									<label class="form-check-label" for="defaultCheck2">Dipesan</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" value="dipinjam" name="status[]" type="checkbox" id="defaultCheck2">
									<label class="form-check-label" for="defaultCheck2">Dipinjam</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" value="dikembalikan" name="status[]" type="checkbox" id="defaultCheck2">
									<label class="form-check-label" for="defaultCheck2">Dikembalikan</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" value="ditolak" name="status[]" type="checkbox" id="defaultCheck2">
									<label class="form-check-label" for="defaultCheck2">Ditolak</label>
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
		<p class="demo-inline-spacing">
			<a
				class="btn btn-primary me-1"
				data-bs-toggle="collapse"
				href="#collapseExample"
				role="button"
				aria-expanded="false"
				aria-controls="collapseExample">
				Buku Dipesan
			</a>
			<button
				class="btn btn-primary me-1"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#collaps2"
				aria-expanded="false"
				aria-controls="collaps2">
				Buku Dipinjam
			</button>
			<button
				class="btn btn-primary me-1"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#collaps3"
				aria-expanded="false"
				aria-controls="collaps3">
				Histori
			</button>
		</p>
	</div>
</div>
<div class="collapse mt-2" id="collapseExample">
	<div class="card">
		<h5 class="card-header">Tabel User</h5>
		<div class="table-responsive text-nowrap">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Dipesan Oleh</th>
						<th>Stok</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody class="table-border-bottom-0">
					<?php $no = 0;
					foreach ($dipesan as $a) { ?>
						<tr>
							<td><?= ++$no ?></td>
							<td><?= $a->judul ?></td>
							<td><?= $a->username ?></td>
							<td><?= $a->stok ?></td>
							<td><a href="<?= base_url('Petugas/approve/' . $a->peminjaman_id) ?>" class="btn btn-success">Approve</a><a href="<?= base_url('Petugas/tolak/' . $a->peminjaman_id) ?>" class="btn btn-danger mx-2">Tolak</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="collapse mt-2" id="collaps2">
	<div class="card">
		<h5 class="card-header">Tabel User</h5>
		<div class="table-responsive text-nowrap">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Dipesan Oleh</th>
						<th>Disetujui Oleh</th>
						<th>Stok</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody class="table-border-bottom-0">
					<?php $no = 0;
					foreach ($dipinjam as $a) { ?>
						<tr>
							<td><?= ++$no ?></td>
							<td><?= $a->judul ?></td>
							<td><?= $a->peminjam_username ?></td>
							<td><?= $a->petugas_username ?></td>
							<td><?= $a->stok ?></td>
							<td><a href="<?= base_url('Petugas/kembali/' . $a->peminjaman_id) ?>" class="btn btn-primary">Kembalikan</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="collapse mt-2" id="collaps3">
	<div class="card">
		<h5 class="card-header">Tabel User</h5>
		<div class="table-responsive text-nowrap">
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Dipesan Oleh</th>
						<th>Disetujui Oleh</th>
						<th>Stok</th>
						<th>Denda</th>
						<th>Status</th>

					</tr>
				</thead>
				<tbody class="table-border-bottom-0">
					<?php $no = 0;
					foreach ($history as $a) { ?>
						<tr>
							<td><?= ++$no ?></td>
							<td><?= $a->judul ?></td>
							<td><?= $a->peminjam_username ?></td>
							<td><?= $a->petugas_username ?></td>
							<td><?= $a->stok ?></td>
							<td> Rp. <?= number_format($a->denda) ?></td>
							<td><?= $a->status_peminjaman ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
