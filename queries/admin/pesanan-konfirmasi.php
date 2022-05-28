<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$no_pesanan  = date('Ymd') . random_str();
	$no_meja 	 = escape($_POST['no_meja_konfirm']);
	$pengguna_id = escape($_POST['pengguna_id']);

	if (mysqli_query($conn, "UPDATE pesanan SET no_meja = '$no_meja' WHERE pengguna_id = $pengguna_id AND status = 'Pesan'")) {

		$query = "UPDATE pesanan SET no_pesanan = '$no_pesanan', status = 'Sedang Dipesan' WHERE no_meja = $no_meja AND pengguna_id = $pengguna_id AND status = 'Pesan'";
		mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		redirect('admin/pesanan-pelanggan.php?id=' . $pengguna_id);

	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}