<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeIgniter 4 User List</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-end">
        <a href="<?php echo site_url('/user-form') ?>" class="btn btn-success mb-2">Add User</a>
        <a href="<?php echo site_url('/export') ?>" class="btn btn-success mb-2">Export</a>
    </div>
    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
    }
    ?>
    <div class="mt-3">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Umur</th>
                <th>Kota</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Example data
            foreach($users as $user):
            ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nama']; ?></td>
                <td><?php echo $user['umur']; ?></td>
                <td><?php echo $user['kota']; ?></td>
                <td>
                    <a href="<?php echo base_url('edit-view/'.$user['id']);?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="<?php echo base_url('delete/'.$user['id']);?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
