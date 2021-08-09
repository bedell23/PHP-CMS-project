<?php 

    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
            $bulk_options = $_POST['bulk_options'];

            switch ($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}' ";
                    $update_to_published = mysqli_query($connection, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}' ";
                    $update_to_draft = mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = '{$checkBoxValue}' ";
                    $delete_post = mysqli_query($connection, $query);
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}' ";
                    $clone_post = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($clone_post)) {
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }

                    $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_author, post_status, post_image, post_tags, post_content) VALUES({$post_category_id}, '{$post_title}', now(), '{$post_author}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}')";
                    $copy_query = mysqli_query($connection, $query);
                    if (!$copy_query) {
                        die("Query Failed" . mysqli_error($connection));
                    }
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }

?>

<form action="" method="POST">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View All Posts</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                <div class="row">
                    <div class="col-lg-6 mb-4" id="bulkOptionsContainer">
                        <select class="form-control" name="bulk_options" id="">
                            <option>Select Options</option>
                            <option value="published">Publish</option>
                            <option value="draft">Draft</option>
                            <option value="delete">Delete</option>
                            <option value="clone">Clone</option>
                        </select>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <input type="submit" name="submit" class="btn btn-success" value="Apply">
                        <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
                    </div>
                </div>

                <thead>
                    <tr>
                        <th><input id="selectAllBoxes" type="checkbox" name="checkbox"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Categories</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Post Views</th>
                    </tr>
                </thead>
                <tbody>

                <?php  

                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $selectPosts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($selectPosts)) {
                        # code...
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_user = $row['post_user'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views_count = $row['post_views_count'];

                        echo "<tr>";
                        ?>
                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>

                        <?php
                        echo "<td>$post_id</td>";
                        echo "<td>$post_author</td>";
                        echo "<td>$post_title</td>";

                        // Category

                        $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                        $updateCategories = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($updateCategories)) {
                            # code...
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<td>$cat_title</td>";
                        }

                        echo "<td>$post_status</td>";
                        echo "<td><img width='70px' src='../images/$post_image'</td>";
                        echo "<td>$post_tags</td>";

                        // displaying total amount of comment per post
                        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                        $send_query_count = mysqli_query($connection, $query);

                        $row = mysqli_fetch_array($send_query_count);
                        $count_comments = mysqli_num_rows($send_query_count);

                        echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";


                        echo "<td>$post_date</td>";
                        echo "<td><a class='btn btn-success' href='../post.php?p_id={$post_id}'>View Post<a></td>";
                        echo "<td><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>Edit<a></td>";


                        ?>
                        <form method="post">

                            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">

                         <?php   

                            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
                        ?>
                        </form>
                        <?php


                        // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                        //echo "<td><a href='posts.php?delete={$post_id}'>Delete<a></td>";
                        echo "<td><a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>            
            </table>
        </div>
    </div>
</div>
</form>

<?php 

if(isset($_POST['delete'])){
    
    $the_post_id = escape($_POST['post_id']);
    
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");   
}

if (isset($_GET['reset'])) {
    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$the_post_id} ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: posts.php ");
}
?>


