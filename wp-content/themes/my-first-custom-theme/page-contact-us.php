<?php
get_header('template');
?>

<style>
    #userInfo table{
        display: flex;
        margin: 10px;
        align-items: center;
        justify-content: center;        
    }

    #userInfo .error{background-color: red;}
    #userInfo .success{background-color: green;}
</style>

<form action="<?php get_the_permalink(); ?>" method="post" id="userInfo">
    <table>
        <tr>
            <td>
                <label for="user_name">Name:</label>
                <input type="text" name="user_name" id="user_name" value="">
            </td>
        </tr>
        <tr>
            <td>
                <label for="user_email">Email:</label>
                <input type="email" name="user_email" id="user_email" value="">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="userSubmit" id="userSubmit" value="Submit">
            </td>
        </tr>
    </table>

    <div id="result_msg"></div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script>
    $('#userInfo').submit(function(e) {
        e.preventDefault();
        $('#result_msg').html("");
        var link = "<?php echo admin_url('admin-ajax.php'); ?>";
        var form = $('#userInfo').serialize();
        var formData = new FormData();
        formData.append('action', 'contact_us');    
        formData.append('contact_us', form);    
        // alert(formData);
        $.ajax({
            url : link,
            type : 'post',
            data : formData,
            processData : false,
            contentType : false,
            success : function(result) {
                // alert(result.data);
                if(result.success == true) {
                    $('#result_msg').html("<span class='success'>"+result.data+"</span>");
                    $('#userInfo')[0].reset();
                } else {
                    $('#result_msg').html("<span class='error'>"+result.data+"</span>");
                }
            }
        });
    });
</script>
<?php
get_footer('template');
?>