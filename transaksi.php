<?php require 'core.php'; ?>
<?php require ROOT_PATH . 'queries/transaksi.php'; ?>


<?php $title = 'Pesanan'; ?>
<?php include ROOT_PATH . 'includes/header.php'; ?>

<?php include ROOT_PATH . 'includes/navbar.php'; ?>

<div class="main-body">
	<div class="section" id="recently">
		<div class="container mt-4">
			<div class="card">
				<div class="card-header">
					Data Transaksi
				</div>
				<div class="card-body">
					<table class="table table-striped mb-0">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Tgl. Transaksi</th>
					      <th scope="col">Total Item</th>
					      <th scope="col">Total Bayar</th>
					      <th scope="col">Status</th>
					      <th scope="col">Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php if (mysqli_num_rows($result)): ?>
					  		<?php $i = 0 ?>
						  	<?php while ($row = mysqli_fetch_assoc($result)): ?>
						  		<tr>
							      <th scope="row"><?= ++$i ?></th>
							      <td><?= date('l, d M Y', strtotime($row['tgl_bayar'])) ?? '-' ?></td>
							      <td><?= $row['jumlah'] ?></td>
							      <td>Rp. <?= number_format($row['total_bayar'], 0) ?></td>
							      <td class="text-<?= $row['status'] == 'Lunas' ? 'success' : 'danger' ?>"><?= $row['status'] ?></td>
							      <td>
							      	<a href="<?= base_url('transaksi-detail.php?no_pesanan=' . $row['no_pesanan']) ?>" class="badge badge-primary">Detail</a>
							      </td>
							    </tr>
						  	<?php endwhile ?>
					  	<?php else: ?>
					  		<tr>
					  			<td colspan="6" class="text-center text-danger">Anda belum melakukan pemesanan!</td>
					  		</tr>
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