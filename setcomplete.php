<?php
session_start();

	error_reporting(E_ALL); ini_set('display_errors', 1); 
	date_default_timezone_set("Asia/Manila");

	include 'conn.php';
	$db = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($link));

	$user = $db->query("UPDATE `tbltransactions` SET `status`=1 WHERE ".$_GET['id'])->fetch_object();
	echo "<script type='text/javascript'>window.location = 'adminacct.php'</script>";






?>