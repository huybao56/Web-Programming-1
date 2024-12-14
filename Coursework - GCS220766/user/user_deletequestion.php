<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    deleteImage($pdo,$_POST['id']);
    deleteQuestion($pdo,$_POST['id']);
    header('location: Userhome.php');
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output_coursework = 'Unable to connect to delete question:' . $e->getMessage();
}
include '../templates/layout.html.php';