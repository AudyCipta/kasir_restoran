<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$no_pesanan = escape($_POST['no_pesanan']);

	if (mysqli_query($conn, "DELETE FROM pembayaran WHERE no_pesanan = '$no_pesanan'")) {

		mysqli_query($conn, "DELETE FROM pesanan WHERE no_pesanan = '$no_pesanan'") or die(mysqli_error($conn));
		
		flash('message', 'Data transaksi berhasil dihapus');
		redirect('admin/transaksi.php');

	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}