<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
}

if (!isset($_GET['no_pesanan']) || empty($_GET['no_pesanan'])) {
	redirect('transaksi.php');
}

$no_pesanan = escape($_GET['no_pesanan']);
$query = "SELECT pesanan.*, menu.nama, menu.harga FROM pesanan 
		  JOIN menu ON pesanan.menu_id = menu.id
		  WHERE no_pesanan = '$no_pesanan'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) < 1) {
	redirect('transaksi.php');
}

$result_status_pesanan = mysqli_query($conn, "SELECT status FROM pesanan WHERE no_pesanan = '$no_pesanan'");
$row_status_pesanan = mysqli_fetch_assoc($result_status_pesanan);
$status = $row_status_pesanan['status'];