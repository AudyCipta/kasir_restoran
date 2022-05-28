<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/daftar.php'; ?>


<?php $title = 'Register Page'; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<div class="bg-light">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
      <div class="col-md-6">
        <a href="<?= base_url() ?>" class="h2 text-center mb-4 d-block text-decoration-none"><?= SITE_NAME ?></a>
        <div class="card card-body border-0 shadow-sm mb-4">
          <h4 class="mb-1">Buat Akun</h4>
          <p class="text-muted mb-0">Silahkan isi form ini untuk daftar dengan kami</p>
          <hr>
          <form action="" method="post">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control <?= $nama_err ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $nama ?>" placeholder="Nama panggilan">
              <div class="invalid-feedback"><?= $nama_err ?></div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control <?= $email_err ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $email ?>" placeholder="Email e.g email.ike@mail.com">
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
              </div>
              <small id="password-help" class="form-text text-muted font-italic">Password minimal 6 karakter dan mengandung huruf besar dan angka</small>
            </div>
            <div class="form-row">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <div class="col">
                <a href="<?= base_url('login.php') ?>" class="btn btn-light btn-block">Punya akun? Login</a>
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