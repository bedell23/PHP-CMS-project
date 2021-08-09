<?php 

  // this segment is for getting the data from the form field
  if (isset($_POST['create_team_member'])) {
    $name = escape($_POST['name']);
    $position = escape($_POST['position']);

    $image = escape($_FILES['image'] ['name']);
    $image = "../images/".$image;
    $image_temp = escape($_FILES['image'] ['tmp_name']);

    $twitter_link = escape($_POST['twitter_link']);
    $instagram_link = escape($_POST['instagram_link']);
    $facebook_link = escape($_POST['facebook_link']);
    $linkin_link = escape($_POST['linkin_link']);

    $biography = escape($_POST['biography']);

    move_uploaded_file($image_temp, $image);

    $query = "INSERT INTO team(team_member_name, team_member_title, team_member_img, team_member_twitter, team_member_instagram, team_member_facebook, team_member_linkin, team_member_bio ) ";
    $query .= "VALUES('{$name}', '{$position}', '{$image}', '{$twitter_link}', '{$instagram_link}', '{$facebook_link}', '$linkin_link', '$biography' ) ";

    $add_team = mysqli_query($connection, $query);

   confirm($add_team);

    echo "<p>New Team Member Created. <a href='team.php'>View Team Members</a></p>";
  }
?>
<div class="container">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="title">Position</label>
          <input type="text" class="form-control" name="position">
        </div>

        <div class="form-group">
          <label for="post_image">Image</label>
          <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
          <label for="title">Twitter Link</label>
          <input type="text" class="form-control" name="twitter_link">
        </div>  

        <div class="form-group">
          <label for="post_tags">Instagram Link</label>
          <input type="text" class="form-control" name="instagram_link">
        </div>

        <div class="form-group">
          <label for="post_tags">Facebook Link</label>
          <input type="text" class="form-control" name="facebook_link">
        </div>

        <div class="form-group">
          <label for="post_tags">Linkin Link</label>
          <input type="text" class="form-control" name="linkin_link">
        </div>

        <div class="form-group">
          <label for="post_content">Biography</label>
          <textarea class="form-control" name="biography" id="body" rows="30" cols="10"></textarea> 
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="create_team_member" value="Add Team Member">
        </div>
      </form>
      </div>
  </div>
  <div class="col-lg-1"></div>
</div>