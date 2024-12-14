<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 
</head>
<body>
    <main class="container-fluid py-3 px-3">
        <h6>Hello Guest.</h6><br>

        <?php foreach($questions_guest as $question): ?>
            <?php $display_date = date("D d M Y H:i:s", strtotime($question['questionDate']))?>
            <?php $picutre = !empty($question["picture"]);?>
            <blockquote>
            Author's Name: <?=htmlspecialchars($question["author_name"],ENT_QUOTES,'UTF-8')?> - Subject:
            <?=htmlspecialchars($question["module_name"],ENT_QUOTES,'UTF-8')?><br />
            Title: <?=htmlspecialchars($question["questionTitle"],ENT_QUOTES,'UTF-8')?><br />
            Question Content: <?=htmlspecialchars($question["questionText"],ENT_QUOTES,'UTF-8')?><br />
            Date: <?=htmlspecialchars($display_date,ENT_QUOTES,'UTF-8')?><br>

            <?php if($picutre):?>
            <br> <img height="100px" src="pictures/<?=$question['picture']?>"/><br><br>
            <?php else:?>
                <br>
            <?php endif?>
            
            <?php foreach($comment_guest as $comment):?>
            <?php $commentTime = date("d M Y H:i:s", strtotime($comment['commentTime']))?>
            <?php $check = $comment['questionid']?>
            <?php if($check === $question['id']):?>
            <?=htmlspecialchars($comment["author_name"],ENT_QUOTES,'UTF-8')?> - 
            <?=htmlspecialchars($commentTime,ENT_QUOTES,'UTF-8')?><br>
            Comment: <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=htmlspecialchars($comment["commentText"],ENT_QUOTES,'UTF-8')?><br />

            <?php endif?>
            <?php endforeach; ?>  
            </blockquote>
            <br><br>
        <?php endforeach; ?> 
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>
</html>