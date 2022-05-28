<?php require '../core.php'; ?>
<?php require ROOT_PATH . 'queries/admin/menu.php'; ?>


<?php $title = 'Menu'; ?>
<?php include ROOT_PATH . 'includes/admin/header.php'; ?>

<div class="d-flex" id="wrapper">

	<!-- Sidebar -->
	<?php include ROOT_PATH . 'includes/admin/sidebar.php'; ?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

		<!-- Navbr -->
		<?php include ROOT_PATH . 'includes/admin/navbar.php'; ?>

		<div class="container-fluid my-3">
			<?php flash('message') ?>
			<div class="card">
				<div class="card-header d-flex justify-content-between align-items-center">
					<span>Data Menu</span>
					<a href="<?= base_url('admin/menu-tambah.php') ?>" class="btn btn-sm btn-primary">Tambah Menu</a>
				</div>
				<div class="card-body">
					<table class="table table-striped mb-0">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Foto</th>
								<th scope="col">Nama</th>
								<th scope="col">Harga</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php if (mysqli_num_rows($result) > 0): ?>
								<?php $i = 1; ?>
								<?php while ($row = mysqli_fetch_assoc($result)) : ?>
									<tr>
										<th scope="row" class="align-middle"><?= $i++ ?></th>
										<td class="align-middle"><img src="<?= base_url('') ?>/uploads/<?= $row['foto'] ?>" width="50"></td>
										<td class="align-middle"><?= $row['nama'] ?></td>
										<td class="align-middle">Rp. <?= number_format($row['harga'], 0) ?></td>
										<td class="align-middle text-<?= $row['status'] ? 'success' : 'danger' ?>"><?= $row['status'] ? 'Tersedia' : 'Kosong' ?></td>
										<td class="align-middle">
											<a href="<?= base_url('admin/menu-edit.php?id=' . $row['id']) ?>" class="text-primary"><i class="fas fa-fw fa-edit"></i></a>
											<form action="<?= base_url('queries/admin/menu-hapus.php') ?>" method="post" class="d-inline-block" onsubmit="return confirm('Yakin?')">
												<input type="hidden" name="id" value="<?= $row['id'] ?>">
												<button class="btn btn-tranparent p-0 text-danger"><i class="fas fa-fw fa-trash"></i></button>
											</form>
										</td>
									</tr>
								<?php endwhile ?>
							<?php else : ?>
								<tr>
									<td colspan="6"><div class="text-danger text-center">Data Kosong!</div></td>
								</tr>
							<?php endif ?>
						</tbody>
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