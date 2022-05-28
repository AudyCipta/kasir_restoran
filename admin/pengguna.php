<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/pengguna.php'; ?>


<?php $title = 'Pengguna'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<?php flash('message') ?>
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<span>Data <?= $_SESSION['pengguna_level'] == 2 ? 'Pelanggan' : 'Pengguna' ?></span>
					<a href="<?= base_url('admin/pengguna-tambah.php') ?>" class="btn btn-sm btn-primary">Tambah <?= $_SESSION['pengguna_level'] == 2 ? 'Pelanggan' : 'Pengguna' ?></a>
				</div>
				<div class="card-body">
					<table class="table table-striped mb-0">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Foto</th>
								<th scope="col">Nama</th>
								<th scope="col">Email</th>
								<?php if ($_SESSION['pengguna_level'] == 1): ?>
									<th scope="col">Level</th>
								<?php endif ?>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (mysqli_num_rows($result) > 0): ?>
								<?php $i = 1; ?>
								<?php while ($row = mysqli_fetch_assoc($result)) : ?>
									<tr>
										<th scope="row" class="align-middle"><?= $i++ ?></th>
										<td class="align-middle"><img src="<?= base_url('uploads/' . $row['foto']) ?>" width="30"></td>
										<td class="align-middle"><?= $row['nama'] ?></td>
										<td class="align-middle"><?= $row['email'] ?></td>
										<?php if ($_SESSION['pengguna_level'] == 1): ?>
											<td class="align-middle"><?= $row['nama_level'] ?></td>
										<?php endif ?>
										<td class="align-middle">
											<form action="<?= base_url('queries/admin/pengguna-hapus.php') ?>" method="post" class="d-inline-block" onsubmit="return confirm('Yakin?')">
												<input type="hidden" name="id" value="<?= $row['id'] ?>">
												<button class="btn btn-tranparent p-0 text-danger"><i class="fas fa-fw fa-trash"></i></button>
											</form>
										</td>
									</tr>
								<?php endwhile ?>
							<?php else : ?>
								<tr>
									<td colspan="5"><div class="text-danger text-center">Data Kosong!</div></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>