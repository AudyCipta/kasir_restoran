<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$id = escape($_POST['id']);

	$cek_menu = mysqli_query($conn, "SELECT * FROM menu WHERE kategori_id = $id");
	if (mysqli_num_rows($cek_menu) > 0) {
		flash('message', 'Menu sedang aktif. Kategori gagal dihapus!', 'warning');
		redirect('admin/kategori.php');
	}

	if (mysqli_query($conn, "DELETE FROM kategori WHERE id = $id")) {
		flash('message', 'Data kategori berhasil dihapus');
	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}

redirect('admin/kategori.php');