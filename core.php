<?php
session_start();
require 'config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Error: ' . mysqli_connect_error());

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
}

function escape($str) {
	global $conn;
	return mysqli_real_escape_string($conn, trim($str));
}

function base_url($path = '') {
	$path = ltrim($path, '/');
	return BASE_URL . $path;
}

function flash($name, $message = '', $class = 'success') {
	if ($message) {
		if (isset($_SESSION[$name])) {
			unset($_SESSION[$name]);
		}
		if (isset($_SESSION[$name . '_class'])) {
			unset($_SESSION[$name . '_class']);	
		}

		$_SESSION[$name] = $message;
		$_SESSION[$name . '_class'] = $class;
	} elseif (!$message && isset($_SESSION[$name])) {
		$class = isset($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';

		echo '<div class="alert alert-'. $class .' alert-dismissible fade show" role="alert">
				  	' . $_SESSION[$name] . '
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    	<span aria-hidden="true">&times;</span>
					</button>
			  </div>';

		unset($_SESSION[$name]);
		unset($_SESSION[$name . '_class']);
	}
}

function redirect($url = '')
{
	$url = ltrim($url, '/');
	header('Location: ' . BASE_URL . $url);
	exit;
}

function random_str($length = 8)
{
	$string = 'ABCDEHIJKLMNPQRSTUVWXYZ123456789';
	return substr(str_shuffle($string), 0, $length);
}

function total_pesanan()
{
	global $conn;
	$pengguna_id = isset($_SESSION['pengguna_id']) ? $_SESSION['pengguna_id'] : 0;
	$result = mysqli_query($conn, "SELECT * FROM pesanan WHERE no_pesanan = '' AND pengguna_id = $pengguna_id");
	return mysqli_num_rows($result);
}