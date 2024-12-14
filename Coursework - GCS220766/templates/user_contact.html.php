<form action="" method="post">
    <?php if ($author): ?>
        <input type="hidden" name="authors" value="<?= htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <p>Selected Author: <?= htmlspecialchars($author['author_name'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php else: ?>
        <h1>Can't find the author</h1>
    <?php endif; ?>
    <h1>Feel free to contact admin here.</h1>
    <textarea name="contactText" rows="10" cols="60" required></textarea>
    <br>
    <input type="submit" name="submit" value="Sent"><br><br>
    <?php if ($contacts): ?>
        <?php foreach ($contacts as $contact): ?>
            Contact ID: <?= htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8'); ?><br>
            Your contact: <?= htmlspecialchars($contact['contactText'], ENT_QUOTES, 'UTF-8'); ?><br>
            Contact Time: <?= htmlspecialchars($contact['contactDate'], ENT_QUOTES, 'UTF-8'); ?><br>
            <?php if ($contact['contactDate'] == $contact['replyTime']):?>
                Waiting for admin's reply... <br><br>
            <?php else:?>
                Admin's Reply:<?= htmlspecialchars($contact['contactReply'], ENT_QUOTES, 'UTF-8'); ?><br>
                Reply Time:   <?= htmlspecialchars($contact['replyTime'], ENT_QUOTES, 'UTF-8'); ?><br><br>
            <?php endif?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No contacts available for this author.</p>
    <?php endif; ?>
</form>