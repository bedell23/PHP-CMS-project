<?php include 'includes/admin_header.php'; ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'includes/admin_side_navbar.php'; ?>

    

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <?php include 'includes/admin_top_navbar.php'; ?>
            
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    All Comments for this post
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>In Response to</th>
                                            <th>Date</th>
                                            <th>Approve</th>
                                            <th>Unapprove</th>
                                            <!-- <th>Edit</th> -->
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php  

                                            $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . " ";
                                            $selectComments = mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($selectComments)) {
                                                # code...
                                                $comment_id = $row['comment_id'];
                                                $comment_post_id = $row['comment_post_id'];
                                                $comment_author = $row['comment_author'];
                                                $comment_content = $row['comment_content'];
                                                $comment_email = $row['comment_email'];
                                                $comment_status = $row['comment_status'];
                                                $comment_date = $row['comment_date'];

                                                echo "<tr>";
                                                echo "<td>$comment_id</td>";
                                                echo "<td>$comment_author</td>";
                                                echo "<td>$comment_content</td>";
                                                echo "<td>$comment_email</td>";
                                                echo "<td>$comment_status</td>";

                                                // Relating comments to post
                                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                                $selectPostId = mysqli_query($connection, $query);

                                                while ($row = mysqli_fetch_assoc($selectPostId)) {
                                                    $post_id = $row['post_id'];
                                                    $post_title = $row['post_title'];

                                                    echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";
                                                }

                                                echo "<td>$comment_date</td>";
                                             echo "<td><a class='btn btn-success' href='post_comments.php?approve=$comment_id&id=" . $_GET['id'] . " '>Approve<a></td>";
                                               echo "<td><a class='btn btn-warning' href='post_comments.php?unapprove=$comment_id&id=" . $_GET['id'] . " '>Unapprove<a></td>";
                                                // echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Edit<a></td>";
                                                echo "<td><a class='btn btn-danger' href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] . " '>Delete<a></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php 

                        if (isset($_GET['approve'])) {
                            $the_comment_id = $_GET['approve'];

                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
                            $approveComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=". $_GET['id'] . " ");
                        }

                        if (isset($_GET['unapprove'])) {
                            $the_comment_id = $_GET['unapprove'];

                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
                            $unapproveComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=". $_GET['id'] . " ");
                        }

                        if (isset($_GET['delete'])) {
                            $the_comment_id = $_GET['delete'];

                            $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                            $deleteComment = mysqli_query($connection, $query);
                            header("Location: post_comments.php?id=". $_GET['id'] ." ");
                        }
                        ?>
                    </div>  
                </div>
                <!-- End of row tag -->
             </div>
        <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        
<?php include 'includes/logout_modal.php'; ?>

<?php include 'includes/admin_footer.php'; ?>    <!-- /.row -->
        
