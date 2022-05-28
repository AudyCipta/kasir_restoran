<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
	<button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto mt-2 mt-lg-0 d-flex align-items-center">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url() ?>"> Home</a>
			</li>
			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="<?= base_url('/uploads/' . $_SESSION['pengguna_foto']) ?>" width="30" height="30" class="my-n1">
					<span class="ml-2"><?= $_SESSION['pengguna_nama'] ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= base_url('admin/edit-profil.php') ?>"><i class="fas fa-fw fa-user-cog"></i> Edit Profil</a>
          <a class="dropdown-item" href="<?= base_url('admin/edit-password.php') ?>"><i class="fas fa-fw fa-key"></i> Edit Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?= base_url('logout.php') ?>"><i class="fas fa-fw fa-power-off"></i> Logout</a>
        </div>
      </li>
		</ul>
	</div>
</nav>