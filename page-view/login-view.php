<form id="login-form" method="post" action="index.php?page=login">
    <div>
        User Name: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
    </div>
    <div>
        <input type="submit" name="submit" value="submit">
    </div>
</form>
<form id="signup-form" method="post" action="index.php?page=login&create=true<?php echo $_GET['id'] ? '&id=' . $_GET['id'] : '';?>">
    <div>
        User Name: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
        Email: <input type="text" name="email"><br>
    </div>
    <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>">
</form>
<?php if (!empty($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
