<?php 
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
if(isset($_POST['adduser'])){
    try{
        $title = "Manage User's Account";
        insertUser($pdo,$_POST['authorName'],$_POST['Email'],$_POST['Account'],$_POST['Password']);

        $message = 'The account has been successfully added.';
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        ob_start();
        echo "<script>
            alert('$message');
            window.location = 'admin_manageuser.php';
        </script>";
        ob_end_flush(); 
        exit();
    }catch(PDOException $e){
        $title = 'An error has occurred in admin page';
        $output_coursework = 'Error manage account: ' . $e->getMessage();
    }
}else{
    $title = "Create User Account";
    ob_start();
    include '../templates/admin_adduser.html.php';
    $output_coursework = ob_get_clean();
}
include '../templates/admin_layout.html.php';