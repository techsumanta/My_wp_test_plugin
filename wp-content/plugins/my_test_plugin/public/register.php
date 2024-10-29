<?php

if(!defined('ABSPATH')) {
    header('location: /my-plugin-test/wp-admin');
    die();
}

if(isset($_POST['register'])) {
    $fname = esc_sql($_POST['user_fname']);
    $lname = esc_sql($_POST['user_lname']);
    $username = esc_sql($_POST['username']);
    $email = esc_sql($_POST['email']);
    $pass = esc_sql($_POST['user_pass']);
    $con_pass = esc_sql($_POST['user_con_pass']);

    if($pass == $con_pass) {
        // wp_insert_user()
        // wp_create_user()

        // $result = wp_create_user($username, $pass, $email);

        $userData = array(
            'user_login' => $username,
            'user_email' => $email,
            'first_name' => $fname,
            'last_name' => $lname,
            'display_name' => $fname." ".$lname,
            'user_pass' => $pass
        );

        $result = wp_insert_user($userData);
        
        if(!is_wp_error($result)) {
            echo "User Created ID: ".$result;
            add_user_meta($result, 'type', 'Faculty');
            update_user_meta($result, 'show_admin_bar_front', false);
        } else {
            echo $result->get_error_message();
        }
    } else {
        echo "Password not Matched";
    }
}

?>

<div class="regi-form">
    <form action="<?php echo get_the_permalink(); ?>" method="post">
        First Name: <input type="text" name="user_fname" id="user_fname" value=""><br />

        Last Name: <input type="text" name="user_lname" id="user_lname" value=""><br />

        Username: <input type="text" name="username" id="username" value=""><br />

        Email: <input type="email" name="email" id="email" value=""><br />

        Password: <input type="password" name="user_pass" id="user_pass" value=""><br />

        Confirm Password: <input type="password" name="user_con_pass" id="user_con_pass" value=""><br />
        
        <input type="submit" name="register" id="register" value="Register">
    </form>
</div>