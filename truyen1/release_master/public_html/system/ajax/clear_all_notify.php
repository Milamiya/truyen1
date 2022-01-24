<?php
include '../meta.php';
if (isset($_SESSION['id']) == true) {
    $usrid = $_SESSION['id'];
} else {
    $usrid = $_COOKIE['id'];
}
if (empty($_POST)) {
	mysqli_query($conn, "DELETE FROM `notify` WHERE `notify`.`for_id` = '$usrid'");
}