<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/menu-detail.php'; ?>


<?php $title = "Menu Detail"; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div id="wrapper">
  <div class="pb-5" id="body">
    <div class="section pt-3 pb-5" id="menu-detail">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
            <li class="breadcrumb-item active" aria-current="page"><?= $row['nama'] ?></li>
          </ol>
        </nav>
        <?php flash('message') ?>
        <div class="card card-body">
          <div class="row">
            <div class="col-md-5">
              <img src="<?= base_url('uploads/' . $row['foto']) ?>" class="img-fluid rounded">
            </div>
            <div class="col-md">
              <h2 class="mb-0 mt-1"><?= $row['nama'] ?></h2>
              <p class="lead text-muted mb-4">Kategori: <?= $row['nama_kategori'] ?></p>
              <h4 class="mb-4">Harga: Rp. <span class="text-warning"><?= number_format($row['harga'], 0) ?></span></h4>
              <form method="POST" action="">
                <div class="form-row">
                  <div class="col-md-3">
                    <div class="form-group mb-4">
                      <label for="jumlah">Jumlah</label>
                      <input type="number" class="form-control" id="jumlah" name="jumlah" name="jumlah" min="1" value="1">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-secondary">Tambah Pesanan</button>
                <button type="submit" class="btn btn-primary" name="pesan_sekarang">Pesan Sekarang</button>
              </form>
            </div>
          </div>
        </div>
        <div class="card card-body mt-3">
          <div class="row">
            <div class="col-md">
              <h4>Deskripsi:</h4>
              <hr class="my-2">
              <p class="mb-0 text-muted"><?= nl2br($row['deskripsi']) ?></p>
            </div>
            <div class="col-md">
              <h4>Komposisi:</h4>
              <hr class="my-2">
              <p class="mb-0 text-muted"><?= nl2br($row['komposisi']) ?></p>
            </div>
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
