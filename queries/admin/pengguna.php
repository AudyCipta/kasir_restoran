<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$query = "SELECT pengguna.*, level.nama as nama_level FROM pengguna JOIN level ON pengguna.level_id = level.id";

if ($_SESSION['pengguna_level'] == 2) {
	$query = "SELECT pengguna.*, level.nama as nama_level FROM pengguna JOIN level ON pengguna.level_id = level.id WHERE level.id = 3";
}

$result = mysqli_query($conn, $query);