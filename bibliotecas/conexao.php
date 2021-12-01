<?php

$username= "root";
$password= '';
$banco= "marcondes";
$host= "localhost";

try{
    $conn = new PDO("mysql:host={$host};dbname={$banco}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro: {$e->getMessage()}";
}

    

?>