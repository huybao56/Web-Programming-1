<?php 
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
try{
    if(isset($_POST['id'])){
        $title = 'Edit User Account';
        editUser($pdo,$_POST['authorName'],$_POST['Email'],$_POST['Usertype'],$_POST['id']);
        header('location: admin_manageuser.php');
    }else{
        $title = 'Edit User Account';
        $manages = getUser($pdo, $_GET['id']);
        ob_start();
        include '../templates/admin_edituser.html.php';
        $output_coursework = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output_coursework = 'Error editing user account: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';