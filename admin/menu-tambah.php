<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/menu-tambah.php'; ?>


<?php $title = 'Tambah Menu'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php $title = 'Menu'; ?>
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<div class="card">
				<div class="card-header">
					Form Tambah Menu
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="form-row">
							<div class="col-md-6">
									<div class="form-group">
										<label for="nama">Nama Menu: </label>
										<input type="text" class="form-control <?= $nama_err ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
										<div class="invalid-feedback"><?= $nama_err ?></div>
									</div>
									<div class="form-group">
										<label for="kategori">Kategori: </label>
										<select class="form-control <?= $kategori_id_err ? 'is-invalid' : '' ?>" id="level" name="kategori_id">
											<option value=""> - </option>
											<?php while ($row = mysqli_fetch_assoc($kategori_result)): ?>
												<option value="<?= $row['id'] ?>" <?= ($kategori_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama'] ?></option>
											<?php endwhile ?>
										</select>
										<div class="invalid-feedback"><?= $kategori_id_err ?></div>
									</div>
									<div class="form-group">
										<label for="komposisi">Komposisi: </label>
										<textarea class="form-control <?= $komposisi_err ? 'is-invalid' : '' ?>" id="komposisi" name="komposisi" rows="4"><?= $komposisi ?></textarea>
										<div class="invalid-feedback"><?= $komposisi_err ?></div>
									</div>
									<div class="form-group">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="status" name="status" checked>
											<label class="custom-control-label" for="status">Tersedia</label>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="foto">Foto: </label>
									<div class="custom-file">
										<input type="file" class="custom-file-input <?= $foto_err ? 'is-invalid' : '' ?>" id="foto" name="foto">
										<label class="custom-file-label" for="foto">Choose file</label>
										<div class="invalid-feedback"><?= $foto_err ?></div>
									</div>
								</div>
								<div class="form-group">
									<label for="harga">Harga: (Rp.)</label>
									<input type="text" class="form-control <?= $harga_err ? 'is-invalid' : '' ?>" id="harga" name="harga" value="<?= $harga ?>">
									<div class="invalid-feedback"><?= $harga_err ?></div>
								</div>
								<div class="form-group">
									<label for="deskripsi">Deskripsi: </label>
									<textarea class="form-control <?= $deskripsi_err ? 'is-invalid' : '' ?>" id="deskripsi" name="deskripsi" rows="4"><?= $deskripsi ?></textarea>
									<div class="invalid-feedback"><?= $deskripsi_err ?></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>