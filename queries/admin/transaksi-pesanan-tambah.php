<?php
require '../../core.php';

if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

function total_bayar($menu_id, $jumlah) {
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $menu_id");
	$row = mysqli_fetch_assoc($result);
	return $row['harga'] * $jumlah;
}

$menu_id = $menu_id_err = "";
$jumlah  = $jumlah_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$no_pesanan  = escape($_POST['no_pesanan']);
	$pengguna_id = escape($_POST['pengguna_id']);
	$no_meja  	 = escape($_POST['no_meja']);
	$menu_id 	 = escape($_POST['menu_id']);
	$jumlah 	 = escape($_POST['jumlah']);

	if (empty($menu_id)) {
		$menu_id_err = "Menu wajib diisi!";
	}

	if (empty($jumlah)) {
		$jumlah_err = "Jumlah pesnaan wajib diisi!";
	} elseif (!preg_match('/^[0-9]*$/', $jumlah)) {
		$jumlah_err = "Jumlah pesanan hanya boleh angka!";
	}

	if (empty($menu_id_err) && empty($jumlah_err)) {
		
		$cek_pesanan_pelanggan = mysqli_query($conn, "SELECT * FROM pesanan WHERE pengguna_id = $pengguna_id AND menu_id = $menu_id AND no_pesanan = '$no_pesanan'");

		if (mysqli_num_rows($cek_pesanan_pelanggan) > 0) {

			$row_pesanan_pelanggan = mysqli_fetch_assoc($cek_pesanan_pelanggan);
			$jumlah += $row_pesanan_pelanggan['jumlah'];
			$total_bayar = total_bayar($menu_id, $jumlah);
			$query = "UPDATE pesanan SET jumlah = '$jumlah', total_bayar = '$total_bayar' WHERE pengguna_id = $pengguna_id AND menu_id = $menu_id AND no_pesanan = '$no_pesanan'";

		} else {

			$total_bayar = total_bayar($menu_id, $jumlah);
			$query = "INSERT INTO pesanan (no_pesanan, pengguna_id, no_meja, menu_id, jumlah, total_bayar, status) 
					  VALUES ('$no_pesanan', '$pengguna_id', '$no_meja', '$menu_id', '$jumlah', '$total_bayar', 'Sedang Dipesan')";

		}
		
		if (mysqli_query($conn, $query)) {
			
			flash('message', 'Pesanan baru berhasil ditambahkan!');
			redirect('admin/transaksi-bayar.php?no_pesanan=' . $no_pesanan);

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}