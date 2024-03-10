<?php 

include('middleware.php');
include('./db_connection.php');

$emp_view_query='select me.*, mr.id role_id, mr.role_name,
md.id designation_id, md.designation_name,md.description from mst_employee me
left join mst_roles mr on mr.id = me.emp_role_id
left join mst_designation md on md.id = me.emp_designation_id
where me.id='.$_GET['id'];

$eqry=mysqli_query($con,$emp_view_query);

$row=mysqli_fetch_array($eqry);

include('./header.php'); 
?>

<div class="container">
    <div class="main-body">
          <div class="row gutters-sm mt-3">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <?php 
                    $ext = explode('.',$row['emp_profile_pic']);
                    $ext_arr=array('jpg','jpeg','png');                   
                    if(in_array(strtolower(end($ext)),$ext_arr) && strpos($row['emp_profile_pic'],"ploads/")) 
                      echo '<img src="'.$row['emp_profile_pic'].'" alt="Admin" class="rounded-circle" width="150">';
                    else echo '<img src="./assets/img/unkown.png" alt="Admin" class="rounded-circle" width="150">';
                    ?>
                    <div class="mt-3">
                      <h3><?php echo ucfirst($row['emp_name'].' '.$row['emp_last_name']); ?></h3>
                      <!-- <p class="text-secondary mb-1"><b>Employee ID  :</b> <?php echo $row['id']; ?></p> -->
                      <p><b><?php echo ucfirst($row['designation_name'].' - '.$row['description']);?></b></p>
                      
                    </div>
                  </div>
                </div>
               </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h3 text-align="center">Personal Details</h3>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Date of Birth</h6>
                        <span class="text-secondary"><?php echo $row['emp_date_of_birth']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Blood Group</h6>
                        <span class="text-secondary"><?php echo $row['emp_blood_group']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Gender</h6>
                        <span class="text-secondary"><?php echo $row['emp_gender']; ?></span>
                    </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h3 text-align="center">Contact Details</h3>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Email ID</h6>
                        <span class="text-secondary"><?php echo $row['emp_email']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Contact No</h6>
                        <span class="text-secondary"><?php echo $row['emp_contact_no']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Emergency Contact No</h6>
                        <span class="text-secondary"><?php echo $row['emp_emergency_contact_no']; ?></span>
                    </li>
                   
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Address </h6>
                        <span class="text-secondary"><?php echo $row['emp_address']; ?></span>
                    </li>
                    </ul>
                </div>
            </div>
          </div>
          <div class="col-md-4 mb-3">
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h3 text-align="center">Official Details</h3>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Date of Joining</h6>
                        <span class="text-secondary"><?php echo $row['emp_date_of_joining']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Role to Access Board</h6>
                        <span class="text-secondary"><?php echo $row['role_name']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Login Username</h6>
                        <span class="text-secondary"><?php echo $row['emp_username']; ?></span>
                    </li>
                   
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">Login Password </h6>
                        <span class="text-secondary" type="password"><?php echo $row['emp_password']; ?></span>
                    </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
            
<?php include('./footer.php'); ?>
