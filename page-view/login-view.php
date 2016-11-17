<form id="login-form" method="post" action="index.php?page=login">
    <div>
        User Name: <input type="text" name="username"><br>
        Password: <input type="text" name="password"><br>
    </div>
    <div>
        <input type="submit" name="submit" value="submit">
    </div>
    <?php echo $_POST['username']; ?><br>
     <?php if($errors){ ?>
        <div class="errors">
            <p><?php echo $errors; ?></p>
        </div>
    <?php } ?>
</form>