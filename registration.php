<?php  include "includes/db.php"; ?>
<?php include "admin/admin_functions.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);

        $error = [

            'first_name'=> '',
            'last_name'=> '',
            'email'=>'',
            'password'=>''
        ];

        if($first_name ==''){

            $error['first_name'] = "<p class='text-danger'>First Name cannot be empt</p>";
        }

        if($last_name ==''){

            $error['last_name'] = "<p class='text-danger'>Last Name cannot be empty</p>";
        }

        if($email ==''){

            $error['email'] = "<p class='text-danger'>Email cannot be empty</p>";
        }

        if(email_exists($email)){
            $error['email'] = 'Email already exists, <a href="index.php">Please login</a>';
        }

        if($password == '') {
            $error['password'] = "<p class='text-danger'>Password cannot be empty</p>";
        }

        foreach ($error as $key => $value) {
            
            if(empty($value)){

             unset($error[$key]);
            }
        }

        if(empty($error)){

            register_user($first_name, $last_name, $email, $password);

            redirect('register_success.php');
        }
    }
?>



<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>


<main id="main">

    <?php include 'includes/breadcrumbs.php'; ?>
    
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-2"></div> 
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form role="form" action="registration.php" class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control
                                            form-control-user" name="first_name"
                                            placeholder="First Name" autocomplete="on" value="<?php echo isset($first_name) ? $first_name : '' ?>">
                                        <p><?php echo isset($error['first_name']) ? $error['first_name'] : '' ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" placeholder="Last Name" name="last_name" autocomplete="on" value="<?= isset($last_name) ? $last_name : '' ?>"
                                        >
                                        <p><?= isset($error['last_name']) ? $error['last_name'] : '' ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email Address" name="email"
                                    autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>"
                                    >
                                    <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" placeholder="Password"name="password">
                                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                                </div>
                                <button class="btn btn-primary btn-user btn-block" name="register" type="submit">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">
                                    Already have an account? Login
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div> 
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
