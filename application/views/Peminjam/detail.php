<section class="anime-details spad">
	<div class="container">
		<?php foreach ($buku as $a) { ?>
			<div class="anime__details__content">
				<div class="row">
					<div class="col-lg-3">
						<div class="anime__details__pic set-bg" data-setbg="<?= base_url('assets/upload/' . $a->foto) ?>">
						</div>
					</div>
					<div class="col-lg-9">
						<div class="anime__details__text">
							<div class="anime__details__title">
							<div class="anime__details__rating">
								<?php foreach($this->model->average($a->buku_id) as $s){ ?>
                                <span style="margin-left:13%;color:yellow;"><?=number_format($s->rating)?>/5 </span><i class="fa fa-star" style="color:white;margin-left:5px;"></i>
								<?php }?>
                            </div>
								<h3><?= $a->judul ?></h3>
								<span><?= $a->penulis ?></span>
							</div>

							<p>"<?= $a->sinopsis ?>"</p>
							<div class="anime__details__widget">
								<div class="row">
									<div class="col-lg-6 col-md-6">
										<ul>
											<li><span>Penulis:</span> <?= $a->penulis ?></li>
											<li><span>Penerbit:</span> <?= $a->penerbit ?></li>
											<li><span>Tahun Terbit:</span> <?= $a->tahun_terbit ?></li>
											<li><span>Stok: </span> <?= $a->stok ?></li>
											<li><span>Genre:</span> <?php foreach ($this->model->get_relasi($a->buku_id) as $k) {
																		echo $k->kategori . ', ';
																	} ?></li>
										</ul>
									</div>

								</div>
							</div>
							<div class="anime__details__btn">
								<?php if ($this->model->IsKoleksi($a->buku_id) == NULL) { ?>
									<a href="<?= base_url('Peminjam/insert_favorit/' . $a->buku_id) ?>" class="follow-btn"><i class="fa fa-heart-o"></i> Koleksi</a>
								<?php } else { ?>
									<a href="<?= base_url('Peminjam/delete_favorite/' . $a->buku_id) ?>" class="follow-btn"><i class="fa fa-heart"></i> Hapus</a>
								<?php } ?>
								<?php if ($a->stok == 0) { ?>
								<?php } elseif ($this->model->IsDipinjam($a->buku_id) != NULL) { ?>
									<button disabled class="site-btn rounded-pill mx-auto">Sedang Dipinjam</button>
								<?php } elseif ($this->model->isDipesan($a->buku_id) == NULL) { ?>
									<a href="<?= base_url('Peminjam/pinjam/' . $a->buku_id) ?>" class="site-btn rounded-pill mx-auto"> + Pinjam</a>
								<?php } else { ?>
									<a href="<?= base_url('Peminjam/batal_pinjam/' . $a->buku_id) ?>" class="site-btn rounded-pill mx-auto"> X Batalkan</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-8">
					<div class="anime__details__review">

						<div class="anime__details__form">
							<div class="section-title">
								<h5>Your Comment</h5>
							</div>
							<form action="<?= base_url('Peminjam/insert_komen') ?>" method="post">
								<select name="rating" id="" class="mb-3">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<textarea placeholder="Your Comment" name="ulasan"></textarea>
								<input type="hidden" name="buku_id" value="<?= $a->buku_id ?>">
								<button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
							</form>
						</div>
					</div>
					<div class="section-title">
						<h5>Reviews</h5>
					</div>
					<?php foreach ($this->model->get_komen($a->buku_id) as $k) { ?>
						<div class="anime__review__item">
							<div class="anime__review__item__text">
								<h6>@<?= $k->username ?> - <span><?= $k->tanggal ?></span><span> <?php if ($k->user_id == $this->session->userdata('user_id')) { ?><a onclick="return confirm('yakin ingin menghapus komentar?')" href="<?= base_url('Peminjam/delete_komen/' . $k->ulasan_id) ?>"><i class="fa fa-trash" style="color:white;margin-left:80%;"></a></i></span><span></span><?php } ?></h6>
								<p><?= $k->ulasan ?></p>
							</div>
							
						</div>
					<?php } ?>

				</div>

			</div>
		<?php } ?>
</section>
