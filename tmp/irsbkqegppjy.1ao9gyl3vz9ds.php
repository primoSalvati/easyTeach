<form class="pure-form pure-form-stacked" action="/authenticate" method="POST">
    <?php if ($loginError): ?>
        <div class="alert alert-danger" role="alert"><?= ($loginError) ?></div>
    <?php endif; ?>
    <input type="text" name="username" id="" placeholder="Username">
    <input type="password" name="password" id="" placeholder="Password">
    <input type="submit" value="Sign in" class="pure-button wide-button">

</form>