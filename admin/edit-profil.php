<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/edit-profil.php'; ?>


<?php $title = 'Edit Profil'; ?>
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
		    	<div class="col-md-10">
	    		<?php flash('message') ?>
					<div class="card">
					  <div class="card-header">
					    Profil <?= $row['nama'] ?>
					  </div>
					  <div class="card-body">
					    <div class="row">
					    	<div class="col-md-4">
					    		<div class="card">
									  <img src="<?= base_url('uploads/' . $row['foto']) ?>" class="card-img-top" alt="...">
									  <div class="card-body text-center">
									    <h5 class="card-title mb-1"><?= $row['nama'] ?></h5>
									    <p class="card-text text-muted"><?= $row['nama_level'] ?></p>
									  </div>
									</div>
					    	</div>
					    	<div class="col-md-8 d-flex align-content-center flex-wrap">
					    		<form action="" method="post" enctype="multipart/form-data" class="w-100">
					    			<input type="hidden" name="id" value="<?= $row['id'] ?>">
					    			<input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
					    			<div class="form-group">
									    <label for="nama">Nama:</label>
									    <input type="text" class="form-control <?= $nama_err ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $row['nama'] ?? $nama  ?>">
									    <div class="invalid-feedback"><?= $nama_err ?></div>
									  </div>
					    			<div class="form-group">
									    <label for="email">Email:</label>
									    <input type="text" class="form-control <?= $email_err ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $row['email'] ?? $email  ?>">
									    <div class="invalid-feedback"><?= $email_err ?></div>
									  </div>
					    			<div class="form-group">
									    <label for="foto">Foto:</label>
									    <div class="custom-file">
											  <input type="file" class="custom-file-input <?= $foto_err ? 'is-invalid' : '' ?>" id="foto" name="foto">
											  <div class="invalid-feedback"><?= $foto_err ?></div>
											  <label class="custom-file-label" for="foto">Choose file</label>
											</div>
									  </div>
									  <button type="submit" class="btn btn-success">Update Profil</button>
					    		</form>
					    	</div>
					    </div>
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