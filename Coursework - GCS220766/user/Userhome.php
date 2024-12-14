<?php
session_start();
if (!isset($_SESSION["username"])){
    header("location:../index.php");
    exit();
}
else{
    try{
        include '../includes/DatabaseConnection.php';
        include '../includes/DataFunction.php';
        $title = 'Questions Web';
        $questions = allQuestions($pdo);
        $comments = allComments($pdo);
        $authors= allAuthors($pdo);
    
        $username = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
        $filteredAuthors = array_filter($authors, function($author) use ($username) {
            return $author['username'] === $username;});
        $author = !empty($filteredAuthors) ? array_shift($filteredAuthors) : null;

        if ($author) {
            $authorId = $author['id'];
            $sql = "SELECT comment.id, commentText, authorid, questionid, commentTime
                FROM comment
                WHERE comment.authorid = :authorId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':authorId', $authorId, PDO::PARAM_INT);
            $stmt->execute();
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $contacts = [];
        }

        ob_start();
        include '../templates/home.html.php';
        $output_coursework = ob_get_clean();
        if(isset($_POST["commentText"])){
            insertComment($pdo,$_POST['commentText'],$_POST['authors'],$_POST['questionid']);
            header('location:Userhome.php');
        }
    }catch(PDOException $e){
        $title = 'An error has occurred';
        $output_coursework = 'Database error: ' . $e->getMessage();
    }
    include '../templates/layout.html.php';

}