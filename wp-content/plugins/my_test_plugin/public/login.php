<?php
if(!defined('ABSPATH')) {
    header('location: /my-plugin-test/wp-admin');
    die();
}
?>
<div class="login-form">
    <form action="<?php echo get_the_permalink(); ?>" method="post">
        Username: <input type="text" name="login-username" id="login-username" value=""><br />
        Password: <input type="password" name="login-pass" id="login-pass" value=""><br />
        <input type="submit" name="userlogin" id="userlogin" value="Login">
    </form>
</div>