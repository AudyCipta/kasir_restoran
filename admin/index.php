<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/dashboard.php'; ?>


<?php $title = 'Dashboard'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid py-3">
			<?php flash('message') ?>
			<h3>Dashboard</h3>
			<div class="form-row mb-2">
				<div class="col">
					<div class="card card-body d-flex justify-content-center align-items-center p-5">
						<h5 class="card-title mb-0"><?= $_SESSION['pengguna_level'] == 2 ? 'Pelanggan' : 'Pengguna' ?>: <?= mysqli_num_rows($pengguna_result) ?></h5>
					</div>
				</div>
				<div class="col">
					<div class="card card-body d-flex justify-content-center align-items-center p-5">
						<h5 class="card-title mb-0">Kategori: <?= mysqli_num_rows($kategori_result) ?></h5>
					</div>
				</div>
				<div class="col">
					<div class="card card-body d-flex justify-content-center align-items-center p-5">
						<h5 class="card-title mb-0">Menu: <?= mysqli_num_rows($menu_result) ?></h5>
					</div>
				</div>
				<div class="col">
					<div class="card card-body d-flex justify-content-center align-items-center p-5">
						<h5 class="card-title mb-0">Pesanan: <?= mysqli_num_rows($pesanan_result) ?></h5>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>