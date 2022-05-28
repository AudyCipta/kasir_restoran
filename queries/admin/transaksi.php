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
