<?php
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

$no_meja = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
$cek_no_meja = mysqli_query($conn, "SELECT no_meja FROM pesanan WHERE no_meja <> '' AND status = 'Pesan' OR status = 'Sedang Dipesan'");
$no_meja_digunakan = [];
while ($row_meja = mysqli_fetch_assoc($cek_no_meja)) {
	$no_meja_digunakan[] = $row_meja['no_meja'];
}

function total_bayar($menu_id, $jumlah) {
	global $conn;
	$result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $menu_id");
	$row = mysqli_fetch_assoc($result);
	return $row['harga'] * $jumlah;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
	redirect('admin/pesanan.php');
}

$menu_result = mysqli_query($conn, "SELECT * FROM menu WHERE status = 1");

$peg_id = escape($_GET['id']);

$cek_pesanan_pelanggan = mysqli_query($conn, "SELECT * FROM pesanan WHERE status = 'Sedang Dipesan' AND pengguna_id = $peg_id");
if (mysqli_num_rows($cek_pesanan_pelanggan) > 0) {
	$row_no_pesanan = mysqli_fetch_assoc($cek_pesanan_pelanggan);
	$no_pesanan = $row_no_pesanan['no_pesanan'];
}

$query = "SELECT pesanan.*, menu.nama, menu.foto, menu.harga FROM pesanan 
		  JOIN menu ON pesanan.menu_id = menu.id
		  WHERE pengguna_id = $peg_id AND no_pesanan = ''";
$result = mysqli_query($conn, $query);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$pengguna_id = escape($_POST['pengguna_id']);
	$menu_id 	 = escape($_POST['menu_id']);
	$jumlah 	 = escape($_POST['jumlah']);

	if (empty($menu_id)) {
		$errors[] = "Menu pesanan wajib diisi!";
	}

	if (empty($jumlah)) {
		$errors[] = "Jumlah pesanan wajib diisi!";
	} elseif (!preg_match('/^[0-9]*$/', $jumlah)) {
		$errors[] = "Jumlah pesanan hanya boleh angka!";
	}

	if (empty($errors)) {
		
		$cek_pesanan_pelanggan = mysqli_query($conn, "SELECT * FROM pesanan WHERE pengguna_id = $pengguna_id AND menu_id = $menu_id AND no_pesanan = ''");
		if (mysqli_num_rows($cek_pesanan_pelanggan) > 0) {
			$row_pesanan_pelanggan = mysqli_fetch_assoc($cek_pesanan_pelanggan);
			$jumlah += $row_pesanan_pelanggan['jumlah'];
			$total_bayar = total_bayar($menu_id, $jumlah);
			$query = "UPDATE pesanan SET jumlah = '$jumlah', total_bayar = '$total_bayar' WHERE pengguna_id = $pengguna_id AND menu_id = $menu_id AND no_pesanan = ''";
		} else {
			$total_bayar = total_bayar($menu_id, $jumlah);
			$query = "INSERT INTO pesanan (pengguna_id, menu_id, jumlah, total_bayar, status) VALUES ('$pengguna_id', '$menu_id', '$jumlah', '$total_bayar', 'Pesan')";
		}
		
		if (mysqli_query($conn, $query)) {
			
			flash('message', 'Pesanan baru berhasil disimpan!');
			redirect('admin/pesanan-pelanggan.php?id=' . $pengguna_id);

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	} else {
		$err = '';
		foreach ($errors as $error) {
			$err .= '<p class="mb-0">'. $error .'</p>';
		}
		flash('message', $err, 'danger');
		redirect('admin/pesanan-pelanggan.php?id=' . $pengguna_id);
	}

}