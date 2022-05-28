<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/edit-password.php'; ?>


<?php $title = "Edit Password"; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div id="wrapper">
  <div class="pb-5" id="body">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-md-7">
          <?php flash('message') ?>
          <div class="card card-body">
            <h4 class="mb-0">Edit Password</h4>
            <hr>
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
  <div class="section border-top py-4" id="footer">
    <div class="container">
      <p class="mb-0 text-center text-muted">Copyright © <?= SITE_NAME ?> 2020</p>
    </div>
  </div>
</div>

<?php include ROOT_PATH . 'includes/js.php'; ?>
<?php include ROOT_PATH . 'includes/footer.php'; ?>