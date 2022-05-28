<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/edit-password.php'; ?>


<?php $title = 'Edit Password'; ?>
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
					<div class="card">
					  <div class="card-header">
					    Edit Password
					  </div>
					  <div class="card-body">
							<form action="" method="post">
							  <div class="form-group">
							    <label for="password_saat_ini">Password Saat Ini</label>
							    <input type="password" class="form-control <?= $password_saat_ini_err ? 'is-invalid' : '' ?>" id="password_saat_ini" name="password_saat_ini" 
							    value="<?= $password_saat_ini ?>">
							    <div class="invalid-feedback"><?= $password_saat_ini_err ?></div>
							  </div>
		            <div class="form-group">
		              <label for="password">Password Baru</label>
		              <div class="input-group">
		                <input type="password" class="form-control <?= $password_err ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Masukan password">
		                <div class="input-group-append cursor-pointer">
		                  <span class="input-group-text toggle-password" id="basic-addon2" data-target="#password">
		                    <i class="fas fa-fw fa-eye-slash"></i>
		                  </span>
		                </div>
		              </div>
		              <small id="password-help" class="form-text text-muted font-italic">Password minimal 6 karakter dan mengandung huruf besar dan angka</small>
		            </div>
							  <button type="submit" class="btn btn-success">Update Password</button>
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