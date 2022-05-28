<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/transaksi.php'; ?>


<?php $title = 'Transaksi'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<div class="row">
				<div class="col-md-9">
					<?php flash('message') ?>
					<div class="card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<span>Transaksi Pelanggan</span>
						</div>
						<div class="card-body">
							<table class="table table-striped mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">No. Pesanan</th>
										<th scope="col">Nama Pelanggan</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (mysqli_num_rows($result) > 0) : ?>
										<?php $i = 1; ?>
										<?php while ($row = mysqli_fetch_assoc($result)) : ?>
											<tr>
												<th scope="row" class="align-middle"><?= $i++ ?></th>
												<td class="align-middle"><?= $row['no_pesanan'] ?></td>
												<td class="align-middle"><?= $row['nama'] ?></td>
												<td class="align-middle">
													<a href="<?= base_url('admin/nota.php?no_pesanan=' . $row['no_pesanan']) ?>" class="badge badge-success">Nota</a>
													<?php if ($row['status'] == 'Sedang Dipesan') : ?>
														<a href="<?= base_url('admin/transaksi-bayar.php?no_pesanan=' . $row['no_pesanan']) ?>" class="badge badge-info">Bayar</a>
													<?php elseif ($row['status'] == 'Lunas') : ?>
														<form action="<?= base_url('queries/admin/transaksi-hapus.php') ?>" method="post" class="d-inline-block" onsubmit="return confirm('Yakin?')">
															<input type="hidden" name="no_pesanan" value="<?= $row['no_pesanan'] ?>">
															<button type="submit" class="badge badge-danger border-0">Hapus</button>
														</form>
													<?php endif ?>
												</td>
											</tr>
										<?php endwhile ?>
									<?php else : ?>
										<tr>
											<td colspan="4">
												<div class="text-danger text-center">Pesanan kosong!</div>
											</td>
										</tr>
									<?php endif ?>
								</tbody>
							</table>
						</div>
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