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
	Tambah User
</button>
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel1">Tambah User</h5>
				<button
					type="button"
					class="btn-close"
					data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('Admin/insert_user') ?>" method="post">
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailBasic" class="form-label">Nama</label>
							<input type="text" required id="emailBasic" name="nama" class="form-control" placeholder="Masukkan Nama" />
						</div>
						<div class="col mb-0">
							<label for="dobBasic" class="form-label">Username</label>
							<input type="text" required id="dobBasic" class="form-control" name="username" placeholder="" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailBasic" class="form-label">Email</label>
							<input type="email" required id="emailBasic" name="email" class="form-control" placeholder="xxxx@xxx.xx" />
						</div>
						<div class="col mb-0">
							<label for="dobBasic" class="form-label">Password</label>
							<input type="password" name="password" required id="dobBasic" class="form-control" placeholder="" />
						</div>
					</div>
					<div class="row g-2">
						<div class="col mb-0">
							<label for="emailBasic" class="form-label">Role</label>
							<select name="role" class="form-control" id="">
								<option value="peminjam">Peminjam</option>
								<option value="admin">Admin</option>
								<option value="petugas">Petugas</option>
							</select>
						</div>
						<div class="col mb-0">
							<label for="dobBasic" class="form-label">Alamat</label>
							<textarea name="alamat" class="form-control" id=""></textarea>
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
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="table-border-bottom-0">
				<?php $no = 0;
				foreach ($user as $a) { ?>
					<tr>
						<td><?= ++$no ?></td>
						<td><?= $a->username ?></td>
						<td><?= $a->nama ?></td>
						<td><?= $a->email ?></td>
						<td><?= $a->role ?></td>
						<td><a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $a->user_id ?>"><i class="bx bx-edit-alt me-1"></i></a> <a onclick="return confirm('Apakah Anda Yakin ingin menghapus user ini???')" href="<?= base_url('Admin/delete_user/' . $a->user_id) ?>"><i class="bx bx-trash-alt me-1"></i></a></td>
					</tr>
					<div class="modal fade" id="edit<?=$a->user_id?>" tabindex="-1" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel1">Edit User "<?=$a->username?>"</h5>
									<button
										type="button"
										class="btn-close"
										data-bs-dismiss="modal"
										aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form action="<?= base_url('Admin/update_user') ?>" method="post">
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailBasic" class="form-label">Nama</label>
												<input type="text" required id="emailBasic" value="<?=$a->nama?>" name="nama" class="form-control" placeholder="Masukkan Nama" />
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Username</label>
												<input type="text" required id="dobBasic" value="<?=$a->username?>" readonly class="form-control" name="username" placeholder="" />
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailBasic" class="form-label">Email</label>
												<input type="email" required id="emailBasic" value="<?=$a->email?>" name="email" class="form-control" placeholder="xxxx@xxx.xx" />
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Password</label>
												<input type="password"  id="dobBasic" name="password"  class="form-control" placeholder="" />
											</div>
										</div>
										<div class="row g-2">
											<div class="col mb-0">
												<label for="emailBasic" class="form-label">Role</label>
												<select name="role" class="form-control" id="">
													<option <?php if($a->role == 'peminjam'){echo 'selected';}?> value="peminjam">Peminjam</option>
													<option <?php if($a->role == 'admin'){echo 'selected';}?> value="admin">Admin</option>
													<option <?php if($a->role == 'petugas'){echo 'selected';}?> value="petugas">Petugas</option>
												</select>
											</div>
											<div class="col mb-0">
												<label for="dobBasic" class="form-label">Alamat</label>
												<textarea name="alamat" class="form-control" id=""><?=$a->alamat?></textarea>
												<input type="hidden" value="<?=$a->user_id?>" name="user_id">
												<input type="hidden" value="<?=$a->password?>" name="passwordlama">

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
