<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/pesanan.php'; ?>


<?php $title = 'Pesanan'; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div class="main-body">
	<div class="section" id="recently">
		<div class="container mt-4">
			<?php flash('message') ?>
			<?php if (mysqli_num_rows($cek_pesanan_pelanggan) > 0): ?>
				<div class="alert alert-warning" role="alert">
					Pesanan Sedang Diproses, silahkan melakukan pembayaran ke kasir kami, Terima kasih.
				</div>
			<?php endif ?>
			<div class="card card-body">
				<div class="d-flex align-items-center justify-content-between">
					<form action="" method="post" class="w-100">
						<div class="form-row">
							<div class="col-md-4">
								<div class="form-group row mb-0 no-gutters">
								    <label for="no_meja" class="col-sm-3 col-form-label">No Meja</label>
								    <div class="col-sm-4">
								    	<select class="form-control form-control-sm" id="no_meja" name="no_meja">
								    		<?php foreach ($no_meja as $nm): ?>
								    			<?php if (in_array($nm, $no_meja_digunakan)): ?>
								    				<?php continue ?>
								    			<?php endif ?>
										    	<option><?= $nm ?></option>
								    		<?php endforeach ?>
									    </select>
								    </div>
								  </div>
							</div>
							<?php if (mysqli_num_rows($result) > 0): ?>
								<div class="col text-right">
									<button type="submit" class="btn btn-sm btn-success mb-2">Buat Pesanan</button>
								</div>
							<?php endif ?>
						</div>
					</form>
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
				    	<?php while ($row = mysqli_fetch_assoc($result)): ?>
				    		<tr>
						      <th scope="row"><?= ++$i ?></th>
						      <td>
						      	<img src="<?= base_url('uploads/' . $row['foto']) ?>" class="mr-1" width="30">
						      	<a href="<?= base_url('menu-detail.php?id=' . $row['menu_id']) ?>" class="text-dark"><?= $row['nama'] ?></a>
						      </td>
						      <td><?= $row['jumlah'] ?></td>
						      <td>Rp. <?= number_format($row['harga'], 0) ?></td>
						      <td class="text-right">Rp. <?= number_format($row['total_bayar'], 0) ?></td>
						      <td class="text-right">
						      	<form action="<?= base_url('queries/pesanan-hapus.php') ?>" method="post" onsubmit="return confirm('Yakin?')">
						      		<input type="hidden" name="id" value="<?= $row['id'] ?>">
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
								<form action="<?= base_url('queries/pesanan-hapus-semua.php') ?>" method="post" onsubmit="return confirm('Yakin?')">
									<button type="submit" class="btn btn-sm btn-outline-danger mb-2">Hapus Semua</button>
								</form>
						      </td>
						    </tr>
						  </tfoot>
			    	<?php else: ?>
			    		<tr>
			    			<td colspan="6" class="text-danger text-center">Tidak ada Pesanan!</td>
			    		</tr>
				    <?php endif ?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include ROOT_PATH . 'includes/js.php'; ?>
<?php include ROOT_PATH . 'includes/footer.php'; ?>
