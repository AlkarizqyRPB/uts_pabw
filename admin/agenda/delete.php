<?php
include_once("../../config.php");
$id = $_GET['id'];
$sql = "DELETE FROM agenda WHERE id=$id";
$result = mysqli_query($mysqli, $sql);
echo "<script>alert('Data berhasil dihapus')</script>";
echo "<script>window.location.replace('index.php')</script>";
