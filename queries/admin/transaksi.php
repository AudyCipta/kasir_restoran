<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$query = "SELECT pesanan.*, pengguna.nama FROM pesanan 
		  JOIN pengguna ON pesanan.pengguna_id = pengguna.id 
		  WHERE pesanan.status IN ('Sedang Dipesan', 'Lunas')
		  GROUP BY pesanan.no_pesanan";
$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$totalmin = $_POST['totalmin'];
	$totalmax = $_POST['totalmax'];

	$query = "SELECT SUM(menu.harga*jumlah) AS total, pesanan.*, pengguna.nama 
			FROM pesanan
			JOIN menu ON menu.id = pesanan.menu_id
			JOIN pengguna ON pesanan.pengguna_id = pengguna.id 
			WHERE pesanan.status IN ('Sedang Dipesan', 'Lunas')
			GROUP BY no_pesanan
			HAVING total > 51000 AND total < 100000;";
	$result = mysqli_query($conn, $query);
}
