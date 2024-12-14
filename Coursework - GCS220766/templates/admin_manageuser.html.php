This is for managing user in admin page. <br>
Number of User's Account: <?=$totalAuthors?><br>
<a href="admin_adduser.php">Add User</a><br><br>
<table border="1px">
    <thead>
        <tr>
            <th>User's ID</th>
            <th>User's Full Name</th>
            <th>User's Email</th>
            <th>Account</th>
            <th>Password</th>
            <th>User Type</th>
            <th>Register Time</th>
            <th>Edit Time</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody height="5px">
        <?php foreach($manages as $manage):?>
            <tr>
                    <?php $display_date = date("D d M Y H:i:s", strtotime($manage['registerTime']))?>
                    <?php $display_date2 = date("D d M Y H:i:s", strtotime($manage['editTime']))?>
                    <td><?=htmlspecialchars($manage["id"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["author_name"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["author_email"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["username"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["password"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["usertype"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($display_date,ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($display_date2,ENT_QUOTES,'UTF-8')?></td>
            
                        <td><a href="../admin/admin_edituser.php?id=<?=urlencode($manage['id']);?>">Edit</a></td>
                        <td>
                            <?php if($manage['username'] == $_SESSION['username']):?>
                                Admin
                            <?php else:?>
                            <form action="admin_deleteuser.php" method="POST">
                                <input type="hidden" name="id" value="<?=$manage['id']?>">
                                <input type="submit" value="Delete">
                            </form>
                            <?php endif;?>
                        </td>
            </tr>
        <?php endforeach;?>

    </tbody>
</table>