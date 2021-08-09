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

                        <?php
                            
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            switch ($source) {
                                case 'add_team':
                                    include 'includes/add_team.php';
                                break;

                                case 'edit_team':
                                    include 'includes/edit_team.php';
                                break;
                                
                                default:
                                    include 'includes/view_all_team.php';
                                break;
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        

<?php include 'includes/logout_modal.php'; ?>

<?php include 'includes/admin_footer.php'; ?>
