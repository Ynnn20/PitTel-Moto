<?php
// pages/servis/hapus.php
require_once '../../auth/auth_check.php';
require_once '../../config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = "DELETE FROM servis WHERE id = $id";
    mysqli_query($conn, $query);
}

header('Location: index.php');
exit();
?>