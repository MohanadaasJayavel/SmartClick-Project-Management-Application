<?php
include('middleware.php');
include('./db_connection.php');


// $emp_view_query='select mc.*, mr.id role_id, mr.role_name,
// md.id designation_id, md.designation_name from mst_employee me
// left join mst_roles mr on mr.id = me.emp_role_id
// left join mst_designation md on md.id = me.emp_designation_id
// where me.id='.$_GET['id'];

$cust_view_query='select * from mst_customers where id='.$_GET['id'];

$eqry=mysqli_query($con,$cust_view_query);

$row=mysqli_fetch_array($eqry);

 include('./header.php'); 
 ?>
<main>
<div class="container">
    <div class="main-body">
        <div class="row gutters-sm mt-3">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h3 text-align="center">Organization Details</h3>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Organization Name </h6>
                                <span class="text-secondary"><?php echo $row['name']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contact No</h6>
                                <span class="text-secondary"><?php echo $row['contact_no']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email</h6>
                                <span class="text-secondary"><?php echo $row['email_address']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Website Link</h6>
                                <span class="text-secondary"><?php echo $row['web_link']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Address</h6>
                                <span class="text-secondary"><?php echo $row['address']; ?></span>
                            </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h3 text-align="center">Contact Person Details</h3>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"> Name </h6>
                                <span class="text-secondary"><?php echo $row['contact_name']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Contact No</h6>
                                <span class="text-secondary"><?php echo $row['contact_ph_no']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Email</h6>
                                <span class="text-secondary"><?php echo $row['cont_email']; ?></span>
                            </li>
                            <!-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Website Link</h6>
                                <span class="text-secondary"><?php echo $row['comp_web_link']; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">Address</h6>
                                <span class="text-secondary"><?php echo $row['comp_address_1']; ?></span>
                            </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
</div>
</main>
           
<?php include('./footer.php'); ?>


