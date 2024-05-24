<?php
$servername = "localhost";
$username = "root";
$password = "21009";
$dbname = "TCC";

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn){
    die("Sem sucesso...". mysqli_connect_error());
}
?>