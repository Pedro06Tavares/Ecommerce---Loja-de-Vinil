<?php 
$localhost ="127.0.0.1"; //servidor
$user = "root"; //usuario
$pwd =""; //senha ifsuldeminas
$dbname="loja"; //banco de dados loja
$port = 3306;
$conn = new mysqli($localhost, $user, $pwd, $dbname,$port);
if($conn->connect_error){
    die("Falha na conexão: " . $conn->connect_error);
}
else{
    echo "Conexão bem sucedida!";
}
