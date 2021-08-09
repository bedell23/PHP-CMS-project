<?php include 'includes/db.php'; ?>  
<?php include 'includes/header.php'; ?>


<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>


<main id="main">

  <?php include 'includes/breadcrumbs.php'; ?>

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container">

      <div class="row">

        <div class="col-lg-8 entries">

          <?php 

            if (isset($_GET['edit_team'])) {
                $the_team_id = $_GET['edit_team'];

                $query = "SELECT * FROM team WHERE team_member_id = $the_team_id";
                $select_team = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_team)) {
                  # code...
                  $team_member_id = $row['team_member_id'];
                  $team_member_name = $row['team_member_name'];
                  $team_member_title = $row['team_member_title'];
                  $team_member_img = $row['team_member_img'];
                  $team_member_twitter = $row['team_member_twitter'];
                  $team_member_instagram = $row['team_member_instagram'];
                  $team_member_facebook = $row['team_member_facebook'];
                  $team_member_linkin = $row['team_member_linkin'];
                  $team_member_bio = $row['team_member_bio'];

          ?>
            
          <article class="entry" data-aos="fade-up">

            <div class="entry-img">
                <img src="images/<?= $team_member_img; ?>" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
              <?= $team_member_title; ?>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center">
                  <a href="<?= $team_member_twitter; ?>"><i class="icofont-twitter"></i></a>
                </li>
                
                <li class="d-flex align-items-center">
                  <a href="<?= $team_member_facebook; ?>"><i class="icofont-facebook"></i></a>
                </li>

                <li class="d-flex align-items-center">
                  <a href="<?= $team_member_instagram; ?>"><i class="icofont-instagram"></i></a> 
                </li>
                <li class="d-flex align-items-center">
                  <a href="<?= $team_member_linkin; ?>"><i class="icofont-linkedin"></i></a>
                </li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
                <?= $team_member_bio; ?>
              </p>
            </div>
          </article><!-- End blog entry -->

          <?php } }?>
          <hr>
          
        </div><!-- End blog entries list -->
        <!-- Sidebar here  -->
        <?php include 'includes/Sidebar.php'; ?>
      </div>
    </div>
  </section><!-- End Blog Section -->
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>