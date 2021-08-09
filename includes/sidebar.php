<div class="col-lg-4">

  <div class="sidebar" data-aos="fade-left">

    <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form">
      <form action="search.php" method="POST">
        <input type="text" name="search">
        <button type="submit" name="searchBtn"><i class="icofont-search"></i></button>
      </form>
    </div><!-- End sidebar search formn-->

    <!-- Sidebar categories -->

    <?php 
        $query = "SELECT * FROM categories";
        $selectSidebar = mysqli_query($connection, $query);
    ?>

    <h3 class="sidebar-title">Categories</h3>
    <div class="sidebar-item categories">
      <ul>

        <?php 

          $query = "SELECT * FROM categories";
          $select_category = mysqli_query($connection, $query);
        

          while($row = mysqli_fetch_assoc($selectSidebar)) {
              # code...
              $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];

              echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
          }
        ?>
      </ul>
    </div><!-- End sidebar categories-->

    <h3 class="sidebar-title">Recent Posts</h3>

    <?php  
      // Recent post Stories

      $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC LIMIT 0, 10";
      $selectPosts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($selectPosts)) {
      # code...
      $post_id = $row['post_id'];
      $post_title = $row['post_title'];
      $post_date = $row['post_date'];
      $post_image = $row['post_image'];
    ?>

    <div class="sidebar-item recent-posts my-3">
      <div class="post-item clearfix">
        <a href="post.php?p_id=<?= $post_id; ?>"><img src="images/<?= $post_image; ?>" alt=""></a>
        <h4><a href="post.php?p_id=<?= $post_id; ?>"><?= $post_title; ?></a></h4>
        <time datetime="2020-01-01"><?= $post_date; ?></time>
      </div>
    <?php } ?>
    </div><!-- End sidebar recent posts-->

    <!-- <h3 class="sidebar-title">Tags</h3>
    <div class="sidebar-item tags">
      <ul>
        <li><a href="#">App</a></li>
        <li><a href="#">IT</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Mac</a></li>
        <li><a href="#">Design</a></li>
        <li><a href="#">Office</a></li>
        <li><a href="#">Creative</a></li>
        <li><a href="#">Studio</a></li>
        <li><a href="#">Smart</a></li>
        <li><a href="#">Tips</a></li>
        <li><a href="#">Marketing</a></li>
      </ul>
    </div> --><!-- End sidebar tags-->
  </div><!-- End sidebar -->
</div><!-- End blog sidebar -->