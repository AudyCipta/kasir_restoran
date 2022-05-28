<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/login.php'; ?>


<?php $title = 'Login Page'; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<div class="bg-light">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
      <div class="col-md-6">
        <a href="<?= base_url() ?>" class="h2 text-center mb-4 d-block text-decoration-none"><?= SITE_NAME ?></a>
        <div class="card card-body border-0 shadow-sm mb-5">
          <h3 class="mb-1">Login</h3>
          <p class="text-muted mb-0">silahkan login untuk melakukan pemesanan</p>
          <hr>
          <form action="" method="post">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control <?= $email_err ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $email ?>" placeholder="Masukan email">
              <div class="invalid-feedback"><?= $email_err ?></div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-group">
                <input type="password" class="form-control <?= $password_err ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Masukan password">
                <div class="input-group-append cursor-pointer">
                  <span class="input-group-text toggle-password" id="basic-addon2" data-target="#password">
                    <i class="fas fa-fw fa-eye-slash"></i>
                  </span>
                </div>
                <div class="invalid-feedback"><?= $password_err ?></div>
              </div>
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                <label class="custom-control-label" for="remember">Biarkan saya tetap login</label>
              </div>
            </div>
            <div class="form-row">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
              <div class="col">
                <a href="<?= base_url('daftar.php') ?>" class="btn btn-light btn-block">Buat akun? Register</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include ROOT_PATH . 'includes/js.php'; ?>
<?php include ROOT_PATH . 'includes/footer.php'; ?>