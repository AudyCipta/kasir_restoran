<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
	redirect();
}

$id = escape($_GET['id']);
$result = mysqli_query($conn, "SELECT menu.*, kategori.nama nama_kategori FROM menu JOIN kategori ON menu.kategori_id = kategori.id WHERE menu.id = $id");
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) < 1) {
	redirect();
}

$jumlah = $jumlah_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (!isset($_SESSION['pengguna_id'])) {
		redirect('login.php');
	} elseif (isset($_SESSION['pengguna_id']) && $_SESSION['pengguna_level'] != 3) {
		flash('message', 'Hanya PELANGGAN yang dapat memesan menu', 'warning');
		redirect('menu-detail.php?id=' . $id);
	}

	$pengguna_id = $_SESSION['pengguna_id'];
	$jumlah 	 = escape($_POST['jumlah']);
	$total_bayar = $row['harga'] * $jumlah;

	$cek_pesanan_pelanggan = mysqli_query($conn, "SELECT * FROM pesanan WHERE status = 'Sedang Dipesan' AND pengguna_id = $pengguna_id");
	if (mysqli_num_rows($cek_pesanan_pelanggan) > 0) {
		flash('message', 'Pesanan anda sudah diproses, silahkan melakukan pembayaran ke kasir kami. Terimaksih', 'warning');
		redirect('menu-detail.php?id=' . $id);
	}

	if (empty($jumlah)) {
		$jumlah_err = "Jumlah pesanan tidak boleh kosong!";
	} elseif (!preg_match('/^[0-9]*$/', $jumlah)) {
		$jumlah_err = "Jumlah pesanan hanya boleh angka!";
	}

	if (empty($jumlah_err)) {
		
		$cek_menu = mysqli_query($conn, "SELECT * FROM pesanan WHERE menu_id = $id AND pengguna_id = $pengguna_id AND status = 'Pesan'");
		
		if (mysqli_num_rows($cek_menu) > 0) {

			$row = mysqli_fetch_assoc($cek_menu);
			$jumlah += $row['jumlah'];
			$total_bayar += $row['total_bayar'];
			$query = "UPDATE pesanan SET jumlah = '$jumlah', total_bayar = '$total_bayar' WHERE menu_id = $id AND pengguna_id = $pengguna_id AND status = 'Pesan'";

		} else {
			$query = "INSERT INTO pesanan (pengguna_id, menu_id, jumlah, total_bayar, status) 
					  VALUES ('$pengguna_id', '$id', '$jumlah', '$total_bayar', 'Pesan')";
		}

		if (mysqli_query($conn, $query)) {
			
			flash('message', 'Pesanan berhasil disimpan!');
			if (isset($_POST['pesan_sekarang'])) {
				redirect('pesanan.php');		
			} else {
				redirect('menu-detail.php?id=' . $id);
			}

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}	

	}

}