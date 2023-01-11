<?php
if (isset($_POST['submit'])) {
$name_meta_key = 'name_meta_key';
$address_meta_key = 'address_meta_key';
$email_meta_key = 'email_meta_key';
$phone_meta_key = 'phone_meta_key';
$insert_name_post_meta = $_POST['user_name'];
$insert_address_post_meta = $_POST['address'];
$insert_email_post_meta = $_POST['email'];
$insert_phone_post_meta = $_POST['phone'];
$insert_arg = array(
'post_type' => 'form',
'post_title' => $_POST['user_name'],
'post_status'   => 'publish',
'post_author'   => 1,
);
$post_id = wp_insert_post($insert_arg);
$insertMeta = add_post_meta($post_id, $name_meta_key, $insert_name_post_meta);
$insertMeta = add_post_meta($post_id, $address_meta_key, $insert_address_post_meta);
$insertMeta = add_post_meta($post_id, $email_meta_key, $insert_email_post_meta);
$insertMeta = add_post_meta($post_id, $phone_meta_key, $insert_phone_post_meta);
echo "<span class='text-success' style='margin-left: 40%'>Form Details Submitted Successfully</span>";
}
?>

<body>
<div class="container">
    <div class="row m-3">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="fw-bolder" style="font-size: xxx-large">Contact Form</h1>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row m-3">
        <div class="col-md-12">
            <form action="" method="POST">
                <label class="fw-bolder">Name</label>
                <input type="text" class="form-control" name="user_name" placeholder="Enter Full Name"><br>
                <label class="fw-bolder">Address</label>
                <textarea class="form-control" name="address" placeholder="Enter Address"></textarea><br>
                <label class="fw-bolder">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter Email"><br>
                <label class="fw-bolder">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone No."><br>
                <center><button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button></center>
            </form>
        </div>
    </div>
</div>
</body>