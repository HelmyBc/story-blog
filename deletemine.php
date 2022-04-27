<?php
include 'config.php';
if (!empty($_GET['file'])) {
    $filid = $_GET['file'];
    $sql = "DELETE FROM `stories` WHERE id='" . $filid . "'";
    if (mysqli_query($conn, $sql)) {
        header("location:feed.php");
    } else {
        header("location:feed.php");
    }
}
?>