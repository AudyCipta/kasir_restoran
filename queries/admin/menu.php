<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$result = mysqli_query($conn, "SELECT * FROM menu");