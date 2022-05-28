<?php 
if (!isset($_SESSION['pengguna_id'])) {
	redirect('login.php');
} elseif ($_SESSION['pengguna_level'] == 3) {
	redirect();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
	redirect('admin/menu.php');
}

$id = escape($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM menu WHERE id = $id");

if (mysqli_num_rows($result) < 1) {
	redirect('admin/menu.php');
}

$row = mysqli_fetch_assoc($result);
$kategori_result = mysqli_query($conn, "SELECT * FROM kategori");

$nama 		 = $nama_err 		= "";
$kategori_id = $kategori_id_err = "";
$harga 		 = $harga_err 		= "";
$komposisi 	 = $komposisi_err 	= "";
$deskripsi 	 = $deskripsi_err 	= "";
$foto 	 	 = $foto_err 		= "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$id 		 = escape($_POST['id']);
	$nama 		 = escape($_POST['nama']);
	$kategori_id = escape($_POST['kategori_id']);
	$harga 		 = escape($_POST['harga']);
	$komposisi 	 = escape($_POST['komposisi']);
	$deskripsi 	 = escape($_POST['deskripsi']);
	$foto_lama 	 = escape($_POST['foto_lama']);
	$status 	 = isset($_POST['status']) ? 1 : 0;

	$cek_menu = mysqli_query($conn, "SELECT * FROM menu WHERE nama = '$nama' AND id <> $id");
	if (empty($nama)) {
		$nama_err = "Nama menu wajib diisi!";
	} elseif (!preg_match("/^[a-z0-9A-Z-' ]*$/", $nama)) {
		$nama_err = "Nama menu hanya boleh mengandung huruf, angka dan spasi!";
	} elseif (mysqli_num_rows($cek_menu) > 0) {
		$nama_err = "Menu: $nama sudah terdaftar!";
	}

	if (empty($kategori_id)) {
		$kategori_id_err = "Kategori wajib diisi!";
	}

	if (empty($harga)) {
		$harga_err = "Harga wajib diisi!";
	} elseif (!preg_match("/^[0-9]*$/", $harga)) {
		$harga_err = "Harga hanya boleh mengandung angka!";
	}

	if (empty($komposisi)) {
		$komposisi_err = "Komposisi wajib diisi!";
	}

	if (empty($deskripsi)) {
		$deskripsi_err = "Deskripsi wajib diisi!";
	}

	if (empty($_FILES['foto']['name'])) {
		$foto = $foto_lama;
	} else {
		$foto = random_str() . '_' . $_FILES['foto']['name'];

		if ($_FILES['foto']['size'] > 2048000) {
			$foto_err = "File yang diupload tidak boleh lebih dari 2MB!";
		}

		$ext = ['jpg', 'png', 'jpeg', 'svg'];
		$foto_ext = explode('.', $foto);
		$foto_ext = strtolower(end($foto_ext));

		if (!in_array($foto_ext, $ext)) {
			$foto_err = "Format file yang dapat upload ( jpg / png / jpeg / svg )";
		}

		if (empty($nama_err) && empty($kategori_id_err) && empty($harga_err) && empty($komposisi_err) && empty($deskripsi_err) && empty($foto_err)) {

			if ($foto_lama != 'default.svg') {
				$file = ROOT_PATH . 'uploads/' . $foto_lama;
				unlink($file);
			}
			move_uploaded_file($_FILES['foto']['tmp_name'], ROOT_PATH . 'uploads/' . $foto);

		} else {
			$foto = $foto_lama;
		}
	}

	if (empty($nama_err) && empty($kategori_id_err) && empty($harga_err) && empty($komposisi_err) && empty($deskripsi_err) && empty($foto_err)) {
		
		$query = "UPDATE menu SET nama = '$nama', kategori_id = '$kategori_id', harga = '$harga', komposisi = '$komposisi', deskripsi = '$deskripsi', foto = '$foto', status = '$status' 
				  WHERE id = $id";

		if (mysqli_query($conn, $query)) {

			flash('message', 'Data menu berhasil diupdate!');
			redirect('admin/menu.php');

		} else {
			die('Terjadi kesalahan: ' . mysqli_error($conn));
		}

	}

}