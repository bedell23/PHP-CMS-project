<?php 

  // this segment is for getting the data from the form field
  if (isset($_POST['create_post'])) {
    $post_title = escape($_POST['post_title']);
    $author = escape($_POST['author']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');

    // image codes below
    $post_image = escape(time() . '_' . $_FILES['image'] ['name']);
    $post_image_temp = escape($_FILES['image'] ['tmp_name']);
    $post_image_size = escape($_FILES['image']['size']);
    $post_image_error = escape($_FILES['image']['error']);

    $imageExt = explode('.', $post_image);
    $imageActualExt = strtolower(end($imageExt));

    $allowed =  array('jpg', 'jpeg', 'png', 'gif', 'svg', 'psd', 'ai', 'tiff', 'pdf' );

    if (in_array($imageActualExt, $allowed)) {
      if ($post_image_error === 0) {
        print_r($post_image_error);
        if ($post_image_size < 1000000) {
          move_uploaded_file($post_image_temp, "../images/$imageActualExt");
          $img = "INSERT INTO posts(post_image) VALUES($imageActualExt)";
          $add_post = mysqli_query($connection, $query);
        } else {
          echo "Your file is too big";
        }
      } else {
      echo "There was an error uploading your file!";
      }
    } else {
      echo "You cannot upload file with this type of extention!";
    } // image codes end here

    // move_uploaded_file($post_image_temp, $imageDestination);

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status ) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$author}', now(), '{$imageActualExt}', '{$post_content}', '{$post_tags}', '$post_status' ) ";

    $add_post = mysqli_query($connection, $query);

   confirm($add_post);

    echo "<p>Post Created. <a href='posts.php'>View All Posts</a></p>";
  }
?>
<div class="container">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
        </div>

        <label for="categories">Category</label>
        <div class="form-group">
          <select class="form-control" name="post_category" id="post_category">
            <?php  
                $query = "SELECT * FROM categories";
                $updateCategories = mysqli_query($connection, $query);

                confirm($updateCategories);

                while($row = mysqli_fetch_assoc($updateCategories)) {
                  # code...
                  $cat_id = $row['cat_id'];
                  $cat_title = $row['cat_title'];

                  echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?> 
          </select>
        </div>

        <label for="author">Author</label>
        <div class="form-group">
          <select class="form-control" name="author" id="author">
            <?php  
                $query = "SELECT * FROM users WHERE user_role = 'admin' ";
                $selectUser = mysqli_query($connection, $query);

                confirm($selectUser);

                while($row = mysqli_fetch_assoc($selectUser)) {
                  $user_id = $row['user_id'];
                  $user_firstname = $row['user_firstname'];

                  echo "<option value='{$user_firstname}'>{$user_firstname}</option>";
                }
            ?> 
          </select>
        </div>

        <label for="post_status">Post Status</label>
        <div class="form-group">
         <select class="form-control" name="post_status" id="">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
        </div>

        <div class="form-group">
          <label for="post_image">Post Image</label>
          <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
          <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
          <label for="post_content">Post Content</label>
          <textarea class="form-control" name="post_content" id="body" rows="30" cols="10"></textarea> 
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
        </div>
      </form>
      </div>
  </div>
  <div class="col-lg-1"></div>
</div>