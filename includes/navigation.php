
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <!-- <h1 class="logo mr-auto"><a href="index.php"><span>Societal </span>Ills</a></h1> -->
    <!-- Uncomment below if you prefer to use an image logo -->
     <a href="index.php" class="logo mr-auto"><img src="./images/si.png" alt="" class="img-fluid"></a>

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="<?php echo $home_class; ?>"><a href="index.php">Home</a></li>

        <?php  
          if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
            echo "<li><a href='admin/index.php'>Admin</a></li>";
          }
        ?>

        <?php 
          $query = "SELECT * FROM categories ";
          $selectCategories = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($selectCategories)) {
              # code...
              $cat_title = $row['cat_title'];
              $cat_id = $row['cat_id'];

              // active class
              $category_class = "";
              $about_class = "";
              $team_class = "";
              $contact_class = "";
              $home_class = "";

              $pageName = basename($_SERVER['PHP_SELF']);
              $about = "about.php";
              $team = "team.php";
              $contact = "contact.php";
              $home = "index.php";

              if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                  $category_class = "active";
              } elseif ($pageName == $about) {
                $about_class = "active";
              } elseif ($pageName == $team) {
                $team_class = "active";
              } elseif ($pageName == $contact) {
                $contact_class = "active";
              } elseif ($pageName == $home) {
                $home_class = "active";
              }

              echo "<li class='$category_class'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
          }
        ?>
        

        <li class="drop-down"><a href="">About</a>
          <ul>
            <li class="<?php echo $about_class; ?>"><a href="about.php">About Us</a></li>
            <li class="<?php echo $team_class; ?>"><a href="team.php">Team</a></li>
          </ul>
        </li>

        <li class="<?php echo $contact_class; ?>"><a href="contact.php">Contact</a></li>

      </ul>
    </nav><!-- .nav-menu -->

    <div class="header-social-links">
      <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
      <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
      <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
      <a href="https://wa.link/33ob9h" class="linkedin"><i class="icofont-whatsapp"></i></i></a>
      <?php 
        if (isset($_SESSION['user_role'])) {
          ?> <i class="icofont-user" style="color: green;"> <?= $_SESSION['firstname'] ?></i> <?php
        } else {
          ?>  <a href="login.php" class="instagram"><i class="icofont-login"></i></a> <?php
        }
      ?>
      <!-- <a href="login.php" class="instagram"><i class="icofont-login"></i></a> -->
    </div>

  </div>
</header><!-- End Header -->