<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/pengguna-tambah.php'; ?>


<?php $title = 'Tambah Pengguna'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php $title = 'Pengguna'; ?>
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<div class="row">
				<div class="col-md-7">
					<div class="card">
						<div class="card-header">
							Form Tambah <?= $_SESSION['pengguna_level'] == 2 ? 'Pelanggan' : 'Pengguna' ?>
						</div>
						<div class="card-body">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="foto">Foto: </label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="foto" name="foto">
										<label class="custom-file-label" for="foto">Choose file</label>
									</div>
								</div>
								<div class="form-group">
									<label for="nama">Nama: </label>
									<input type="text" class="form-control <?= $nama_err ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>">
									<div class="invalid-feedback"><?= $nama_err ?></div>
								</div>
								<div class="form-group">
									<label for="email">Email: </label>
									<input type="text" class="form-control <?= $email_err ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $email ?>">
									<div class="invalid-feedback"><?= $email_err ?></div>
								</div>
								<div class="form-group">
									<label for="password">Password: </label>
									<div class="input-group">
		                <input type="password" class="form-control <?= $password_err ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= $password ?>" placeholder="Masukan password">
		                <div class="input-group-append cursor-pointer">
		                  <span class="input-group-text toggle-password" id="basic-addon2" data-target="#password">
		                    <i class="fas fa-fw fa-eye-slash"></i>
		                  </span>
		                </div>
		              </div>
				          <small id="password-help" class="form-text text-muted font-italic">Password minimal 6 karakter dan mengandung huruf besar dan angka</small>
								</div>
								<div class="form-group">
									<label for="level">Level: </label>
									<select class="form-control <?= $level_id_err ? 'is-invalid' : '' ?>" id="level" name="level_id">
										<option value=""> - </option>
										<?php while ($row = mysqli_fetch_assoc($level_result)): ?>
											<?php if ($_SESSION['pengguna_level'] == 2): ?>
												<?php if ($row['id'] == 3): ?>
													<option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
												<?php endif ?>
											<?php else: ?>
												<option value="<?= $row['id'] ?>" <?= ($level_id == $row['id']) ? 'selected' : '' ?>><?= $row['nama'] ?></option>
											<?php endif ?>
										<?php endwhile ?>
									</select>
									<div class="invalid-feedback"><?= $level_id_err ?></div>
								</div>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</form>
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