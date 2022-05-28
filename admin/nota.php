<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/nota.php'; ?>


<?php $title = 'Nota Pelanggan'; ?>
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
				<div class="alert alert-<?= $status == 'Lunas' ? 'success' : 'warning' ?>" role="alert">
					<?php if ($status == 'Lunas'): ?>
					  Terima kasih, <strong><?= $nama_pelanggan ?></strong> sudah memesan di restoran kami. Semoga anda puas dengan pelayanan kami.
				  <?php else: ?>
				  	Pelanggan, <strong><?= $nama_pelanggan ?></strong> belum melakukan pembayaran. 
				  	Klik <a href="<?= base_url('admin/transaksi-bayar.php?no_pesanan=' . $no_pesanan) ?>" class="text-uppercase">disini</a> untuk melakukan pembayaran, Terimakasih.
					<?php endif ?>
				</div>
			<div class="card">
			  <div class="card-header">
			    Pelanggan: <strong><?= $nama_pelanggan ?></strong> || No. Meja: <strong><?= $no_meja ?></strong>
			  </div>
			  <div class="card-body">
			  	<?php if ($status == 'Lunas'): ?>
			  		<p>Tgl. Transaksi: <strong><?= date('l, d M Y', strtotime($tgl_bayar)) ?></strong></p>
			  	<?php endif ?>
			    <table class="table table-striped mb-0">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nama Menu</th>
					      <th scope="col">Jumlah</th>
					      <th scope="col">Harga</th>
					      <th scope="col">Total</th>
					      <th scope="col">Status</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php $total_jml = $total_bayar = $i = 0; ?>
				  		<?php foreach ($rows as $row): ?>
				  			<?php $total_bayar += $row['jumlah'] * $row['harga'] ?>
				  			<?php $total_jml += $row['jumlah'] ?>
						    <tr>
						      <th scope="row" class="align-middle"><?= ++$i ?></th>
						      <td class="align-middle">
						      	<img src="<?= base_url('uploads/' . $row['foto']) ?>" width="50" class="img-fluid mr-2">
						      	<?= $row['nama_menu'] ?>
						      </td>
						      <td class="align-middle"><?= $row['jumlah'] ?></td>
						      <td class="align-middle">Rp. <?= number_format($row['harga'], 0) ?></td>
						      <td class="align-middle">Rp. <?= number_format($row['total_bayar'], 0) ?></td>
						      <td class="align-middle text-<?= $row['status'] == 'Lunas' ? 'success' : 'danger' ?>"><?= $row['status'] ?></td>
						    </tr>
				  		<?php endforeach ?>
					  </tbody>
					  <tfoot>
					  	<th scope="col" class="text-right pb-0" colspan="2">Total</th>
				      <th scope="col" colspan="2" class="pb-0"><?= $total_jml ?></th>
				      <th scope="col" colspan="2" class="pb-0">Rp. <?= number_format($total_bayar, 0) ?></th>
					  </tfoot>
					</table>
			  </div>
			</div>
		</div>
		
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<?php include ROOT_PATH . 'includes/admin/js.php'; ?>
<?php include ROOT_PATH . 'includes/admin/footer.php'; ?>