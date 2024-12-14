This is for managing module in admin page. <br>
Number of User's Account: <?=$totalModules?><br>
<a href="admin_addmodule.php">Add Module</a><br><br>
<table border="1px">
    <thead>
        <tr>
            <th>Module Code</th>
            <th>Module Name</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody height="5px">
        <?php foreach($manages as $manage):?>
            <tr>
                    <td><?=htmlspecialchars($manage["code"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($manage["module_name"],ENT_QUOTES,'UTF-8')?></td>
            
                        <td><a href="admin_editmodule.php?code=<?=urlencode($manage['code'])?>">Edit</a></td>
                        <td>
                            <form action="admin_deletemodule.php" method="POST">
                                <input type="hidden" name="code" value="<?=$manage['code']?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
            </tr>
        <?php endforeach;?>

    </tbody>
</table>