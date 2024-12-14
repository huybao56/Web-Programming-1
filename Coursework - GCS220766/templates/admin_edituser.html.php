<a href="admin_manageuser.php">Back</a>
<form action="" method="post">
    <input type="hidden" name="id" value="<?=$manages['id'];?>">

    <label for="authorName">User's Name:</label><br><br> 
    <textarea name="authorName" rows="3" cols="40"><?=$manages['author_name']?></textarea><br><br>

    <label for="Email">Email:</label><br><br>
    <textarea name="Email" rows="3" cols="40"><?=$manages['author_email']?></textarea><br><br>

    <label for="Usertype">Role:</label><br><br>
    <textarea name="Usertype" rows="3" cols="40"><?=$manages['usertype']?></textarea><br><br>
    
    <input type="submit" name="submit" value="Save">
</form>