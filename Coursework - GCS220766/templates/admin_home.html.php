<?php echo"Hello" . " " .  $_SESSION['username'];?>
<p>Number of question: <?=$totalQuestions?></p>
<?php foreach($questions as $question): ?>
    <?php $display_date = date("D d M Y H:i:s", strtotime($question['questionDate']))?>
    <?php $picutre = !empty($question["picture"]);?>
    <?php $edit_delete = $question["username"] ;?>
    <blockquote>
    Author's Name: <?=htmlspecialchars($question["author_name"],ENT_QUOTES,'UTF-8')?> - Subject:
    <?=htmlspecialchars($question["module_name"],ENT_QUOTES,'UTF-8')?><br />
    Title: <?=htmlspecialchars($question["questionTitle"],ENT_QUOTES,'UTF-8')?><br />
    Question Content: <?=htmlspecialchars($question["questionText"],ENT_QUOTES,'UTF-8')?><br />
    Date: <?=htmlspecialchars($display_date,ENT_QUOTES,'UTF-8')?><br><br>

    <?php if($picutre):?>
    <img height="100px" src="../pictures/<?=$question['picture']?>"/><br><br>
    <?php else:?>
    <?php endif?>

        <a href="../admin/admin_editquestion.php?id=<?=$question['id']?>">Edit</a><br>
        <form action="../admin/admin_deletequestion.php" method="POST">
            <input type="hidden" name="id" value="<?=$question['id']?>">
            <input type="submit" value="Delete">
        </form><br>
    <?php foreach($comments as $comment):?>
    <?php $commentTime = date("d M Y H:i:s", strtotime($comment['commentTime']))?>
    <?php $edit_delete = $comment["username"] ;?>
    <?php $check = $comment['questionid']?>
    <?php if($check === $question['id']):?>
    <?=htmlspecialchars($comment["author_name"],ENT_QUOTES,'UTF-8')?> - 
    <?=htmlspecialchars($commentTime,ENT_QUOTES,'UTF-8')?><br>
    Comment: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars($comment["commentText"],ENT_QUOTES,'UTF-8')?><br />

        <?php if($edit_delete == $_SESSION["username"]):?>
            <a href="admin_editcomment.php?id=<?=$comment['id']?>">Edit Comment</a><br>
        <form action="admin_deletecomment.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$comment['id']?>">
            <input type="submit" value="Delete Comment">
        </form><br>
        <?php else:?>
            <br>
        <?php endif?>
        <?php else:?>
        <?php endif?>
        <?php endforeach; ?>  
    
    <form action="" method="POST">
    <?php if ($author): ?>
        <input type="hidden" name="authors" value="<?=htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8'); ?>">
    <?php else: ?>
        <h1>Your account is invalid</h1>
    <?php endif; ?>
        <input type="hidden" name="questionid" value="<?=htmlspecialchars($question['id'], ENT_QUOTES, 'UTF-8');?>">
        <textarea name="commentText" cols="50" rows="3" required placeholder="Your Comment"></textarea><br>
        <input type="submit" name="comment" value="Comment">
    </form>

    </blockquote>
    <br>
    <?php endforeach; ?>
