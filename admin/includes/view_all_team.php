<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">View All Team Members</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Images</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                <?php  

                    $query = "SELECT * FROM team ORDER BY team_member_id DESC";
                    $selectPosts = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($selectPosts)) {
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

                        echo "<tr>";
                        echo "<td>$team_member_id</td>";
                        echo "<td>$team_member_name</td>";
                        echo "<td>$team_member_title</td>";
                        echo "<td><img width='70px' src='../images/$team_member_img'</td>";
                        echo "<td><a class='btn btn-primary' href='team.php?source=edit_team&edit_team={$team_member_id}'>Edit<a></td>";


                        ?>
                        <form method="post">

                            <input type="hidden" name="team_member_id" value="<?= $team_member_id ?>">

                         <?php   

                            echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';
                        ?>
                        </form>
                        <?php
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 

if(isset($_POST['delete'])){
    
    $the_team_id = escape($_POST['team_member_id']);
    
    $query = "DELETE FROM team WHERE team_member_id = {$the_team_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: team.php");   
}
?>

<!-- Delete Modal -->

<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>
-->

<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" href="../includes/logout.php">Save changes</a>
      </div>
    </div>
  </div>
</div>
-->

