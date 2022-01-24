<?php
include '../meta.php';
if(!empty($_POST)) {
  $notid = $_POST['idnotify'];
mysqli_query($conn, "DELETE FROM `notify` WHERE `notify`.`id` = '$notid'");
}