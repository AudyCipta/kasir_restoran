<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if (!isset($_GET['no_pesanan']) || empty($_GET['no_pesanan'])) {
	redirect('admin/transaksi.php');
}

$no_pesanan = escape($_GET['no_pesanan']);
$query = "SELECT pesanan.*, menu.nama as nama_menu, menu.harga, pengguna.nama as nama_pengguna FROM pesanan 
		  JOIN menu ON pesanan.menu_id = menu.id 
		  JOIN pengguna ON pesanan.pengguna_id = pengguna.id
		  WHERE no_pesanan = '$no_pesanan'";
$result_pesanan = mysqli_query($conn, $query);

if (mysqli_num_rows($result_pesanan) < 1) {
	redirect('admin/transaksi.php');	
}

$result_menu = mysqli_query($conn, "SELECT * FROM menu WHERE status = 1");

$nominal = $nominal_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$no_pesanan  = escape($_POST['no_pesanan']);
	$total_bayar = escape($_POST['total_bayar']);
	$nominal 	 = escape($_POST['nominal']);

	if (empty($nominal)) {
		$nominal_err = "Nominal wajib diisi";
	} elseif (!preg_match("/^[0-9]*$/", $nominal)) {
		$nominal_err = "Nominal hanya boleh mengandung angka!";
	} elseif ($nominal < $total_bayar) {
		$nominal_err = "Nominal kurang!";
	}

	if (empty($nominal_err)) {
		
		if (mysqli_query($conn, "INSERT INTO pembayaran (no_pesanan, tgl_bayar, status_bayar) VALUES ('$no_pesanan', NOW(), 'Lunas')")) {
			
			mysqli_query($conn, "UPDATE pesanan SET status = 'Lunas' WHERE no_pesanan = '$no_pesanan'") or die(mysqli_error($conn));
			redirect('admin/nota.php?no_pesanan=' . $no_pesanan);

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}
	
}