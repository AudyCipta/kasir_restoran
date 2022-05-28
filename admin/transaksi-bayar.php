<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/transaksi-bayar.php'; ?>


<?php $title = 'Transaksi Bayar'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php $title = 'Transaksi'; ?>
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<?php flash('message') ?>
			<div class="form-row">
				<div class="col-md-8">
					<div class="card">
					  <div class="card-header d-flex justify-content-between align-items-center">
					    <span>Daftar Pesanan</span>
					    <div class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#tambahPesananModal">Tambah Pesanan</div>
					  </div>
					  <div class="card-body">
					  	<div class="table-responsive">
						  	<table class="table table-striped mb-0 text-nowrap">
								  <thead>
								    <tr>
								      <th scope="col">#</th>
								      <th scope="col">Nama Menu</th>
								      <th scope="col">Jumlah</th>
								      <th scope="col" class="text-center">Harga</th>
								      <th scope="col" class="text-right">Total</th>
								    </tr>
								  </thead>
								  <tbody>
								  	<?php $total_bayar = $total_jumlah = $i = 0; ?>
								  	<?php while ($row = mysqli_fetch_assoc($result_pesanan)): ?>
								  		<?php $no_meja = $row['no_meja'] ?>
								  		<?php $pengguna_id = $row['pengguna_id'] ?>
								  		<?php $total_bayar += $row['jumlah'] * $row['harga'] ?>
								  		<?php $total_jumlah += $row['jumlah'] ?>
								  		<?php $nama_pelanggan = $row['nama_pengguna'] ?>
									    <tr>
									      <th scope="row"><?= ++$i ?></th>
									      <td><?= $row['nama_menu'] ?></td>
									      <td><?= $row['jumlah'] ?></td>
									      <td class="text-center">Rp. <?= number_format($row['harga'], 0) ?></td>
									      <td class="text-right">Rp. <?= number_format($row['total_bayar'], 0) ?></td>
									    </tr>
									  <?php endwhile ?>
								  </tbody>
								  <tfoot>
							      <th scope="col" colspan="2" class="text-right pb-0">Total</th>
							      <th scope="col" class="pb-0"><?= $total_jumlah ?></th>
							      <th scope="col" colspan="2" class="text-right pb-0">Rp. <?= number_format($total_bayar, 0) ?></th>
								  </tfoot>
								</table>
							</div>
					  </div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
					  <div class="card-header">
					    Form Pembayaran
					  </div>
					  <div class="card-body">
					  	<form method="POST" action="">
							  <div class="form-group">
							    <label for="no_pesanan">No Pesanan</label>
							    <input type="text" class="form-control" id="no_pesanan" name="no_pesanan" value="<?= $_GET['no_pesanan'] ?>" readonly>
							  </div>
							  <div class="form-group">
							    <label for="nama_pelanggan">Nama Pelanggan</label>
							    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= $nama_pelanggan ?>" readonly>
							  </div>
							  <div class="form-group">
							    <label for="total_bayar">Total Bayar</label>
							    <div class="input-group">
								    <div class="input-group-prepend">
									    <span class="input-group-text">Rp.</span>
									  </div>
								    <input type="text" class="form-control" value="<?= number_format($total_bayar) ?>" readonly>
							    </div>
							    <input type="hidden" class="form-control" id="total_bayar" name="total_bayar" value="<?= $total_bayar ?>">
							  </div>
							  <div class="form-group">
							    <label for="nominal">Nominal</label>
							    <div class="input-group">
								    <div class="input-group-prepend">
									    <span class="input-group-text">Rp.</span>
									  </div>
								    <input type="number" class="form-control <?= $nominal_err ? 'is-invalid' : '' ?>" id="nominal" name="nominal" value="<?= $nominal ?>">
								    <div class="invalid-feedback"><?= $nominal_err ?></div>
							    </div>
							  </div>
							  <button type="submit" class="btn btn-primary">Simpan</button>
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

<!-- Modal -->
<div class="modal fade" id="tambahPesananModal" tabindex="-1" aria-labelledby="tambahPesananModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPesananModalLabel">Tambah Pesanan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('queries/admin/transaksi-pesanan-tambah.php') ?>" method="post">
        	<input type="hidden" name="no_pesanan" value="<?= $no_pesanan ?>">
        	<input type="hidden" name="pengguna_id" value="<?= $pengguna_id ?>">
        	<input type="hidden" name="no_meja" value="<?= $no_meja ?>">
        	<div class="form-group">
			    <label for="menu_id">Nama menu</label>
			    <select class="form-control" id="menu_id" name="menu_id" required
				oninvalid="this.setCustomValidity('Masukan nama menu')"
				oninput="this.setCustomValidity('')">
			      <option value="">-</option>
			      <?php while ($row_menu = mysqli_fetch_assoc($result_menu)) : ?>
				      <option value="<?= $row_menu['id'] ?>"><?= $row_menu['nama'] ?></option>
				  <?php endwhile ?>
			    </select>
			</div>
			<div class="form-group">
			    <label for="jumlah">Jumlah Pesanan</label>
			    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required
				oninvalid="this.setCustomValidity('Masukan jumlah pesanan')"
				oninput="this.setCustomValidity('')">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>