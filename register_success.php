<?php include 'includes/db.php'; ?>  
<?php include 'includes/header.php'; ?>


<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>


<main id="main">

  <?php include 'includes/breadcrumbs.php' ?>

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                      <h1 class="h4 mb-4">Registration Done Successfully</h1>
                      <p>You have successfully registered to our platform.</p>
                      <p>The security of your personal information is taken in to high consideration.</p>
                      <h2 class="h4 text-gray-900 mb-4">Thank you for your Subcription!</h2>
                      <a href="index.php" class="btn btn-success btn-user " name="register" type="submit">
                        Home
                      </a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div>  
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
 