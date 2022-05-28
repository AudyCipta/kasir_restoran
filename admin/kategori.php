<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/kategori.php'; ?>


<?php $title = 'Kategori'; ?>
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
				<div class="col-md-7">
					<?php flash('message') ?>
					<?php if ($errors): ?>
						<?php foreach ($errors as $error): ?>
							<div class="alert alert-danger" role="alert"><?= $error ?></div>
						<?php endforeach ?>
					<?php endif ?>

					<div class="card">
						<div class="card-header d-flex justify-content-between align-items-center">
							<span>Data Kategori</span>
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kategoriModal">Tambah Kategori</button>
						</div>
						<div class="card-body">
							<table class="table table-striped mb-0">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nama</th>
										<th scope="col">Tanggal diBuat</th>
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
												<td class="align-middle"><?= date('d F Y H:i:s', strtotime($row['tgl_dibuat'])) ?></td>
												<td class="align-middle">
													<form action="<?= base_url('queries/admin/kategori-hapus.php') ?>" method="post" class="d-inline-block" onsubmit="return confirm('Yakin?')">
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
		</div>
		
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kategoriModalLabel">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label for="kategori">Nama Kategori: </label>
						<input type="text" class="form-control" id="kategori" name="nama" required
						oninvalid="this.setCustomValidity('Masukan nama kategori')"
  						oninput="this.setCustomValidity('')">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>