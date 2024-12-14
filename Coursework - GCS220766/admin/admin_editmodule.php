<?php 
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
try{
    if(isset($_POST['code'])){
        $title = 'Edit Module';
        editModule($pdo,$_POST['module_name'],$_POST['code']);
        header('location: admin_managemodule.php');
    }else{
        $title = 'Edit Module';
        $manages = getModule($pdo, $_GET['code']);
        ob_start();
        include '../templates/admin_editmodule.html.php';
        $output_coursework = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output_coursework = 'Error editing user account: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';