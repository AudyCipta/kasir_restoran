<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$id = escape($_POST['id']);
	$pesanan_pelanggan = escape($_POST['pesanan_pelanggan']);

	if (mysqli_query($conn, "DELETE FROM pesanan WHERE id = $id AND no_pesanan = ''")) {
		
		flash('message', 'Pesanan berhasil dihapus!');
		redirect('admin/pesanan-pelanggan.php?id=' . $pesanan_pelanggan);

	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}