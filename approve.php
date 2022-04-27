<?php
include 'config.php';
if (!empty($_GET['file'])) {
    $filid = $_GET['file'];
    $sql = "UPDATE stories SET is_approuved=1 WHERE id='" . $filid . "'";
    if (mysqli_query($conn, $sql)) {
        header("location:admin_feed.php");
    } else {
        header("location:admin_feed.php");
    }
}
?>