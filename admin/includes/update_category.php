<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php  // Update Categories

            if (isset($_GET['edit'])) {
                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                $updateCategories = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($updateCategories)) {
                    # code...
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
            ?>  

        <input value="<?php if(isset($cat_title)) { echo $cat_title;}  ?>" class="form-control" type="text" name="cat_title">
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

            if(isset($_POST['update_category'])) {

                $the_cat_title = escape($_POST['cat_title']);

                $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");

                mysqli_stmt_bind_param($stmt, 'si', $the_cat_title, $cat_id);

                mysqli_stmt_execute($stmt);


                if(!$stmt){
                      
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                mysqli_stmt_close($stmt);

                redirect("categories.php");
          
         }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" name="update_category" value="Update Category">
    </div>
</form> 