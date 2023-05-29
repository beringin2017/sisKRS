<?php
include 'koneksi.php';
if (isset($_GET['nip'])) {
    $delete = mysqli_query($conn, "DELETE FROM tb_dosen WHERE nip = '".$_GET['nip']."' ");
    if ($delete) {
        session_start();
        $_SESSION['message'] = "Data deleted successfully";
        header('Location: index-dosen.php');
        exit();
    } else {
        // Handle deletion failure
    }
}
?>