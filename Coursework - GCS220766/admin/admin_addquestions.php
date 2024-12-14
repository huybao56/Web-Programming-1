<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
include '../includes/DatabaseConnection.php';
include '../includes/DataFunction.php';
if (isset($_POST["questionText"])) {
    $img_name = null;
    if (isset($_FILES["upload"]) && $_FILES["upload"]["error"] === 0) {
        $img_name = $_FILES["upload"]["name"];
        $img_size = $_FILES["upload"]["size"];
        $tmp_name = $_FILES["upload"]["tmp_name"];
        $error = $_FILES["upload"]["error"];

        if ($error === 0) {
            if ($img_size > 2097152) {
                $output_coursework = "The file is too large";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../pictures/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $img_name = $new_img_name;
                    try {
                        $title = "Adding questions"; 
                        insertQuestion($pdo,$_POST['questionTitle'],$_POST['questionText'],$_POST['authors'],$_POST['modules'],$img_name);
                        header('Location: admin.php');
                        exit;
                    } catch (PDOException $e) {
                        $title = 'An error has occurred';
                        $output_coursework = 'Database error: ' . htmlspecialchars($e->getMessage());
                    }
                } else {
                    $output_coursework = "Cannot upload this type of file";
                    $img_name = null;
                    echo "<script>alert('The file upload is invalid')</script>
			        <script>window.location = 'admin_addquestions.php'</script>";
                }
            }
        } else {
            $output_coursework = "Error uploading file";
        }
    }else{
        try {
        $title = "Adding questions"; 
        insertQuestion($pdo,$_POST['questionTitle'],$_POST['questionText'],$_POST['authors'],$_POST['modules'],$img_name);
        header('Location: admin.php');
        exit;
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output_coursework = 'Database error: ' . htmlspecialchars($e->getMessage());
    }}
} else {
    $title = 'Adding questions';
    

    $authors= allAuthors($pdo);
    
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
    $filteredAuthors = array_filter($authors, function($author) use ($username) {
        return $author['username'] === $username;});
    $author = !empty($filteredAuthors) ? array_shift($filteredAuthors) : null;

    $modules = allModules($pdo);
    ob_start();
    include '../templates/admin_questions.html.php';
    $output_coursework = ob_get_clean();
}
include '../templates/admin_layout.html.php';