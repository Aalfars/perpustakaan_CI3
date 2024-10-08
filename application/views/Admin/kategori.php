<?php 
if($this->session->flashdata('alert')){
	echo $this->session->flashdata('alert');
}
?>
<button
	type="button"
	class="btn btn-primary mb-4"
	data-bs-toggle="modal"
	data-bs-target="#basicModal">
	Tambah Kategori
</button>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Tambah Kategori</h5>
				<button
					type="button"
					class="btn-close"
					data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('Admin/insert_kategori') ?>" method="post">
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailBasic" class="form-label">Kategori</label>
							<input type="text" required id="emailBasic" name="kategori" class="form-control" placeholder="Masukkan Nama" />
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
					<th>Kategori</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="table-border-bottom-0">
				<?php $no = 0;
				foreach ($kategori as $a) { ?>
					<tr>
						<td><?= ++$no ?></td>
						<td><?= $a->kategori ?></td>
						<td><a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $a->kategori_id ?>"><i class="bx bx-edit-alt me-1"></i></a> <a onclick="return confirm('Apakah Anda Yakin ingin menghapus kategori ini???')" href="<?= base_url('Admin/delete_kategori/' . $a->kategori_id) ?>"><i class="bx bx-trash-alt me-1"></i></a></td>
					</tr>
					<div class="modal fade" id="edit<?=$a->kategori_id?>" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel1">Edit User "<?=$a->kategori?>"</h5>
									<button
										type="button"
										class="btn-close"
										data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url('Admin/update_kategori') ?>" method="post">
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailBasic" class="form-label">Nama</label>
												<input type="text" required id="emailBasic" value="<?=$a->kategori?>" name="kategori" class="form-control" placeholder="Masukkan Nama" />
												<input type="hidden" name="kategori_id" value="<?=$a->kategori_id?>">
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
