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

            if (isset($_GET['p_id'])) {
                $post_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
                $send_query = mysqli_query($connection, $view_query);
                if (!$send_query) {
                    die("Query Failed" . mysqli_error($connection));
                }

                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $selectPosts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($selectPosts)) {
                    # code...
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_views_count = $row['post_views_count'];

          ?>
            
          <article class="entry" data-aos="fade-up">

            <div class="entry-img">
                <img src="images/<?php echo $post_image; ?>" alt="" class="img-fluid">
            </div>

            <h2 class="entry-title">
              <?php echo $post_title; ?>
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
            </div>
          </article><!-- End blog entry -->

          <?php } ?>
          <hr>
          <div class="blog-comments" data-aos="fade-up">

             <?php  
                if ($count_comments >= 1) {
                 echo "<h4 class='comments-count'>$count_comments comment(s)</h4>";
                } else {
                 echo "<h4 class='comments-count'>Be the first to Comment</h4>";
               }
              ?>


            <!-- Posted Comments -->
            

            <?php  
            $the_post_id = $_GET['p_id'];
            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC ";
            $selectCommentQuery = mysqli_query($connection, $query);
            if (!$selectCommentQuery) {
                die("Query Failed " . mysqli_error($connection));
            }


            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
            // $updateCommentCount = mysqli_query($connection, $query);


            while ($row = mysqli_fetch_array($selectCommentQuery)) {
              $comment_date = $row['comment_date'];
              $comment_content = $row['comment_content'];
              $comment_author = $row['comment_author'];

              ?>

            <div id="comment-1" class="comment clearfix">
              <h5><?php echo $comment_author; ?><a href="#" class="reply"><i class="icofont-reply"></i> Reply</a></h5>
              <time datetime="2020-01-01"><?php echo $comment_date; ?></time>
              <p>
                <?php echo $comment_content; ?>
              </p>

            </div><!-- End comment #1 -->
            <?php } ?>      
        
            <?php  

              if (isset($_POST['create_comment'])) {
                  $the_post_id = $_GET['p_id'];

                  $comment_author = escape($_POST['comment_author']);
                  $comment_email = escape($_POST['comment_email']);
                  $comment_content = escape($_POST['comment_content']);

                  if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                      $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now())";
                      $createCommentQuery = mysqli_query($connection, $query);

                      if (!$createCommentQuery) {
                          die("Query Failed" . mysqli_error($connection));
                      } else{
                          echo "<script>alert('Fields Can not be blank')</script>";
                      }
                  }
              }
            ?>

            <!-- comments form -->
            <div class="reply-form">
              <h4>Leave a Reply</h4>
              <p>Your email address will not be published. Required fields are marked * </p>
              <form action="" role="form" action="POST">
                <div class="row">
                  <div class="col form-group">
                    <input name="comment_author" type="text" class="form-control" placeholder="Your Full Name*">
                  </div>
                </div>
                <div class="row">
                  <div class="col form-group">
                    <input name="comment_email" type="email" class="form-control" placeholder="Your Email*">
                  </div>
                </div>
                <div class="row">
                  <div class="col form-group">
                    <textarea name="comment_content" class="form-control" placeholder="Your Comment*"></textarea>
                  </div>
                </div>
                <button type="submit" name="create_comment" class="btn btn-primary">Post Comment</button>
              </form>
            </div>
             
          </div>

            <?php }  else {
                header("Location: index.php");
              }
            ?>       
        </div><!-- End blog entries list -->
        <!-- Sidebar here  -->
        <?php include 'includes/Sidebar.php'; ?>
      </div>
    </div>
  </section><!-- End Blog Section -->
</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>