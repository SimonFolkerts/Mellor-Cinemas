<?php if (array_key_exists('id', $_GET)) : ?>
<p>Please log in or create an account to book seats online</p>
<?php endif; ?>
<form id="login-form" method="post" action="index.php?page=login">
    <div>
        User Name: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
    </div>
    <div>
        <button type="submit" name="submit" value="submit">Log In</button>
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
