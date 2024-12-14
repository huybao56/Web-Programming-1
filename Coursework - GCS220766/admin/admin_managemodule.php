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
    $totalModules = totalModules($pdo);
    $manages = allModules($pdo);
    ob_start();
    include '../templates/admin_managemodule.html.php';
    $output_coursework = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occurred in admin page';
    $output_coursework = 'Error manage account: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';