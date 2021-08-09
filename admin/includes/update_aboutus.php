<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit The About Us Page</label>

        <?php  // Update About Us page

            if (isset($_GET['edit'])) {
                $about_id = $_GET['edit'];

                $query = "SELECT * FROM about WHERE about_id = $about_id ";
                $updateAboutus = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($updateAboutus)) {
                    $about_id = $row['about_id'];
                    $about_content = $row['about_content'];
            ?>  

        <textarea class="form-control" name="about_content" id="body" rows="20" cols="10"><?php echo str_replace('\r\n', '</br>', $about_content);?></textarea>
        <?php } } ?>

        <?php  

            // This code is working but I preferably use the prepare statement for security purpose

          // if (isset($_POST['updateCategory'])) {
          //       $theCatTitle = $_POST['cat_title'];

          //       $query = "UPDATE categories SET cat_title = '{$theCatTitle}' WHERE cat_id = {$cat_id} ";
          //       $updateQuery = mysqli_query($connection, $query);
          //       if (!$updateQuery) {
          //           die("Query Failed" . mysqli_error($connection));
          //       }
          //   }  

            if(isset($_POST['update_aboutus'])) {

                $the_aboutus_content = escape($_POST['about_content']);

                $stmt = mysqli_prepare($connection, "UPDATE about SET about_content = ? WHERE about_id = ? ");

                mysqli_stmt_bind_param($stmt, 'si', $the_aboutus_content, $about_id);

                mysqli_stmt_execute($stmt);


                if(!$stmt){
                      
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                mysqli_stmt_close($stmt);

                redirect("about.php");
          
         }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="update_aboutus" value="Update About Us Page">
    </div>
</form> 