<?php 

  if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
  } 

  $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
  $selectPostsById = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($selectPostsById)) {
    # code...
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
  }

  if (isset($_POST['create_post'])) {

    $post_title = escape($_POST['post_title']);
    $author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['image'] ['name']);
    $post_image_temp = escape($_FILES['image'] ['tmp_name']);

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
      $query = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
      $selectImage = mysqli_query($connection, $query);
      
      while($row = mysqli_fetch_array($selectImage)) {
        $post_image = $row['post_image'];
      }
    }

    $query = "UPDATE posts SET post_title = '{$post_title}', post_author = '{$author}', post_category_id = '{$post_category_id}', post_status = '{$post_status}', post_date = now() , post_image = '{$post_image}', post_tags = '{$post_tags}', post_content = '{$post_content}' WHERE post_id = '{$the_post_id}'";

    $updatePost = mysqli_query($connection, $query);

    confirm($updatePost);

    echo "<p>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
  }

?>

<div class="container">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input value="<?php echo $post_title;?>" type="text" class="form-control" name="post_title">
        </div>

        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" name="post_category" id="post_category">
            <?php  
                $query = "SELECT * FROM categories";
                $updateCategories = mysqli_query($connection, $query);

                confirm($updateCategories);

                while($row = mysqli_fetch_assoc($updateCategories)) {
                  # code...
                  $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];

                  if($cat_id == $post_category_id) {
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                  } else {
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                  }          }
            ?> 
          </select>
        </div>

        <div class="form-group">
          <label for="author">Author</label>
          <select name="author" id="">
            <?php echo "<option value='{$post_author}'>{$post_author}</option>"; ?>    
            <?php

                    $users_query = "SELECT * FROM users WHERE user_role = 'admin' ";
                    $select_users = mysqli_query($connection,$users_query);
                    
                    confirm($select_users);

                    while($row = mysqli_fetch_assoc($select_users)) {
                    $user_id = $row['user_id'];
                    $firstname = $row['user_firstname'];                  
                        
                      echo "<option value='{$firstname}'>{$firstname}</option>";     
                    }

            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="status">Status</label>
          <select class="form-control" name="post_status" id="post_status">
            <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>";
              <?php
                
                if($post_status == 'published' ) {
                  echo "<option value='draft'>Draft</option>";
                } else {
                  echo "<option value='published'>Publish</option>"; 
                }      
              ?>
          </select>
        </div>

        <div class="form-group">
          <img width="100px;" src="../images/<?php echo $post_image; ?>">
          <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
          <label for="post_tags">Post Tags</label>
          <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
          <label for="post_content">Post Content</label>
          <textarea  class="form-control" name="post_content" id="body" rows="30" cols="10"><?php echo str_replace('\r\n', '</br>', $post_content);?></textarea> 
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="create_post" value="Update Post">
        </div>
      </form>
    </div>
  </div>
  <div class="col-lg-1"></div>
</div>