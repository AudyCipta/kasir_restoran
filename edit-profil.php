<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/edit-profil.php'; ?>


<?php $title = "Edit Profil"; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div id="wrapper">
  <div class="pb-5" id="body">
    <div class="container py-4">
      <?php flash('message') ?>
      <div class="card card-body">
        <div class="row">
          <div class="col">
            <h4>Profil: <?= $row['nama'] ?></h4>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 text-center">
            <div class="card card-body">
              <img src="<?= base_url('uploads/' . $row['foto']) ?>" class="img-fluid rounded mb-3">
              <p class="lead mb-0"><?= $row['nama'] ?></p>
              <p class="text-muted mb-0"><?= $row['nama_level'] ?></p>
            </div>
          </div>
          <div class="col-md-9 d-flex align-content-center flex-wrap">
            <form method="POST" action="" enctype="multipart/form-data" class="w-100">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control <?= $nama_err ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= $row['nama'] ?? $nama ?>">
                <div class="invalid-feedback"><?= $nama_err ?></div>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control <?= $email_err ? 'is-invalid' : '' ?>" id="email" name="email" value="<?= $row['email'] ?? $email ?>">
                <div class="invalid-feedback"><?= $email_err ?></div>
              </div>
              <div class="form-group">
                <label for="foto">Foto</label>
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
  <div class="section border-top py-4" id="footer">
    <div class="container">
      <p class="mb-0 text-center text-muted">Copyright © <?= SITE_NAME ?> 2020</p>
    </div>
  </div>
</div>

<?php include ROOT_PATH . 'includes/js.php'; ?>
<?php include ROOT_PATH . 'includes/footer.php'; ?>