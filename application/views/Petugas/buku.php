<?php
if ($this->session->flashdata('alert')) {
	echo $this->session->flashdata('alert');
}
?>
<button
	type="button"
	class="btn btn-primary mb-4"
	data-bs-toggle="modal"
	data-bs-target="#basicModal">
	Tambah Buku
</button>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel3">Tambah Buku</h5>
				<button
					type="button"
					class="btn-close"
					data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('Petugas/insert_buku') ?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col mb-3">
							<label for="nameLarge" class="form-label">Judul</label>
							<input type="text" name="judul" id="nameLarge" class="form-control" placeholder="Masukkan Judul" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailLarge" class="form-label">Penulis</label>
							<input type="text" name="penulis" id="emailLarge" class="form-control" />
						</div>
						<div class="col mb-0">
							<label for="dobLarge" class="form-label">Penerbit</label>
							<input type="text" name="penerbit" id="dobLarge" class="form-control" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailLarge" class="form-label">Tahun Terbit</label>
							<input type="number" name="tahun_terbit" id="emailLarge" class="form-control" />
						</div>
						<div class="col mb-0">
							<label for="dobLarge" class="form-label">Stok</label>
							<input type="number" name="stok" id="dobLarge" class="form-control" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailLarge" class="form-label">Kategori</label>
							<?php foreach ($kategori as $k) { ?>
								<div class="form-check">
									<input class="form-check-input" name="kategori[]" type="checkbox" value="<?= $k->kategori_id ?>" id="defaultCheck2">
									<label class="form-check-label" for="defaultCheck2"> <?= $k->kategori ?> </label>
								</div> <?php } ?>
						</div>
						<div class="col mb-0">
							<label for="dobLarge" class="form-label">Foto</label>
							<input type="file" name="foto" id="dobLarge" class="form-control" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailLarge" class="form-label">Sinopsis</label>
							<textarea name="sinopsis" class="form-control" id=""></textarea>
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
<div class="card">
	<h5 class="card-header">Tabel User</h5>
	<div class="table-responsive text-nowrap">
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Penulis</th>
					<th>Tahun Terbit</th>
					<th>Kategori</th>
					<th>Stok</th>
					<th>Action</th>

				</tr>
			</thead>
			<tbody class="table-border-bottom-0">
				<?php $no = 0;
				foreach ($buku as $a) { ?>
					<tr>
						<td><?= ++$no ?></td>
						<td><?= $a->judul ?></td>
						<td><?= $a->penulis ?></td>
						<td><?= $a->tahun_terbit ?></td>
						<td><?php foreach ($this->model->get_relasi($a->buku_id) as $s) {
								echo $s->kategori.', ';
							} ?> </td>
						<td><?= $a->stok ?></td>

						<td><a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $a->buku_id ?>"><i class="bx bx-edit-alt me-1"></i></a> <a onclick="return confirm('Apakah Anda Yakin ingin menghapus Buku ini???')" href="<?= base_url('Petugas/delete_buku/' . $a->buku_id) ?>"><i class="bx bx-trash-alt me-1"></i></a></td>
					</tr>
					<div class="modal fade" id="edit<?= $a->buku_id ?>" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel3">Edit Buku "<?= $a->judul ?>"</h5>
									<button
										type="button"
										class="btn-close"
										data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<form action="<?= base_url('Petugas/update_buku') ?>" method="post" enctype="multipart/form-data">
										<div class="col-mb-3">
											<img style="max-width:30%;max-height:30%;" src="<?= base_url('assets/upload/' . $a->foto) ?>" class="form-control mx-auto" alt="">
										</div>
										<div class="row">
											<div class="col mb-3">
												<label for="nameLarge" class="form-label">Judul</label>
												<input type="text" name="judul" value="<?=$a->judul?>" id="nameLarge" class="form-control" placeholder="Masukkan Judul" />
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailLarge" class="form-label">Penulis</label>
												<input type="text" name="penulis" value="<?=$a->penulis?>" id="emailLarge" class="form-control" />
											</div>
											<div class="col mb-0">
												<label for="dobLarge" class="form-label">Penerbit</label>
												<input type="text" name="penerbit" value="<?=$a->penerbit?>" id="dobLarge" class="form-control" />
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailLarge" class="form-label">Tahun Terbit</label>
												<input type="number" name="tahun_terbit" value="<?=$a->tahun_terbit?>" id="emailLarge" class="form-control" />
											</div>
											<div class="col mb-0">
												<label for="dobLarge" class="form-label">Stok</label>
												<input type="number" name="stok" id="dobLarge" value="<?=$a->stok?>" class="form-control" />
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailLarge" class="form-label">Kategori</label>
												<?php $relasi = array_column($this->model->get_relasi($a->buku_id),'kategori_id'); foreach ($kategori as $k) { ?>
													<p></p>
													<div class="form-check">
														<input class="form-check-input" <?=in_array($k->kategori_id, $relasi) ?  'checked': '';?>  name="kategori[]" type="checkbox" value="<?= $k->kategori_id ?>" id="defaultCheck2">
														<label class="form-check-label" for="defaultCheck2"> <?= $k->kategori ?> </label>
													</div> <?php } ?>
											</div>
											<div class="col mb-0">
												<label for="dobLarge" class="form-label">Foto</label>
												<input type="file" value="<?=base_url('assets/upload/'.$a->foto)?>" name="foto" id="dobLarge" class="form-control" />
												<input type="hidden" name="namafoto" value="<?=$a->foto?>">
												<input type="hidden" name="buku_id" value="<?=$a->buku_id?>">

											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailLarge" class="form-label">Sinopsis</label>
												<textarea name="sinopsis" class="form-control" id=""><?=$a->sinopsis?></textarea>
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
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
