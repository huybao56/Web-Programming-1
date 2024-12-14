<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    $title = "Post requirements";
    $contacts = allContacts($pdo);
    $totalContacts = totalContacts($pdo);
    ob_start();
    include '../templates/admin_contact.html.php';
    $output_coursework = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occurred';
    $output_coursework = 'Database error: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';