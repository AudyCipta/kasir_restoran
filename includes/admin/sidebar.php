<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
	<div class="sidebar-heading"><?= SITE_NAME ?></div>
	<div class="list-group list-group-flush">
		<a href="<?= base_url('admin') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Dashboard' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
		</a>
		<a href="<?= base_url('admin/pengguna.php') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Pengguna' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-user"></i> <?= $_SESSION['pengguna_level'] == 2 ? 'Pelanggan' : 'Pengguna' ?>
		</a>
		<a href="<?= base_url('admin/kategori.php') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Kategori' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-clipboard-list"></i> Kategori
		</a>
		<a href="<?= base_url('admin/menu.php') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Menu' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-book-open"></i> Menu
		</a>
		<a href="<?= base_url('admin/pesanan.php') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Pesanan' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-book-reader"></i> Pesanan
		</a>
		<a href="<?= base_url('admin/transaksi.php') ?>" class="list-group-item list-group-item-action bg-light <?= $title == 'Transaksi' ? 'active' : '' ?>">
			<i class="fas fa-fw fa-money-check-alt"></i> Transaksi
		</a>
	</div>
</div>
<!-- /#sidebar-wrapper -->