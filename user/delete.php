<?php
include('../include/db.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM user WHERE id = $id") or die('Query Error');

header('Location: ../dashboard.php');
