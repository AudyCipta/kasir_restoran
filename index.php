<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/home.php'; ?>


<?php $title = "Home Page"; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div id="wrapper">
  <div class="pb-5" id="body">
    <div class="section" id="menu">
      <div class="container pt-2 pb-5">
        <?php flash('message') ?>
        <h3 class="text-center my-5">Daftar Menu</h3>
        <div class="row mb-4 align-items-center">
          <div class="col-md-6">
            <div class="form-group mb-0 row">
              <label for="search" class="col-sm-auto col-form-label">Search</label>
              <div class="col-sm-8">
                <input type="text" class="form-control-sm form-control" id="keyword" name="keyword">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group mb-0 row">
              <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control custom-select-sm" id="kategori">
                  <option value="0">Semua</option>
                  <?php while ($row_kategori = mysqli_fetch_assoc($result_kategori)) : ?>
                    <option value="<?= $row_kategori['id'] ?>"><?= $row_kategori['nama'] ?></option>
                  <?php endwhile ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group mb-0 row">
              <label for="urutkan" class="col-sm-4 col-form-label">Urutkan</label>
              <div class="col-sm-8">
                <select class="form-control custom-select-sm" id="urutkan">
                  <option value="terbaru">Terbaru</option>
                  <option value="terlama">Terlama</option>
                  <option value="termurah">Termurah</option>
                  <option value="termahal">Termahal</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="container">
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
<script>
  $(document).ready(function() {

    loadData($('#kategori').val(), $('#urutkan').val(), $('#keyword').val());

    function loadData(kategori = 0, urutkan = 'terbaru', keyword = '') {
      $.ajax({
        url: 'queries/menu.php',
        type: 'POST',
        data: {
          kategori: kategori,
          urutkan: urutkan,
          keyword: keyword
        },
        dataType: 'json',
        success: function(result) {
          const data = result.data;
          let html = '';
          $.each(data, function(i, row) {
            html += `<div class="col-lg-3">
                      <a href="#" class="menu rounded overflow-hidden d-block">
                        <div class="menu-img">
                          <img src="<?= BASE_URL ?>uploads/${row.foto}" alt="rice" class="img-fluid">
                        </div>
                        <div class="menu-info mb-5">
                          <a href="<?= BASE_URL ?>menu-detail.php?id=${row.id}" class="mb-0 mt-2 stretched-link h5 d-block text-dark">${row.nama}</a>
                          <h6 class="text-muted">Kategori: ${row.nama_kategori}</h6>
                          <p class="price">Rp. ${rupiah(row.harga)}</p>
                        </div>
                      </a>
                    </div>`;
          });

          $('#total_menu').html(result.total + ' Menu');
          $('#container').html(html);
        }
      });
    }
    $('#keyword').on('keyup', function(e) {
      loadData($('#kategori').val(), $('#urutkan').val(), $('#keyword').val().trim());
    });

    $('#kategori').change(function(e) {
      loadData($('#kategori').val(), $('#urutkan').val());
    });

    $('#urutkan').change(function(e) {
      loadData($('#kategori').val(), $('#urutkan').val());
    });

    function rupiah(n) {
      let reverse = n.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return ribuan;
    }
  });
</script>
<?php include ROOT_PATH . 'includes/footer.php'; ?>