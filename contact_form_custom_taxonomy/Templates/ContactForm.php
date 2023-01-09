<?php
if (isset($_POST['submit'])) {
    $name = $_POST['user_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insert_arg = array(
        'post_type' => 'form',
        'post_title' => $_POST['user_name'],
        'post_status'   => 'publish',
        'post_author'   => 1,
    );
    $post_id = wp_insert_post($insert_arg);
    $taxonomies = array('full_name' => $name,
                    'address' => $address,
                    'email' => $email,
                    'phone' => $phone);

    foreach ($taxonomies as $taxonomy => $term){
        wp_insert_term($term,$taxonomy);
        wp_set_post_terms($post_id,$term,$taxonomy);
    }
}
echo "<span class='text-success' style='margin-left: 40%'>Form Details Submitted Successfully</span>";
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