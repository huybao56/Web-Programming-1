<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
try{
    include '../includes/DatabaseConnection.php';
    include '../includes/DataFunction.php';
    $title = "Post requirements";
    $authors= allAuthors($pdo);
    
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
    $filteredAuthors = array_filter($authors, function($author) use ($username) {
        return $author['username'] === $username;});
    $author = !empty($filteredAuthors) ? array_shift($filteredAuthors) : null;
    
    if ($author) {
        $authorId = $author['id'];
        $sql = "SELECT contact.id, contactText, contactDate, contact.authorid, contactReply, replyTime 
                FROM contact
                WHERE contact.authorid = :authorId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':authorId', $authorId, PDO::PARAM_INT);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $contacts = [];
    }

    $contact = allContacts($pdo);
    ob_start();
    include '../templates/user_contact.html.php';
    $output_coursework = ob_get_clean();
}catch(PDOException $e){
    $title = 'An error has occurred';
    $output_coursework = 'Database error: ' . $e->getMessage();
}
if(isset($_POST["contactText"])){
    insertContact($pdo,$_POST["contactText"],$_POST["authors"]);
    header('location:user_contact.php');
}
include '../templates/layout.html.php';