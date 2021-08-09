<?php include 'includes/admin_header.php'; ?>

<?php  
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $query = "SELECT * FROM users WHERE user_email = '{$email}' ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_user_profile_query)) {
            $user_id = $row['user_id'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
        }
    }


     if (isset($_POST['edit_profile'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

   $query = "UPDATE users SET user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', username = '{$username}', user_email = '{$user_email}', user_password = '{$user_password}' WHERE username = '{$username}'";

    $edit_user = mysqli_query($connection, $query);

   if (!$edit_user) {
    die("Failed to add user "  . mysqli_error($connection));
    }
  }

?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'includes/admin_side_navbar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include 'includes/admin_top_navbar.php'; ?>
            
            <!-- Begin Page Content -->
            <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                <div class="col-lg-12">
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
                            <label for="user_email">Email</label>
                            <input type="email" value="<?php echo $user_email;?>" class="form-control" name="user_email"> 
                          </div>

                          <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" autocomplete="off" class="form-control" name="user_password"> 
                          </div>

                          <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_profile" value="Update Profile">
                          </div>
                        </form>
                      </div>
                      <div class="col-lg-2"></div>
                    </div>
                  </div>
              </div>
              <!-- /.row -->
            </div>
        <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        

<?php include 'includes/logout_modal.php'; ?>

<?php include 'includes/admin_footer.php'; ?>