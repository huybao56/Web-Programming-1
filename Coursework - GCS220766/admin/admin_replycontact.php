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
        $title = 'Reply Contact';
        replyContact($pdo,$_POST['contactReply'],$_POST['id']);
        header('location: admin_contact.php');
    }else{
        $title = 'Reply Contact';
        $contacts = getContact($pdo,$_GET['id']);
        ob_start();
        include '../templates/admin_replycontact.html.php';
        $output_coursework = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output_coursework = 'Error reply question: ' . $e->getMessage();
}
include '../templates/admin_layout.html.php';