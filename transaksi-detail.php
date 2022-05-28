<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/transaksi-detail.php'; ?>


<?php $title = 'Pesanan'; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div class="main-body">
	<div class="section" id="recently">
		<div class="container mt-4">
				<div class="alert alert-<?= $status == 'Lunas' ? 'success' : 'danger' ?>" role="alert">
					<?php if ($status == 'Lunas'): ?>
					  <p class="mb-0">Terimaksih, <?= $_SESSION['pengguna_nama'] ?> sudah melakukan pembayaran, semoga anda puas dengan pelayanan kami.</p>
				  <?php else: ?>
				  	<p class="mb-0">Hai, <?= $_SESSION['pengguna_nama'] ?>, anda belum melakukan pembayaran. Silahkan melakukan pembayaran ke kasir kami.</p>
					<?php endif ?>
				</div>
			<div class="card">
				<div class="card-header">
					Detail Pesanan
				</div>
				<div class="card-body">
					<table class="table table-striped mb-0">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nama Menu</th>
					      <th scope="col">Harga</th>
					      <th scope="col">Pembelian</th>
					      <th scope="col">Status</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php if (mysqli_num_rows($result)): ?>
					  		<?php $i = 0 ?>
						  	<?php while ($row = mysqli_fetch_assoc($result)): ?>
						  		<tr>
							      <th scope="row"><?= ++$i ?></th>
							      <td><?= $row['nama'] ?></td>
							      <td>Rp. <?= number_format($row['harga'], 0) ?></td>
							      <td><?= $row['jumlah'] ?></td>
							      <td class="text-<?= $row['status'] == 'Lunas' ? 'success' : 'danger' ?>"><?= $row['status'] ?></td>
							    </tr>
						  	<?php endwhile ?>
					  	<?php endif ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include ROOT_PATH . 'includes/js.php'; ?>
<?php include ROOT_PATH . 'includes/footer.php'; ?>