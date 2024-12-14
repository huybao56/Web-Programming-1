<form action="" method="post">
    <input type="hidden" name="id" value="<?=$comments['id'];?>">

    <label for="commentText">Edit the comment here:</label><br><br> 
    <textarea name="commentText" rows="3" cols="40"><?=$comments['commentText']?></textarea><br><br>

    <input type="submit" name="submit" value="Save">
</form>