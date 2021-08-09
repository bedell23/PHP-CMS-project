
<?php include 'includes/db.php'; ?>
<?php include "admin/admin_functions.php"; ?>
<?php include 'includes/header.php'; ?>


<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>


<main id="main">

    <?php include 'includes/breadcrumbs.php'; ?>

	<?php 
		if(isset($_POST['login'])) {

			login_user($_POST['email'], $_POST['password']);
		}
	?>



	<div class=" container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                    	<div class="row">
                            <div class="col-lg-3"></div> 
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="login.php" class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."
                                                name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password"
                                                name="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="login" type="submit">
				                            Login
				                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot.php?forgot=<?= uniqid(true); ?>">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="registration.php">
                                        	Create an Account!
                                    	</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3"></div> 
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
