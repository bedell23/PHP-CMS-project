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
            
            if(isset($_POST['searchBtn'])){
                    
              $search = $_POST['search'];
                  
                  
              $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
              $search_query = mysqli_query($connection, $query);

              if(!$search_query) {

                  die("QUERY FAILED" . mysqli_error($connection));
              }

              $count = mysqli_num_rows($search_query);

              if($count == 0) {

                  echo "<h1 class='display-1 text-danger text-center'> NO RESULT FOUND</h1>";

              } else {

              while($row = mysqli_fetch_array($search_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
              $post_views_count = $row['post_views_count'];

          ?>
            
          <article class="entry" data-aos="fade-up">

            <div class="entry-img">
              <a href="post.php?p_id=<?= $post_id; ?>">
                <img src="images/<?php echo $post_image; ?>" alt="" class="img-fluid">
              </a>
            </div>

            <h2 class="entry-title">
              <a href="post.php?p_id=<?= $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="author_posts.php?author=<?= $post_author; ?> & p_id=<?= $post_id; ?>"><?php echo $post_author; ?></a></li>
                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i><time datetime="2020-01-01"><?php echo $post_date; ?></time></li>
                <li class="d-flex align-items-center">
                  <?php  
                    // displaying total amount of comment per post
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                    $send_query_count = mysqli_query($connection, $query);

                    $row = mysqli_fetch_array($send_query_count);
                    $count_comments = mysqli_num_rows($send_query_count);
                  ?>

                  <i class="icofont-comment"></i><?php echo $count_comments?> Comments
                </li>
                <li class="d-flex align-items-center"><i class="icofont-eye"></i><?php echo $post_views_count; ?> views</li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
                <?php echo $post_content; ?>
              </p>
              <div class="read-more">
                <a href="post.php?p_id=<?= $post_id; ?>">Read More</a>
              </div>
            </div>

          </article><!-- End blog entry -->

          <?php } } }?>

          
        </div><!-- End blog entries list -->
        <!-- Sidebar here  -->
        <?php include 'includes/Sidebar.php'; ?>
      </div>
    </div>
  </section><!-- End Blog Section -->
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
 