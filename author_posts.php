<?php include 'includes/db.php'; ?>  
<?php include 'includes/header.php'; ?>


<!-- Navigation link below -->
<?php include 'includes/navigation.php'; ?>

<main id="main">

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog">
    <div class="container">

      <div class="row">

        <div class="col-lg-8 entries">

          <?php 
         

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }

            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' ";
            $selectPosts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectPosts)) {
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
              <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img src="images/<?php echo $post_image; ?>" alt="" class="img-fluid">
              </a>
            </div>

            <h2 class="entry-title">
              <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="author_posts.php?author=<?php echo $post_author; ?> & p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></li>
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
                <a href="post.php?p_id=<?php echo $post_id; ?>">Read More</a>
              </div>
            </div>

          </article><!-- End blog entry -->

          <?php } ?>

          
        </div><!-- End blog entries list -->
        <!-- Sidebar here  -->
        <?php include 'includes/Sidebar.php'; ?>
      </div>
    </div>
  </section><!-- End Blog Section -->
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>
 