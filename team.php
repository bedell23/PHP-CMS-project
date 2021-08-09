<?php include 'includes/db.php'; ?>  
<?php include 'includes/header.php'; ?>


<!-- ======= Header ======= -->
<?php include 'includes/navigation.php'; ?>

<main id="main">

  <?php include 'includes/breadcrumbs.php'; ?>

  <!-- ======= Our Team Section ======= -->
  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Meet Our <strong>Team</strong></h2>
        <p>
          We have reached this far because of the hardworking members we have in our team. We are very please to introduce you to every member in our team. You can click on their images to read their bio in full text.
        </p>
      </div>

      <div class="row">

        <?php  
          $query = "SELECT * FROM team ";
          $selectPosts = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($selectPosts)) {
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
         

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="member" data-aos="fade-up">
            <div class="member-img">
              <a href="individual_team.php?edit_team=<?= $team_member_id ?>">
                <img src="images/<?= $team_member_img; ?>" class="img-fluid" alt="">
              </a>
              <div class="social">
                <a href="<?= $team_member_twitter; ?>"><i class="icofont-twitter"></i></a>
                <a href="<?= $team_member_facebook; ?>"><i class="icofont-facebook"></i></a>
             <a href="<?= $team_member_instagram; ?>"><i class="icofont-instagram"></i></a>
                <a href="<?= $team_member_linkin; ?>"><i class="icofont-linkedin"></i></a>
              </div>
            </div>
            <div class="member-info">
              <h4>
                <a href="individual_team.php?edit_team=<?= $team_member_id ?>"><?= $team_member_name ?></a>
              </h4>
              <span>
                <?= $team_member_title ?>
              </span>
            </div>
          </div>
        </div>

      <?php } ?>

      </div>

    </div>
  </section><!-- End Our Team Section -->

</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
