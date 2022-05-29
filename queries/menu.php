<?php
require '../core.php';

$kategori = escape($_POST['kategori']);
$urutkan  = escape($_POST['urutkan']);

switch ($urutkan) {
	case 'terbaru':
		$sort_by = ' tgl_dibuat DESC';
		break;
	case 'terlama':
		$sort_by = ' tgl_dibuat ASC';
		break;
	case 'termahal':
		$sort_by = ' harga DESC';
		break;
	case 'termurah':
		$sort_by = ' harga ASC';
		break;
}

$query = "SELECT menu.*, kategori.nama as nama_kategori FROM menu 
		  JOIN kategori ON menu.kategori_id = kategori.id 
		  WHERE status = 1 ";
if (!empty($_POST['min']) && !empty($_POST['max'])) {
	$min = $_POST['min'];
	$max = $_POST['max'];
	$query .= "AND menu.harga between $min AND $max ";
}
if (!empty($_POST['keyword'])) {
	$keyword = $_POST['keyword'];
	$query .= "AND menu.nama LIKE '%$keyword%' ";
}

$query .= $kategori != 0 ? "AND kategori.id = '$kategori' " : " ";
$query .= "ORDER BY $sort_by";

$result = mysqli_query($conn, $query);
$total  = mysqli_num_rows($result);

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}

echo json_encode(['data' => $rows, 'total' => $total, 'sql' => $_POST['keyword']]);
