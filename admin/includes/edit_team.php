<?php 
  if (isset($_GET['edit_team'])) {
    $the_team_id = $_GET['edit_team'];

    $query = "SELECT * FROM team WHERE team_member_id = $the_team_id";
    $selectUserById = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($selectUserById)) {
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

    }

    if (isset($_POST['edit_team'])) {
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

    if (empty($image)) {
      $query = "SELECT * FROM team WHERE team_member_id = {$the_team_id} ";
      $selectImage = mysqli_query($connection, $query);
      
      while($row = mysqli_fetch_array($selectImage)) {
        $image = $row['team_member_img'];
      }
    }

    $query = "UPDATE team SET team_member_name = '{$name}', team_member_title = '{$position}', team_member_img = '{$image}', team_member_twitter = '{$twitter_link}', team_member_instagram = '{$instagram_link}' , team_member_facebook = '{$facebook_link}', team_member_linkin = '{$linkin_link}', team_member_bio = '{$biography}' WHERE team_member_id = '{$the_team_id}'";

    $update_team = mysqli_query($connection, $query);

    confirm($update_team);

    echo "<p>Post Updated. <a href='team.php'>Edit More Team Member?</a></p>";
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10 align-items-center">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="">Name</label>
          <input value="<?= $team_member_name;?>" type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label for="title">Position</label>
          <input value="<?= $team_member_title;?>" type="text" class="form-control" name="position">
        </div>

        <div class="form-group">
          <label for="post_image">Image</label>
          <input value="<?= $team_member_img;?>" type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
          <label for="title">Twitter Link</label>
          <input value="<?= $team_member_twitter;?>" type="text" class="form-control" name="twitter_link">
        </div>  

        <div class="form-group">
          <label for="post_tags">Instagram Link</label>
          <input value="<?= $team_member_instagram;?>" type="text" class="form-control" name="instagram_link">
        </div>

        <div class="form-group">
          <label for="post_tags">Facebook Link</label>
          <input value="<?= $team_member_facebook;?>" type="text" class="form-control" name="facebook_link">
        </div>

        <div class="form-group">
          <label for="post_tags">Linkin</label>
          <input value="<?= $team_member_linkin;?>" type="text" class="form-control" name="linkin_link">
        </div>

        <div class="form-group">
          <label for="post_content">Biography</label>
          <textarea class="form-control" name="biography" id="body" rows="30" cols="10"><?php echo str_replace('\r\n', '</br>', $team_member_bio);?></textarea> 
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="edit_team" value="Update Team Member">
        </div>
      </form>
      </div>
  </div>
  <div class="col-lg-1"></div>
</div>