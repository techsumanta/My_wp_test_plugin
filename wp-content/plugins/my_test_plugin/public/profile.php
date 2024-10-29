<?php
if(!defined('ABSPATH')) {
    header('location: /my-plugin-test/wp-admin');
    die();
}

if(isset($_POST['update'])) {
    $update_user_id = esc_sql($_POST['user_id']);
    $fname = esc_sql($_POST['user_fname']);
    $lname = esc_sql($_POST['user_lname']);

    if($_FILES['user_image']['error'] == 0) {
        $file = $_FILES['user_image'];
        $ext = explode('/', $file['type'])[1];
        $file_name = "$update_user_id.$ext"; // it means like - 5.png      
        
        // $uploadresult = wp_upload_bits($file_name, true, file_get_contents($file['tmp_name'])); // it upload the file


        if(!metadata_exists('user', $update_user_id, 'user_profile_image_url')) {
            $uploadresult = wp_upload_bits($file_name, true, file_get_contents($file['tmp_name']));
            add_user_meta($update_user_id, 'user_profile_image_url', $uploadresult['url']);
            add_user_meta($update_user_id, 'user_profile_image_path', esc_sql($uploadresult['file']));
        } else {
             $profile_image_path = get_user_meta($update_user_id, 'user_profile_image_path')[0];

            wp_delete_file($profile_image_path);
            $uploadresult = wp_upload_bits($file_name, true, file_get_contents($file['tmp_name']));
            update_user_meta($update_user_id, 'user_profile_image_url', $uploadresult['url']);
            update_user_meta($update_user_id, 'user_profile_image_path', esc_sql($uploadresult['file']));
        }
    }   

    $userdata = array(
        'ID' => $update_user_id,
        'first_name' => $fname,
        'last_name' => $lname
    );

    $updateuser = wp_update_user($userdata); // if success return 'id' or return wp error object

    if(is_wp_error($updateuser)) {
        echo "Can not Update: ".$updateuser->get_error_message();
    }
}

$user_id = get_current_user_id();
$user = get_userdata($user_id); // it return 'user object' or 'false'

if($user != false) {
    // echo wp_logout_url();
    // echo "<pre>";
    // print_r($user);
    $user_meta = get_user_meta($user_id);
    // print_r($user_meta);
    // echo "</pre>";
    $profile_image = $user_meta['user_profile_image_url'][0];
    // echo $profile_image;
?>

<h1>Profile Page</h1>

<?php
if($profile_image != '') {
    ?>
        <img src="<?php echo $profile_image; ?>">
    <?php
}
?>

<p><a href="<?php echo wp_logout_url(); ?>">Logout</a></p>

<form action="<?php echo get_the_permalink(); ?>" method="post" enctype="multipart/form-data">
    First Name: <input type="text" name="user_fname" id="user_fname" value="<?php echo $user_meta['first_name'][0]; ?>"><br />
    Last Name: <input type="text" name="user_lname" id="user_lname" value = "<?php echo $user_meta['last_name'][0]; ?>"><br />
    Upload Image: <input type="file" name="user_image" id="user_image" value="">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
    <input type="submit" name="update" id="update" value="Update">
</form>

<?php
}

?>

