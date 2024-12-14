<a href="admin_contact.php">Back</a>

<form action="" method="post">
    <input type="hidden" name="id" value="<?=$contacts['id'];?>">

    <label for="contactReply">Reply the contact here:</label><br><br>
    <textarea name="contactReply" rows="3" cols="40" required><?=$contacts['contactReply']?></textarea><br><br>

    <input type="submit" name="submit" value="Save">
</form>