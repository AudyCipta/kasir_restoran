<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url() ?>"><?= SITE_NAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <?php if (!isset($_SESSION['pengguna_id'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login.php') ?>">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('daftar.php') ?>">Daftar</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pesanan.php') ?>">Pesanan <span class="badge badge-success"><?= total_pesanan() ?></span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?= base_url('uploads/' . $_SESSION['pengguna_foto']) ?>" class="img-fluid my-n1 mr-1" width="30"> <?= $_SESSION['pengguna_nama'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <?php if ($_SESSION['pengguna_level'] == 3): ?>
                <a class="dropdown-item text-muted" href="<?= base_url('edit-profil.php') ?>"><i class="fas fa-fw fa-user-edit"></i> Edit Profil</a>
                <a class="dropdown-item text-muted" href="<?= base_url('edit-password.php') ?>"><i class="fas fa-fw fa-key"></i> Edit Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-muted" href="<?= base_url('transaksi.php') ?>"><i class="fas fa-fw fa-cash-register"></i> Transaksi</a>
              <?php else: ?>
                <a class="dropdown-item text-muted" href="<?= base_url('admin') ?>"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
              <?php endif ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="<?= base_url('logout.php') ?>"><i class="fas fa-fw fa-power-off"></i> Logout</a>
            </div>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>