<form id="login-form" method="post" action="index.php?page=login">
    <div>
        User Name: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
    </div>
    <div>
        <input type="submit" name="submit" value="submit">
    </div>
</form>
<form id="signup-form" method="post" action="index.php?page=login&create=true">
    <input type="submit" name="create" value="create">
</form>
<?php if ($errors) { ?>
    <div class="errors">
        <p><?php echo $errors; ?></p>
    </div>
<?php } ?>
