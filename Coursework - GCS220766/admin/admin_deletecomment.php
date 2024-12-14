<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    deleteComment($pdo,$_POST['id']);
    header('location: admin.php');
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output_coursework = 'Unable to connect to delete question:' . $e->getMessage();
}
include '../templates/admin_layout.html.php';