<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/pesanan.php'; ?>


<?php $title = 'Pesanan'; ?>
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
				<div class="col-md-8">

					<div class="card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<span>Data Pesanan</span>
						</div>
						<div class="card-body">
							<table class="table table-striped mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama Pelanggan</th>
										<th scope="col">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php if (mysqli_num_rows($result) > 0): ?>
										<?php $i = 1; ?>
										<?php while ($row = mysqli_fetch_assoc($result)) : ?>
											<tr>
												<th scope="row" class="align-middle"><?= $i++ ?></th>
												<td class="align-middle"><?= $row['nama'] ?></td>
												<td class="align-middle">
													<a href="<?= base_url('admin/pesanan-pelanggan.php?id=' . $row['id']) ?>" class="badge badge-success">Pesanan</a>
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
		</div>
		
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>