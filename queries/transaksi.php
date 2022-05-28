<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
}

$pengguna_id = $_SESSION['pengguna_id'];
$query = "SELECT pesanan.*, pembayaran.tgl_bayar FROM pesanan 
		  LEFT JOIN pembayaran USING (no_pesanan)
		  WHERE pengguna_id = $pengguna_id GROUP BY no_pesanan ORDER BY pembayaran.tgl_bayar DESC";
$result = mysqli_query($conn, $query);