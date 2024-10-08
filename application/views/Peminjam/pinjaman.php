<section class="product spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="trending__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>Buku Dipesan</h4>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if ($pesan == NULL) { ?>
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__text">

										<h5 style="color:white;"><a>Anda Belum Memiliki Pesanan</a></h5>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php foreach ($pesan as $a) { ?>
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__pic set-bg" data-setbg="<?= base_url('assets/upload/' . $a->foto) ?>">
										<?php if ($this->model->IsKoleksi($a->buku_id) == NULL) { ?>
											<div class="ep"><a style="text-decoration: none; color:white;" href="<?= base_url('Peminjam/insert_favorit/' . $a->buku_id) ?>"><i class="fa fa-bookmark-o"></i> Favorit</a></div>
										<?php } else { ?>
											<div class="ep"><a href="<?= base_url('Peminjam/delete_favorit/' . $a->buku_id) ?>" style="text-decoration: none; color:white;"><i class="fa fa-bookmark"></i> Sudah Favorit</a></div>
										<?php } ?>
									</div>
									<div class="product__item__text">
										<ul>
											<?php foreach ($this->model->get_relasi($a->buku_id) as $k) { ?>
												<li><?= $k->kategori ?></li>
											<?php } ?>
										</ul>

										<h5><a href="<?= base_url('Peminjam/buku_detail/' . $a->buku_id) ?>"><?= $a->judul ?></a></h5>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="trending__product">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-8">
							<div class="section-title">
								<h4>Buku Yang sedang Dipinjam</h4>
							</div>
						</div>
					</div>
					<div class="row">
						<?php if ($pinjam == NULL) { ?>
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__text">

										<h5 style="color:white;"><a>Anda Belum Memiliki Pinjaman</a></h5>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php foreach ($pinjam as $a) { ?>
							<div class="col-lg-4 col-md-6 col-sm-6">
								<div class="product__item">
									<div class="product__item__pic set-bg" data-setbg="<?= base_url('assets/upload/' . $a->foto) ?>">
										<?php if ($this->model->IsKoleksi($a->buku_id) == NULL) { ?>
											<div class="ep"><a style="text-decoration: none; color:white;" href="<?= base_url('Peminjam/insert_favorit/' . $a->buku_id) ?>"><i class="fa fa-bookmark-o"></i> Favorit</a></div>
										<?php } else { ?>
											<div class="ep"><a href="<?= base_url('Peminjam/delete_favorit/' . $a->buku_id) ?>" style="text-decoration: none; color:white;"><i class="fa fa-bookmark"></i> Sudah Favorit</a></div>
										<?php } ?>
									</div>
									<div class="product__item__text">
										<ul>
											<?php foreach ($this->model->get_relasi($a->buku_id) as $k) { ?>
												<li><?= $k->kategori ?></li>
											<?php } ?>
										</ul>
										<h5><a href="<?= base_url('Peminjam/buku_detail/' . $a->buku_id) ?>"><?= $a->judul ?></a></h5>
										<p style="color:white">Batas Waktu : <?= $a->batas_waktu ?></p>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>

</section>
