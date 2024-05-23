<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TCC";

$conn = new mysqli($servername, $username, $password, $dbname);

if(!$conn){
    die("Sem sucesso...". mysqli_connect_error());
}
?>