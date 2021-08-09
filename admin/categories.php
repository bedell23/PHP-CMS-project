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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
                    <a class="nav-link" href="#" id="userDropdown" role="button"
                         aria-haspopup="true" aria-expanded="true">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php  
                                if (isset($_SESSION['firstname'])) {
                                    $firstname = $_SESSION['firstname'];
                                    echo $firstname;
                                }
                            ?>
                        </span>
                        <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                    </a>
                </div>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <?php insert_categories(); ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat-title">Category Title</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php 

                            if (isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include 'includes/update_category.php';
                            }
                        ?>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">

                        <table class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php findAllCategories(); ?>

                                <?php deleteCategories(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->           
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        
<?php include 'includes/logout_modal.php'; ?>

<?php include 'includes/admin_footer.php'; ?>
