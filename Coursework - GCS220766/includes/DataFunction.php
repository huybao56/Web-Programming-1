<?php 
function query($pdo,$sql,$parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}
    
function totalQuestions($pdo){
    $query = query($pdo,'SELECT COUNT(*) total FROM questions');
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function totalContacts($pdo){
    $query = query($pdo,'SELECT COUNT(*) total FROM contact');
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function totalAuthors($pdo){
    $query = query($pdo,"SELECT COUNT(*) total FROM author");
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function totalModules($pdo){
    $query = query($pdo,"SELECT COUNT(*) total FROM module");
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

function allQuestions($pdo){
    $questions = query($pdo,"SELECT questions.id, questionTitle,questionText, questionDate, authorid, author.author_name, 
        author.username, module.module_name, module.code, picture, author.usertype
        FROM questions
        JOIN author ON questions.authorid = author.id
        JOIN module ON questions.modulecode = module.code
        ORDER BY questions.id desc");
    return $questions->fetchAll();
}

function allComments($pdo){
    $comments = query($pdo,"SELECT comment.id, commentText, comment.authorid, questionid, commentTime, author.author_name, author.username
    FROM comment
    JOIN author ON comment.authorid = author.id
    JOIN questions ON comment.questionid = questions.id");
    return $comments->fetchAll();
}
function allAuthors($pdo){
    $authors = query($pdo,"SELECT * FROM author");
    return $authors->fetchAll(PDO::FETCH_ASSOC);
}

function allModules($pdo){
    $modules = query($pdo,"SELECT * FROM module");
    return $modules->fetchAll();
}

function allContacts($pdo){
    $contacts = query($pdo,"SELECT contact.id, contactText, contactDate, authorid, author.author_name, contactDate, contactReply, replyTime
            FROM contact
            JOIN author ON contact.authorid = author.id
            ORDER BY contact.id asc");
    return $contacts->fetchAll();
}

function insertQuestion($pdo,$title,$text,$authorid,$module_code, ?string $picture = null){
    $query = "INSERT INTO questions SET
        questionTitle = :Title,
        questionText = :Text,
        questionDate = CURRENT_TIMESTAMP(),
        authorid = :authorid,
        modulecode = :module_code,
        picture = :picture;";
    $parameters = [':Title'=>$title,':Text'=>$text,'authorid'=>$authorid,':module_code'=>$module_code,':picture'=>$picture];
    query($pdo,$query,$parameters);
}

function insertContact($pdo,$contactText,$authorid){
    $query = "INSERT INTO contact SET
    contactText = :contactText,
    contactDate = current_timestamp(),
    authorid = :authorid";
    $parameters = [':contactText'=>$contactText,':authorid'=>$authorid];
    query($pdo,$query,$parameters);
}

function insertComment($pdo,$commentText,$authorid,$questionid){
    $query = "INSERT INTO comment SET
    commentText = :commentText,
    commentTime = current_timestamp(),
    authorid = :authorid,
    questionid = :questionid";
    $parameters = [':commentText'=>$commentText,':authorid'=>$authorid,':questionid'=>$questionid];
    query($pdo,$query,$parameters);
}

function insertModule($pdo,$code,$module_name){
    $parameters = [':code' => $code];
    $check = query($pdo, "SELECT COUNT(*) FROM module WHERE code = :code", $parameters);
    $moduleExists = $check->fetchColumn() > 0;
    if ($moduleExists) {
         echo "<script>
            alert('This module already exists');
            window.location = 'admin_addmodule.php';
            </script>";
        return;
    }

    $parameters = [':code'=>$code,':module_name'=>$module_name];
    $addmodule = query($pdo,"INSERT INTO module SET
    code = :code,
    module_name = :module_name"
    ,$parameters);
    if ($addmodule->rowCount() > 0){
        echo "<script>
        alert('Congratulations, the module\'s code is added);
        window.location = 'admin_managemodule.php';
        </script>";
    }
}

function insertUser($pdo,$fullname,$email,$username,$password){
    $parameters = [':username' => $username];
    $check = query($pdo, "SELECT COUNT(username) FROM author WHERE username = :username", $parameters);
    $accountExists = $check->fetchColumn() > 0;
    if ($accountExists) {
         echo "<script>
            alert('This account already exists');
            window.location = 'admin_adduser.php';
            </script>";
        return;
    }
    $parameters = [':fullname'=>$fullname,':email'=>$email,':username'=>$username,':password'=>$password];
    $adduser = query($pdo,"INSERT INTO `author` SET
    author_name = :fullname,
    author_email = :email,
    username = :username,
    password = :password,
    registerTime = current_timestamp()",$parameters);
    if ($adduser->rowCount() > 0) {
        echo "<script>
        alert('Congratulations, the account\'s username is registered);
        window.location = 'admin_adduser.php';
        </script>";
    }
}

function deleteQuestion($pdo,$id){
    $parameters = ['id'=>$id];
    query($pdo,"DELETE FROM questions WHERE id = :id",$parameters);
}

function deleteImage($pdo,$id): bool{
    $parameters = ['id'=>$id];
    $query = query($pdo,"SELECT picture FROM questions WHERE id = :id",$parameters);
    $rows = $query->fetch(PDO::FETCH_ASSOC);
    if ($rows && !empty($rows['picture'])) {
        $path = realpath('../pictures/' . $rows['picture']);
        if (file_exists($path)) {
            return unlink($path);
        }
    }
    return false;
}

function deleteContact($pdo,$id){
    $parameters = ['id'=>$id];
    query($pdo,"DELETE FROM contact WHERE id = :id",$parameters);
}

function deleteUser($pdo,$id){
    $parameters = ['id' => $id];
    $query = query($pdo, "SELECT id, picture, authorid FROM questions WHERE authorid = :id", $parameters);
    $questionIds = $query->fetchAll(PDO::FETCH_COLUMN);
    foreach ($questionIds as $questionId) {
        deleteImage($pdo, $questionId);
        deleteQuestion($pdo, $questionId);
        deleteComment($pdo,$questionId);
    }
    $parameters = ['id'=>$id];
    query($pdo,"DELETE FROM author WHERE id = :id",$parameters);
    deleteContact($pdo,$id);
}

function deleteModule($pdo,$module_code){
    $parameters = [':modulecode' => $module_code];
    $query = query($pdo, "SELECT id, picture, modulecode FROM questions WHERE modulecode = :modulecode", $parameters);
    $questionIds = $query->fetchAll(PDO::FETCH_COLUMN);
    foreach ($questionIds as $questionId) {
        deleteImage($pdo, $questionId);
        deleteQuestion($pdo, $questionId);
        deleteComment($pdo,$questionId);
    }
    $parameters = [':module_code'=>$module_code];
    query($pdo,"DELETE FROM module WHERE code = :module_code",$parameters);
}

function deleteComment($pdo,$id){
    $parameters = ['id'=>$id];
    query($pdo,"DELETE FROM comment WHERE id = :id",$parameters);
}

function editQuestion($pdo,$title,$text,$id){
    $query = "UPDATE questions SET 
    questionTitle = :questionTitle,
    questionText = :questionText 
    WHERE id = :id";
    $parameters = [':questionTitle'=>$title,'questionText'=>$text,':id'=>$id];
    query($pdo,$query,$parameters);
}

function editUser($pdo,$name,$email,$type,$id){
    $query = "UPDATE author SET 
    author_name = :name,
    author_email = :email,
    usertype = :type,
    editTime = current_timestamp()
    WHERE id = :id";
    $parameters = [':name'=>$name,':email'=>$email,':type'=>$type,':id'=>$id];
    query($pdo,$query,$parameters);
}

function editModule($pdo,$module_name,$module_code){
    $query = "UPDATE module SET 
    module_name = :module_name
    WHERE code = :module_code";
    $parameters = [':module_name'=>$module_name,':module_code'=>$module_code];
    query($pdo,$query,$parameters);
}

function editComment($pdo,$commentText,$id){
    $query = "UPDATE comment SET 
    commentText = :commentText
    WHERE id = :id";
    $parameters = [':commentText'=>$commentText,':id'=>$id];
    query($pdo,$query,$parameters);
}


function replyContact($pdo,$reply,$id){
    $query = "UPDATE contact SET 
    contactReply = :contactReply,
    replyTime = CURRENT_TIMESTAMP()
    WHERE id = :id";
    $parameters = ['contactReply'=>$reply,':id'=>$id];
    query($pdo,$query,$parameters);
}

function getQuestion($pdo,$id){
    $parameters = [':id'=>$id];
    $query = query($pdo,"SELECT * FROM questions WHERE id = :id",$parameters);
    return $query->fetch();
}

function getComment($pdo,$id){
    $parameters = [':id'=>$id];
    $query = query($pdo,"SELECT * FROM comment WHERE id = :id",$parameters);
    return $query->fetch();
}

function getContact($pdo,$id){
    $parameters = [':id'=>$id];
    $query = query($pdo,"SELECT * FROM contact WHERE id = :id",$parameters);
    return $query->fetch();
}

function getUser($pdo,$id){
    $parameters = [':id'=>$id];
    $query = query($pdo,"SELECT * FROM author WHERE id = :id",$parameters);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getModule($pdo,$module_code){
    $parameters = [':module_code'=>$module_code];
    $query = query($pdo,"SELECT * FROM module WHERE code = :module_code",$parameters);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function loginAndHandle($pdo,$username,$password): void{
    $parameters = [':username'=>$username,':password'=>$password];
    $query = query($pdo,"SELECT * FROM `author` WHERE username = :username AND password = :password",$parameters);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION["username"] = $user['username'];
        if ($user['usertype'] === "User") {
            header('Location: user/Userhome.php');
            exit(); //For not going ahead more code
        } elseif ($user['usertype'] === "Admin") {
            header('Location: admin/admin.php');
            exit();
        }
    } else {
        echo "<script>alert('Invalid username or password')</script>
        <script>window.location = 'index.php'</script>";
    }
}

function registerAndHandle($pdo,$fullname,$email,$username,$password): void{
    $parameters = [':username'=>$username];
    $check = query($pdo,"SELECT COUNT(*) FROM `author` WHERE username = :username",$parameters);
    $account = $check->fetchColumn() > 0;
    if ($account){
        echo "<script>alert('This account has existed')</script>
        <script>window.location = 'login.php'</script>";
        return;
    }
    $parameters = [':fullname'=>$fullname,':email'=>$email,':username'=>$username,':password'=>$password];
    $register = query($pdo,"INSERT INTO `author` SET
    author_name = :fullname,
    author_email = :email,
    username = :username,
    password = :password,
    registerTime = current_timestamp()",$parameters);
    if($register->rowCount()>0){
        session_start();
        $_SESSION["username"] = $username;
        echo "<script>
            alert('Congratulations, the account\'s username is registered');
            window.location = 'user/Userhome.php';
            </script>";
    }else{
        echo "<script>alert('Sorry, failed to register. Try again')</script>
        <script>window.location = 'register.php'</script>";
    }
}