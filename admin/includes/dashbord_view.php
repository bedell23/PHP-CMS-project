<!-- Content Row -->
<div class="row">

    <!-- Total Posts -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php  
                                        
                               $post_counts = recordCount('posts');
                              echo "<div class='font-weight-bold'>{$post_counts}</div>"
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a class="" href="posts.php">
                <div class="card-footer ">
                    <div class="row no-gutters align-items-center">
                        <span class="col mr-2 font-weight-bold">
                            View Details
                        </span>
                        <span class="col-auto"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Total Comments -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Comments
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php  
                                $comment_counts = recordCount('comments');
                              echo "<div class='font-weight-bold'>{$comment_counts}</div>"
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a class="" href="comments.php">
                <div class="card-footer ">
                    <div class="row no-gutters align-items-center">
                      <span class="col mr-2 text-success font-weight-bold">
                            View Details
                        </span>
                        <span class="col-auto text-success"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Total Users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php  
                                        $user_counts = recordCount('users');
                                     echo "<div class='font-weight-bold'>{$user_counts}</div>"
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a class="" href="users.php">
                <div class="card-footer ">
                    <div class="row no-gutters align-items-center">
                        <span class="col mr-2 text-info font-weight-bold">
                            View Details
                        </span>
                        <span class="col-auto text-info"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php  
                                $category_counts = recordCount('Categories');
                              echo "<div class='font-weight-bold'>{$category_counts}</div>"
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
            <a class="" href="Categories.php">
                <div class="card-footer ">
                    <div class="row no-gutters align-items-center">
                        <span class="col mr-2 text-warning font-weight-bold">
                            View Details
                        </span>
                        <span class="col-auto text-warning"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>