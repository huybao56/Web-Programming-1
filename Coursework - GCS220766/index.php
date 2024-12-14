<?php
try{
    include 'includes/DatabaseConnection.php';
    include 'includes/DataFunction.php';
    $title = 'Questions Web of Guest';
    $questions_guest = allQuestions($pdo);
    $comment_guest = allComments($pdo);
    ob_start();
    include 'templates/guest_home.html.php';
    $output_coursework = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occurred';
    $output_coursework = 'Database error: ' . $e->getMessage();
}
include 'templates/guest_layout.html.php';