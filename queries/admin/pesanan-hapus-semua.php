<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$pengguna_id = escape($_POST['pengguna_id']);

	if (mysqli_query($conn, "DELETE FROM pesanan WHERE pengguna_id = $pengguna_id AND status = 'Pesan'")) {

		flash('message', 'Pesanan berhasil dihapus! Pesanan kosong!');
		redirect('admin/pesanan-pelanggan.php?id=' . $pengguna_id);

	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}