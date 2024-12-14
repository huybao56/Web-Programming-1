<?php
session_start(); 
include "includes/DatabaseConnection.php";
include "includes/DataFunction.php";
if (isset($_POST['Register'])){
    try{
        registerAndHandle($pdo,$_POST['fullname'],$_POST['email'],$_POST['username'],$_POST['password']);
    }catch(PDOException $e){
        echo "Error" . $e->getMessage();
    }
}