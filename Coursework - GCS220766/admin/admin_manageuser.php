<?php 
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
try{
    $title = "Manage User's Account";
    $totalAuthors = totalAuthors($pdo);
    $manages = allAuthors($pdo);
    ob_start();
    include '../templates/admin_manageuser.html.php';
    $output_coursework = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occurred in admin page';
    $output_coursework = 'Error manage account: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';