<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    deleteModule($pdo,$_POST['code']);
    header('location: admin_managemodule.php');
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output_coursework = 'Unable to connect to delete joke:' . $e->getMessage();
}
include '../templates/admin_layout.html.php';