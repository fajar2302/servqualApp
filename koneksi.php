<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'kuisioner_db';
$koneksi = mysqli_connect($host, $user, $password, $database);


include 'function/function.php';
include 'function/reliabel-function.php';
include 'function/reliabel.php';
include 'function/countResultPrepHar.php';
include 'function/servqual-func.php';
include 'function/cekkuis.php';
