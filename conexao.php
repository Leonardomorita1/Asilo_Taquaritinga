<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "bd_asilo";

$conexao = new mysqli($server, $username, $password, $db_name);

if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}



?>