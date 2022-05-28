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

$query = "SELECT pesanan.*, menu.nama nama_menu, menu.foto, menu.harga, pengguna.nama nama_pelanggan, pembayaran.tgl_bayar FROM pesanan
		  JOIN menu ON pesanan.menu_id = menu.id
		  JOIN pengguna ON pesanan.pengguna_id = pengguna.id
		  LEFT JOIN pembayaran ON pesanan.no_pesanan = pembayaran.no_pesanan
		  WHERE pesanan.no_pesanan = '$no_pesanan'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) < 1) {
	redirect('admin/transaksi.php');
}

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
	$nama_pelanggan = $row['nama_pelanggan'];
	$no_meja = $row['no_meja'];
	$status = $row['status'];
	$tgl_bayar = $row['tgl_bayar'];
	$rows[] = $row;
}