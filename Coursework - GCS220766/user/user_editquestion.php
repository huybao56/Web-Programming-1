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
        $title = 'Edit Question';
        editQuestion($pdo,$_POST['questionTitle'],$_POST['questionText'],$_POST['id']);
        header('location: Userhome.php');
    }else{
        $title = 'Edit Question';
        $questions = getQuestion($pdo, $_GET['id']);
        ob_start();
        include '../templates/editquestion.html.php';
        $output_coursework = ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error has occurred";
    $output_coursework = 'Error editing question: ' . $e->getMessage();
}
include '../templates/layout.html.php';