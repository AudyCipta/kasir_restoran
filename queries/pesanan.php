<?php
$no_meja = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
$cek_no_meja = mysqli_query($conn, "SELECT no_meja FROM pesanan WHERE no_meja <> '' AND status = 'Pesan' OR status = 'Sedang Dipesan'");
$no_meja_digunakan = [];
while ($row_meja = mysqli_fetch_assoc($cek_no_meja)) {
	$no_meja_digunakan[] = $row_meja['no_meja'];
}

$pengguna_id = (int)$_SESSION['pengguna_id'] ? (int)$_SESSION['pengguna_id'] : 0;
$query = "SELECT pesanan.*, menu.nama, menu.foto, menu.harga FROM pesanan 
		  JOIN menu ON pesanan.menu_id = menu.id
		  WHERE pengguna_id = $pengguna_id AND no_pesanan = ''";
$result = mysqli_query($conn, $query);

$cek_pesanan_pelanggan = mysqli_query($conn, "SELECT * FROM pesanan WHERE status = 'Sedang Dipesan' AND pengguna_id = $pengguna_id");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$no_pesanan  = date('Ymd') . random_str();
	$no_meja 	 = escape($_POST['no_meja']);
	$pengguna_id = $_SESSION['pengguna_id'];

	if (mysqli_query($conn, "UPDATE pesanan SET no_meja = '$no_meja' WHERE pengguna_id = $pengguna_id AND status = 'Pesan'")) {

		$query = "UPDATE pesanan SET no_pesanan = '$no_pesanan', status = 'Sedang Dipesan' WHERE no_meja = $no_meja AND pengguna_id = $pengguna_id AND status = 'Pesan'";
		mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		redirect('transaksi-detail.php?no_pesanan=' . $no_pesanan);

	} else {
		die('Terjadi kesalahan: ' . mysqli_error($conn));
	}

}