<?php 

include('middleware.php');
include('./db_connection.php');

// $emp_view_query='select me.*, mr.id role_id, mr.role_name,
// md.id designation_id, md.designation_name,md.description from mst_employee me
// left join mst_roles mr on mr.id = me.emp_role_id
// left join mst_designation md on md.id = me.emp_designation_id
// where me.id='.$_GET['id'];
$project_view_query = 'select * from mst_projects where id='.$_GET['id'];
$eqry=mysqli_query($con,$project_view_query);
$row=mysqli_fetch_array($eqry);

include('./header.php'); 
?>

<div class="container">
    <div class="main-body">
          <div class="row gutters-sm mt-3">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div>
                            <div class="d-flex flex-column align-items-start text-left">
                                <div class="mt-3">
                                    <b  class="border-bottom border-primary">Project Name</b>
                                    <!-- <p class="text-secondary mb-1"><b>Employee ID  :</b> <?php echo $row['id']; ?></p> -->
                                    <p class="paragraph"><?php echo $row['name'];?></p>
                                    <br>
                                    <b  class="border-bottom border-primary">Description</b>
                                    <p><?php echo $row['description']; ?></p>
                                </div>
                            </div>
                            <!-- <div class="d-flex flex-column align-items-right text-right"> -->
                            <div class="d-flex flex-column align-items-end text-left">
                                <div class="mt-3">
                                    <b  class="border-bottom border-primary">Start Date</b>
                                    <!-- <p class="text-secondary mb-1"><b>Employee ID  :</b> <?php echo $row['id']; ?></p> -->
                                    <p><?php echo ucfirst($row['name']);?></p>
                                    <br>
                                    <b  class="border-bottom border-primary">End Date</b>
                                    <p><?php echo $row['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>                                                                                                          
                </div>
            </div>
            </div>
          </div>
    </div>
</div>
            
<?php include('./footer.php'); ?>
