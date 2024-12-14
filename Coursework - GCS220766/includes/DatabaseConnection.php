<?php 

    $pdo = new PDO("mysql:host=localhost; dbname=gcs220766_coursework; charset=utf8mb4","root","");
if (!$pdo){
    die ("Failed to connect database");
}
?>