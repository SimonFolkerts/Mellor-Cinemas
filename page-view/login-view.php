<section class="page-container">
    <section class="wrapper-section">
        <?php if (array_key_exists('id', $_GET)) : ?>
            <p>Please log in or create an account to book seats online</p>
        <?php endif; ?>
        <div class="form-wrapper">
            <div>
                <h2>Log In with an existing account</h2>
                <form class="login-form" id="login-form" method="post" action="index.php?page=login">
                    <div>
                        <label for="username">User Name: </label>
                        <input type="text" name="username"><br>
                        <label for="password">Password: </label>
                        <input type="text" name="password"><br>
                    </div>
                    <div>
                        <button class="button" type="submit" name="submit" value="submit">Log In</button>
                    </div>
                </form>
            </div>
            <div>
                <h2 class="form-spacer">-- OR --</h2>
            </div>
            <div>
                <h2>Create a new account</h2>

                <form class="login-form" id="signup-form" method="post" action="index.php?page=login&create=true<?php echo $_GET['id'] ? '&id=' . $_GET['id'] : ''; ?>">
                    <div>
                        <label for="username">User Name: </label>
                        <input type="text" name="username"><br>
                        <label for="password">Password: </label>
                        <input type="text" name="password"><br>
                        <label for="email">Email:</label>
                        <input type="text" name="email"><br>
                    </div>
                    <button class="button" type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>"><?php echo $edit ? 'EDIT' : 'ADD'; ?></button>
                </form>
            </div>
        </div>
        <?php if (!empty($errors)): ?>
            <ul class="errors">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
    <div class="page-spacer"></div> 
</section>
    