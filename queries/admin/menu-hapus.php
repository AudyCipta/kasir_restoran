<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$id = $_POST['id'];

	$result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ($row['foto'] != 'default.svg') {
		$file = ROOT_PATH . 'uploads/' . $row['foto'];
		unlink($file);
	}

	if (mysqli_query($conn, "DELETE FROM menu WHERE id = $id")) {
		flash('message', 'Data menu berhasil dihapus');
	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}

redirect('admin/menu.php');