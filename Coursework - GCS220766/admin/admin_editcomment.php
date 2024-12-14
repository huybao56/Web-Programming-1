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
        $title = 'Edit Comment';
        editComment($pdo,$_POST['commentText'],$_POST['id']);
        header('location: admin.php');
    }else{
        $title = 'Edit Comment';
        $comments = getComment($pdo, $_GET['id']);
        ob_start();
        include '../templates/editcomment.html.php';
        $output_coursework = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output_coursework = 'Error editing question: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';