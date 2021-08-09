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
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
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

                <?php include 'includes/dashbord_view.php'; ?>


                <!-- Content Row -->
                
                <div class="row">
                    <!-- Area Chart -->
                    <div class="text-center col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <!-- <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div> -->

                                <?php
            
                                    $published_post_counts = checkStatus('posts', 'post_status', 'published');

                                    $draft_post_counts = checkStatus('posts', 'post_status', 'draft');

                                    $unapproved_comments_counts = checkStatus('comments', 'comment_status', 'unapproved');

                                    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                                    $select_subscriber_user = mysqli_query($connection, $query);
                                    $subscriber_counts = mysqli_num_rows($select_subscriber_user);
                                ?>



                                    <script type="text/javascript">
                                      google.charts.load('current', {'packages':['bar']});
                                      google.charts.setOnLoadCallback(drawChart);

                                      function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                          ['Data', 'Count'],

                                          <?php  
                                            $element_text = ['Total Posts', 'Publish Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscriber', 'Categories'];
                                            $element_count = [$post_counts, $published_post_counts, $draft_post_counts, $comment_counts, $unapproved_comments_counts, $user_counts, $subscriber_counts, $category_counts];
                                            for ($i = 0; $i < 8; $i++) {
                                            echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                                            }
                                          ?>

                                          // ['Posts', 1000]
                                        ]);

                                        var options = {
                                          chart: {
                                            title: '',
                                            subtitle: '',
                                          }
                                        };

                                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                      }
                                    </script>
                                 <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                            </div>    <!-- Card Body tag Ends  -->
                        </div>
                    </div>
                </div>             
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

      
<?php include 'includes/logout_modal.php'; ?>

<?php include 'includes/admin_footer.php'; ?>
