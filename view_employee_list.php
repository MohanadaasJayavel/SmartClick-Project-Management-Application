<?php
include('middleware.php');
include('./db_connection.php');

$query= "select me.*, mr.id role_id, mr.role_name,
md.id designation_id, md.designation_name from mst_employee me
left join mst_roles mr on mr.id = me.emp_role_id
left join mst_designation md on md.id = me.emp_designation_id where me.is_removed = false";
$eqry=mysqli_query($con,$query);
$emp_count_query="
select count(id) total_emp_count ,
	(select count(id) from mst_employee where emp_designation_id=4 and  is_active=true) emp_tl_count,
	(select count(id) from mst_employee where emp_designation_id=5 and  is_active=true) emp_se_count,
    (select count(id) from mst_employee where emp_designation_id=6 and  is_active=true) emp_ase_count,
	(select count(id) from mst_employee where emp_designation_id=7 and  is_active=true) emp_qa_count from mst_employee where  is_active =true";
$count_eqry=mysqli_query($con,$emp_count_query);
$count_data=mysqli_fetch_array($count_eqry);

include('./header.php');
 ?>
<main>
                    <div class="container-fluid px-4"><br>
                    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Employee Dashboard</li>
                        </ol>
                        <!-- <h1 class="mt-4"><i class="fas fa-clipboard-list"></i> Employee</h1> -->
                        <div class="row">
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body"><h4>Technical Lead  - <?php echo $count_data['emp_tl_count']; ?></h4> </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body"><h4>Associate Developer-<?php echo $count_data['emp_se_count']; ?></h4> </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><h4>Junior Developer - <?php echo $count_data['emp_ase_count']; ?></h4> </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"> <h4>Quality Assurance  - <?php echo $count_data['emp_qa_count']; ?></h4> </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                       
    <?php

    if($_SESSION['msg']!='')
        echo $_SESSION['msg'];
    $_SESSION['msg']='';

    ?>
                        <div class="card mb-4">
                            <div class="card-header text-end" >
                            <a  class="btn btn-primary" href="create_employee.php" ><i class="fa fa-plus" ></i> Add</a>   
                            <a  class="btn btn-success" href="download_employee.php" ><i class="fa fa-download" ></i> Download </a>
                            </div>
                            <br>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    <th>Emp-id</th>
                                            <th>Name</th>                                           
                                            <th>Contact.no</th>
                                            <th>Designation</th>
                                            <th>Is Login User</th>                                         
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                           
                                            <th>Emp-id</th>
                                            <th>Name</th>
                                            <th>Contact.no</th>
                                            <th>Designation</th>
                                            <th>Is Login User</th>                                        
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    
                                    <?php
                                        $sno=1;
                                        while($row=mysqli_fetch_array($eqry)){
                                        
                                    ?>
                                        <tr>
                                             <!-- <td align="center" >
                                                <?php 
                                                $ext = explode('.',$row['emp_profile_pic']);
                                                $ext_arr=array('jpg','jpeg','png');                   
                                                if(in_array(strtolower(end($ext)),$ext_arr) && strpos($row['emp_profile_pic'],"ploads/")) 
                                                echo '<img src="'.$row['emp_profile_pic'].'" alt="Admin"  width="50" height="50">';
                                                else echo '<img src="./assets/img/unkown.png" alt="Admin" width="50" height="50">';
                                                ?>
                                            </td> -->
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['emp_name']; ?></td>
                                           
                                            <td><?php echo $row['emp_contact_no']; ?></td>
                                            
                                            <td><?php echo $row['designation_name']; ?></td>
                                            <td><?php 
                                                if ($row['emp_is_login_user']==true)
                                                {
                                                    echo 'Yes';
                                                } 
                                                else 
                                                {
                                                   echo 'No';
                                                }
                                                ?>
                                            </td>
                                           
                                            <td><?php 
                                                if ($row['is_active']==true)
                                                {
                                                    echo 'active';
                                                } 
                                                else 
                                                {
                                                   echo 'In active';
                                                }
                                                ?></td>
                                            
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <?php

                                                    if(in_array('can_view_employee', $_SESSION['user_permissions'])) 
                                                        echo '<a href="view_employee.php?id='. $row['id'].'" class="btn btn-primary"> <i class="fas fa-eye"></i> View</a>';
                                                    
                                                    if(in_array('can_edit_employee', $_SESSION['user_permissions'])) 
                                                        echo '<a href="edit_employee.php?id='. $row['id'].'" class="btn btn-info"><i class="fas fa-edit" ></i> Edit</a>';
                                                    
                                                    if(in_array('can_delete_employee', $_SESSION['user_permissions'])) 
                                                        echo '<a href="delete_employee.php?id='. $row['id'].'" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
                                                  
                                                ?>
                                                </div>
                                               
                                            </td>
                                        </tr>
                                       <?php 
                                    } ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

<?php include('./footer.php'); ?>                