<?php 
require 'core.php';

unset($_SESSION['pengguna_id']);
unset($_SESSION['pengguna_nama']);
unset($_SESSION['pengguna_foto']);
unset($_SESSION['pengguna_level']);

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

flash('message', 'Logout berhasil!');
redirect();
?>