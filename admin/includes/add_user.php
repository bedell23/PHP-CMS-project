<?php 
  if (isset($_POST['create_user'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);

    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);

    $user_password = password_hash($user_password, PASSWORD_BCRYPT,  array('cost' => 10, ) );

    $query = "INSERT INTO users(user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES('{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}' ) ";

    $add_user = mysqli_query($connection, $query);

   if (!$add_user) {
    die("Failed to add user "  . mysqli_error($connection));
    }
    echo "User Created: " . " " . "<a href='users.php'>View User</a> ";
  }
?>

<div class="container">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 align-items-center">
      <div class="p-5">
        <form class="" action="" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="user_email">First Name</label>
            <input type="text" class="form-control" name="user_firstname"> 
          </div>  
           <div class="form-group">
            <label for="user_email">Last Name</label>
            <input type="text" class="form-control" name="user_lastname" > 
          </div>      
          <div class="form-group">
            <select name="user_role" id="user_role">
              <option value='subscriber'>Select Option</option>; 
              <option value='admin'>Admin</option>; 
              <option value='subscriber'>Subscriber</option>; 
            </select>
          </div> 

         <!--  <div class="form-group">
            <label for="post_image">Post Image</label>
            <input type="file" class="form-control" name="image">
          </div> -->

          <div class="form-group">
            <label for="user_email">Email</label>
            <input type="email" class="form-control" name="user_email"> 
          </div>

          <div class="form-group">
            <label for="user_password">Password</label>
            <input type="password" class="form-control" name="user_password"> 
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>