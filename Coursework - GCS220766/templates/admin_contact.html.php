The systems there displays only for admin <br>
Number of contact : <?=$totalContacts?>
<?php foreach($contacts as $contact): ?>
    <?php $display_date = date("D d M Y H:i:s", strtotime($contact['contactDate']))?>
    <?php $replyTime = date("D d M Y H:i:s", strtotime($contact['replyTime']))?>
    <blockquote>
    Contact ID: <?=htmlspecialchars($contact["id"],ENT_QUOTES,'UTF-8')?><br /><br />
    Author's Name:<?=htmlspecialchars($contact["author_name"],ENT_QUOTES,'UTF-8')?><br><br>
    Content: <?=htmlspecialchars($contact["contactText"],ENT_QUOTES,'UTF-8')?><br /><br />
    Date: <?=htmlspecialchars($display_date,ENT_QUOTES,'UTF-8')?><br><br>
    Your Reply: <?=htmlspecialchars($contact["contactReply"],ENT_QUOTES,'UTF-8')?><br /><br />
    Reply Time: <?=htmlspecialchars($replyTime,ENT_QUOTES,'UTF-8')?><br>

        <a href="../admin/admin_replycontact.php?id=<?=$contact['id']?>">Reply</a><br><br>
        <form action="../admin/admin_deletecontact.php" method="POST">
            <input type="hidden" name="id" value="<?=$contact['id']?>">
            <input type="submit" value="Delete">
        </form>
    </blockquote>
    <?php endforeach; ?>
