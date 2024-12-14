<form action="" method="post">
    <input type="hidden" name="id" value="<?=$questions['id'];?>">

    <label for="questionTitle">Edit the title here:</label><br><br> 
    <textarea name="questionTitle" rows="3" cols="40"><?=$questions['questionTitle']?></textarea><br><br>

    <label for="questionText">Edit the question here:</label><br><br>
    <textarea name="questionText" rows="3" cols="40"><?=$questions['questionText']?></textarea><br><br>

    <input type="submit" name="submit" value="Save">
</form>