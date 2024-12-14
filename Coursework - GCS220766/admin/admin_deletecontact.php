<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try {
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    deleteContact($pdo,$_POST['id']);
    header('location: admin_contact.php');
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output_coursework = 'Unable to connect to delete joke:' . $e->getMessage();
}
include '../templates/admin_layout.html.php';