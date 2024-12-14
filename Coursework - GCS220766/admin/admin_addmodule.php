<?php 
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
if (isset($_POST['addmodule'])) {
    try {
        $title = "Manage Module";
        insertModule($pdo, $_POST['code'], $_POST['moduleName']);

        $message = 'The module has been successfully added.';
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        ob_start();
        echo "<script>
            alert('$message');
            window.location = 'admin_managemodule.php';
        </script>";
        ob_end_flush(); 
        exit();
    } catch (PDOException $e) {
        $title = 'An error has occurred on the admin page';
        $error_message = 'Error managing account: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        ob_start();
        echo "<script>
            alert('$error_message');
            window.location = 'admin_addmodule.php';
        </script>";
        ob_end_flush();
        exit();
    }
} else {
    $title = "Create Module";
    ob_start();
    include '../templates/admin_addmodule.html.php';
    $output_coursework = ob_get_clean();
}

include '../templates/admin_layout.html.php';
