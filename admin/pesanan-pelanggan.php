<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/pesanan-pelanggan.php'; ?>


<?php $title = 'Pesanan'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbar -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<?php flash('message') ?>
			<?php if (mysqli_num_rows($cek_pesanan_pelanggan) > 0): ?>
				<div class="alert alert-success" role="alert">
					<h5>Pesanan Sedang Diproses</h5>
				 	<p class="mb-0">Silahkan klik <a href="<?= base_url('admin/transaksi-bayar.php?no_pesanan=' . $no_pesanan) ?>" class="text-uppercase">disini</a> untuk melakukan transaksi, terimakasih.</p>
				</div>
			<?php else: ?>
				<div class="card">
					<div class="card-header d-flex justify-content-between align-items-center">
						<span>Data Pesanan</span>
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pesananModal">Tambah Pesanan</button>
					</div>
					<div class="card-body">
						<div class="row mb-2 justify-content-between">
							<div class="col-lg-4">
								<div class="form-group row mb-0">
							    <label for="no_meja" class="col-sm-4 col-form-label">No. Meja</label>
							    <div class="col-sm-5">
							      <select class="form-control form-control-sm" id="no_meja">
							      	<?php foreach ($no_meja as $nm): ?>
							      		<?php if (in_array($nm, $no_meja_digunakan)): ?>
							      			<?php continue; ?>
							      		<?php endif ?>
											  <option value="<?= $nm ?>"><?= $nm ?></option>
							      	<?php endforeach ?>
										</select>
							    </div>
							  </div>
							</div>
							<div class="col-lg text-right">
				      	<form action="<?= base_url('queries/admin/pesanan-hapus-semua.php') ?>" method="post" onsubmit="return confirm('Yakin?')">
				      		<input type="hidden" name="pengguna_id" value="<?= $_GET['id'] ?>">
				      		<button type="submit" class="btn btn-danger btn-sm">Hapus Semua</button>
								</form>
							</div>
						</div>
						<table class="table table-striped mb-0">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama Menu</th>
						      <th scope="col">Jumlah</th>
						      <th scope="col">Harga</th>
						      <th scope="col" class="text-right">Total</th>
						      <th scope="col" class="text-right">Hapus</th>
								</tr>
							</thead>
							<tbody>
								<?php if (mysqli_num_rows($result) > 0): ?>
									<?php $total_jumlah = $total_harga = $i = 0; ?>
									<?php while ($row = mysqli_fetch_assoc($result)) : ?>
										<tr>
								      <th scope="row"><?= ++$i ?></th>
								      <td>
								      	<img src="<?= base_url('uploads/' . $row['foto']) ?>" class="mr-1" width="30">
								      	<a href="<?= base_url('detail.php?id=' . $row['menu_id']) ?>" class="text-dark"><?= $row['nama'] ?></a>
								      </td>
								      <td><?= $row['jumlah'] ?></td>
								      <td>Rp. <?= number_format($row['harga'], 0) ?></td>
								      <td class="text-right">Rp. <?= number_format($row['total_bayar'], 0) ?></td>
								      <td class="text-right">
								      	<form action="<?= base_url('queries/admin/pesanan-hapus.php') ?>" method="post" onsubmit="return confirm('Yakin?')">
								      		<input type="hidden" name="id" value="<?= $row['id'] ?>">
								      		<input type="hidden" name="pesanan_pelanggan" value="<?= $_GET['id'] ?>">
								      		<button type="submit" class="btn btn-transparent p-0 text-danger"><i class="fas fa-fw fa-trash"></i></button>
								      	</form>
								      </td>
								    </tr>
								    <?php $total_jumlah += $row['jumlah']; ?>
								    <?php $total_harga += $row['harga'] * $row['jumlah']; ?>
									<?php endwhile ?>
									<tfoot>
										<tr>
										  <th colspan="2" class="text-right align-middle">Total</th>
										  <th class="align-middle"><?= $total_jumlah ?></th>
										  <th colspan="2" class="align-middle text-right">Rp. <?= number_format($total_harga, 0) ?></th>
										  <td class="align-middle text-right pr-0 pb-0">
								      	<form action="<?= base_url('queries/admin/pesanan-konfirmasi.php') ?>" method="post">
								      		<input type="hidden" name="no_meja_konfirm" id="no_meja_konfirm">
								      		<input type="hidden" name="pengguna_id" value="<?= $_GET['id'] ?>">
								      		<button type="submit" class="btn btn-secondary btn-sm">Buat Pesanan</button>
								      	</form>
										  </td>
										</tr>
									</tfoot>
								<?php else : ?>
									<tr>
										<td colspan="6"><div class="text-danger text-center">Tidak ada pesanan!</div></td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php endif ?>
		</div>
		
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Modal -->
<div class="modal fade" id="pesananModal" tabindex="-1" aria-labelledby="pesananModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pesananModalLabel">Tambah Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        	<input type="hidden" name="pengguna_id" value="<?= $peg_id ?>">
			    <div class="form-group">
				    <label for="menu_id">Nama Menu</label>
				    <select class="form-control" id="menu_id" name="menu_id" required 
				    oninvalid="this.setCustomValidity('Masukan nama menu')"
  					oninput="this.setCustomValidity('')">
				      <option value="">-</option>
				      <?php while ($menu_row = mysqli_fetch_assoc($menu_result)): ?>
				      	<option value="<?= $menu_row['id'] ?>"><?= $menu_row['nama'] ?></option>
				      <?php endwhile ?>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="jumlah">Jumlah</label>
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
<script>
	$('#no_meja_konfirm').val($('#no_meja').val());
	$('#no_meja').change(function() {
		$('#no_meja_konfirm').val($('#no_meja').val());
	});
</script>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>