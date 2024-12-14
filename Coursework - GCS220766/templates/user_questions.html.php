<form action="" method="post" enctype="multipart/form-data">
    <?php if ($author): ?>
        <input type="hidden" name="authors" value="<?= htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8'); ?>">
        <p>Selected Author: <?= htmlspecialchars($author['author_name'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php else: ?>
        <h1>Can't find the author</h1>
    <?php endif; ?>
    <label for="module">Module:</label>
    <br>
    <select name="modules" required>
        <option value="">Select a Module's Name</option>
        <?php foreach ($modules as $module):?>
            <option value="<?=htmlspecialchars($module['code'],ENT_QUOTES,'UTF-8');?>">
            <?= htmlspecialchars($module['module_name'],ENT_QUOTES,'UTF-8');?>
            </option>
        <?php endforeach;?>
    </select>
    <br><br>
    
    <label for="questionTitle">Title:</label><br />
    <textarea name="questionTitle" rows="1" cols="40"></textarea><br />

    <label for="questionText">Content of questions:</label><br />
    <textarea name="questionText" rows="3" cols="40"></textarea><br />

    <label for="upload">Upload your file here:</label><br>
    <input type="file" name="upload"><br><br>

    <input type="submit" name="submit" value="Add">
</form>

