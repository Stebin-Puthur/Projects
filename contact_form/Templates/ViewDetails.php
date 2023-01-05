<body>
<div class="container">
    <div class="row m-3">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h1 class="fw-bolder" style="font-size: xx-large">Contact Form Details</h1>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="row m-3">
        <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            use Models\Actions as db;
            $db = new db();
            $datas = $db->view_contact_form();
            foreach ($datas as $data):
                ?>
                <form action="" method="post">
                    <tr>
                        <td style="width: 10%;">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $data->id; ?>">
                            <input type="text" class="form-control" name="formId" disabled value="<?php echo $data->id; ?>">
                        </td>
                        <td style="width: 15%;">
                            <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>">
                        </td>
                        <td style="width: 25%;">
                            <input type="text" class="form-control" name="address" value="<?php echo $data->address; ?>">
                        </td>
                        <td style="width: 25%;">
                            <input type="text" class="form-control" name="email" value="<?php echo $data->email; ?>">
                        </td>
                        <td style="width: 10%;">
                            <input type="text" class="form-control" name="phone" value="<?php echo $data->phone; ?>">
                        </td>
                        <td style="width: 25%;">
                            <button type="submit" class="btn btn-success btn-sm" name="update">Update</button>
                            <button type="submit" class="btn btn-danger btn-sm" name="delete">Delete</button>
                        </td>
                    </tr>
                </form>
            <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>
