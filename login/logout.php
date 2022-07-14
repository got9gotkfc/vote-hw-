<?php
include "./connect.php";
$_SESSION=array();
unset($_SESSION);
header("location:../index.php");
?>