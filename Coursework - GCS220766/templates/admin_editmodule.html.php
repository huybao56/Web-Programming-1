<a href="admin_managemodule.php">Back</a>
<form action="" method="post">
    <input type="hidden" name="code" value="<?=$manages['code'];?>">

    <label for="module_name">Edit the name of module here:</label><br><br>
    <textarea name="module_name" rows="3" cols="40"><?=$manages['module_name']?></textarea><br><br>

    <input type="submit" name="submit" value="Save">
</form>