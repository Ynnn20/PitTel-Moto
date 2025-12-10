<?php
// pages/pelanggan/hapus.php
require_once '../../auth/auth_check.php';
require_once '../../config/database.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = "DELETE FROM pelanggan WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header('Location: index.php?msg=deleted');
    } else {
        header('Location: index.php?msg=error');
    }
} else {
    header('Location: index.php');
}
exit();
?>