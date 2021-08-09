<?php 
  if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $selectUserById = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectUserById)) {
      # code...
      $user_id = $row['user_id'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_role = $row['user_role'];
      $username = $row['username'];
      $user_email = $row['user_email'];
      $user_password = $row['user_password'];
      
    }

    if (isset($_POST['edit_user'])) {
      $user_firstname = escape($_POST['user_firstname']);
      $user_lastname = escape($_POST['user_lastname']);
      $user_role = escape($_POST['user_role']);
      $username = escape($_POST['username']);

      $user_email = escape($_POST['user_email']);
      $user_password = escape($_POST['user_password']);
      
      // password encryption for the edit user page
      if (!empty($user_password)) {
        $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection, $query_password);

        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if ($db_user_password != $user_password) {
          $user_password = password_hash($user_password, PASSWORD_BCRYPT,  array('cost' => 12, ) );
        }

         $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_role = '{$user_role}', username = '{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE user_id = '{$the_user_id}'";

        $edit_user = mysqli_query($connection, $query);

       if (!$edit_user) {
        die("Failed to add user "  . mysqli_error($connection));
        }

        echo "User Updated:" . "<a href='users.php'>View User?</a>";
      }

    } 
  } else {
    header("Location: admin.php");
  }
?>

<div class="container">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 align-items-center">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input type="text" value="<?php echo $user_firstname;?>" class="form-control" name="user_firstname">
          </div>

          <div class="form-group">
            <label for="user_lastname">Last Name</label>
            <input type="text" value="<?php echo $user_lastname;?>" class="form-control" name="user_lastname">
          </div>

          <div class="form-group">
            <select name="user_role" id="user_role">
              <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>;

              <?php  
                if ($user_role == 'admin') {
                  echo "<option value='subscriber'>Subscriber</option>";
                } else {
                  echo "<option value='admin'>Admin</option>"; 
                }
              ?>
            </select>
          </div> 

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" value="<?php echo $username;?>" class="form-control" name="username">
          </div>

          <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" value="<?php echo $user_email;?>" class="form-control" name="user_email"> 
          </div>

          <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" autocomplete="off" class="form-control" name="user_password"> 
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
          </div>
        </form>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>