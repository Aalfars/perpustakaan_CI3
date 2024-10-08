<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Anime Template">
	<meta name="keywords" content="Anime, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?= $title ?></title>

	<!-- Google Font -->

	<!-- Css Styles -->
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/elegant-icons.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/plyr.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/nice-select.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/owl.carousel.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/slicknav.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url('assets/anime/') ?>css/style.css" type="text/css">
</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col-lg-2">
					<div class="header__logo">
						<h5>
							<a href="<?=base_url('Peminjam')?>" style="color:white;font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
								Perpus
							</a>
						</h5>
					</div>
				</div>
				<div class="col-lg-8">
					<div class="header__nav">
						<nav class="header__menu mobile-menu">
							<ul>
								<?php $url = $this->uri->segment('2') ?>
								<li class="<?php if ($url == '') {
												echo 'active';
											} ?>"><a href="<?= base_url('Peminjam/') ?>">Homepage</a></li>
								<li class="<?php if ($url == 'pinjaman') {
												echo 'active';
											} ?>"><a href="<?= base_url('Peminjam/pinjaman') ?>">Pinjaman</a></li>
								<li class="<?php if ($url == 'history') {
												echo 'active';
											} ?>"><a href="<?= base_url('Peminjam/history') ?>">History</a></li>
								<li class="<?php if ($url == 'favorit') {
												echo 'active';
											} ?>"><a href="<?= base_url('Peminjam/favorit') ?>">Favorit</a></li>




							</ul>
						</nav>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="header__right">
						<a href="#" class="search-switch"><span class="icon_search"></span></a>
					</div>
				</div>
			</div>
			<div id="mobile-menu-wrap"></div>
		</div>
	</header>
	<?= $contents ?>
	<footer class="footer">
		<div class="page-up">
			<a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="footer__logo">
						<a href="./index.html"><img src="img/logo.png" alt=""></a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="footer__nav">
						<ul>
							<li class=""><a href="<?= base_url('Peminjam/') ?>">Homepage</a></li>
							<li class=""><a href="<?= base_url('Peminjam/pinjaman') ?>">Pinjaman</a></li>
							<li class=""><a href="<?= base_url('Peminjam/history') ?>">History</a></li>
							<li class=""><a href="<?= base_url('Peminjam/favorit') ?>">Favorit</a></li>
							<li class=""><a style="color: red;" href="<?= base_url('Auth/logout') ?>">Log Out</a></li>


						</ul>
					</div>
				</div>
				<div class="col-lg-3">
					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Arupaa</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Section End -->

	<!-- Search model Begin -->
	<div class="search-model">
		<div class="h-100 d-flex align-items-center justify-content-center">
			<div class="search-close-switch"><i class="icon_close"></i></div>
			<form class="search-model-form" action="<?= base_url('Peminjam/search') ?>" method="get">
				<input type="text" name="query" id="search-input" placeholder="Search here.....">
			</form>
		</div>
	</div>
	<!-- Search model end -->

	<!-- Js Plugins -->
	<script src="<?= base_url('assets/anime/') ?>js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/player.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/jquery.nice-select.min.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/mixitup.min.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/jquery.slicknav.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/owl.carousel.min.js"></script>
	<script src="<?= base_url('assets/anime/') ?>js/main.js"></script>


</body>

</html>
