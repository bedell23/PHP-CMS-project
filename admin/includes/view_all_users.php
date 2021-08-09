<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Approve</th>
                    <th>Unapprove</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <!-- <th>Date</th> -->
                </tr>
                </thead>
                <tbody>

                <?php  

                    $query = "SELECT * FROM users";
                    $selectUsers = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($selectUsers)) {
                        # code...
                        $user_id = $row['user_id'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_role = $row['user_role'];
                        $user_image = $row['user_image'];
                        $randSalt = $row['randSalt'];
                        // $user_date = $row['user_date'];

                        echo "<tr>";
                        echo "<td>$user_id</td>";
                        echo "<td>$user_firstname</td>";

                        echo "<td>$user_lastname</td>";
                        echo "<td>$user_email</td>";
                        echo "<td>$user_role</td>";
                        echo "<td><a class='btn btn-success' href='users.php?change_to_admin={$user_id}'>Admin<a></td>";
                        echo "<td><a class='btn btn-info' href='users.php?change_to_subscriber={$user_id}'>Subscriber<a></td>";
                        echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>Edit<a></td>";
                        echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}' >Delete<a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 

if (isset($_GET['change_to_admin'])) {
    $the_user_id = escape($_GET['change_to_admin']);

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $changeToAdmin = mysqli_query($connection, $query);
    header("Location: users.php ");
}

if (isset($_GET['change_to_subscriber'])) {
    $the_user_id = escape($_GET['change_to_subscriber']);

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $changeToSub = mysqli_query($connection, $query);
    header("Location: users.php ");
}

if (isset($_GET['delete'])) {
    if (isset($_SESSION['user_role'])) {

        if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'Admin') {
       
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $deleteUser = mysqli_query($connection, $query);
            header("Location: users.php ");
        }
    }
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you show you want to <b>DELETE</b> this <?= $user_firstname?> ?</p>
      </div>
      <div class="modal-footer">
      <form method="POST">            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php 





