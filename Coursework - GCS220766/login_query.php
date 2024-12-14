<?php
session_start(); 
include "includes/DatabaseConnection.php";
include "includes/DataFunction.php";
if (isset($_POST['Login'])){
    try{
        loginAndHandle($pdo,$_POST['username'],$_POST['password']);
    }catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }
}