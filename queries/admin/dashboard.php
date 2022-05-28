<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$query = "SELECT * FROM pengguna";

if ($_SESSION['pengguna_level'] == 2) {
	$query .= " WHERE level_id = 3";
}

$pengguna_result 	= mysqli_query($conn, $query);
$kategori_result 	= mysqli_query($conn, "SELECT * FROM kategori");
$menu_result 		= mysqli_query($conn, "SELECT * FROM menu");
$pesanan_result 	= mysqli_query($conn, "SELECT * FROM pesanan WHERE status = 'Sedang Dipesan'");
