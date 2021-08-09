<?php  include "includes/db.php"; ?>
<?php include "admin/admin_functions.php"; ?>
<?php  include "includes/header.php"; ?>

<?php  

    if(!isset($_GET['forgot'])){

        redirect('index');
    }

    if(ifItIsMethod('post')){

        if(isset($_POST['email'])) {

            $email = $_POST['email'];

            $length = 50;

            $token = bin2hex(openssl_random_pseudo_bytes($length));


            if(email_exists($email)){


                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email= ?")){

                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);



                    /**
                     *
                     * configure PHPMailer
                     *
                     *
                     */

                    $mail = new PHPMailer();

                    $mail->isSMTP();
                    $mail->Host = Config::SMTP_HOST;
                    $mail->Username = Config::SMTP_USER;
                    $mail->Password = Config::SMTP_PASSWORD;
                    $mail->Port = Config::SMTP_PORT;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';


                    $mail->setFrom('edwin@codingfaculty.com', 'Edwin Diaz');
                    $mail->addAddress($email);

                    $mail->Subject = 'This is a test email';

                    $mail->Body = '<p>Please click to reset your password

                    <a href="http://localhost:8888/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost:888/cms/reset.php?email='.$email.'&token='.$token.'</a>



                    </p>';


                    if($mail->send()){

                        $emailSent = true;

                    } else{

                        echo "NOT SENT";
                    }
                }
            }
        }
    }

?>

<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>

<main id="main">
    <?php include 'includes/breadcrumbs.php'; ?>

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
                                        <h1 class="h4 text-gray-900 mb-4">Forgot your Password?</h1>
                                        <p>We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form action="login.php" class="user" method="POST">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."
                                                name="email">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="login" type="submit">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="registration.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">
                                            Already have an account? Login In!
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
</main>

<?php include 'includes/footer.php'; ?>