<?php 

include('middleware.php');
include('./db_connection.php');

$query= "select comp_name from mst_customers where is_active=true";
$eqry=mysqli_query($con,$query);

$emp_query= "select emp_name from mst_employee where is_active=true";
$emp_q1=mysqli_query($con,$emp_query);

if(isset($_POST['register']))
{
    $name=$_POST['name'];
    $status=$_POST['status'];
    $employee = $_POST['id'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $employee_id=$_POST['employee_id'];
    $description=$_POST['description'];

	  $query="insert into mst_projects(id,name,user_ids,status,start_date,end_date,manager_id,description,is_active,is_removed)
       values('','$name','$employee','$status', '$start_date', '$end_date', '$employee_id','$description',true,false)";
echo($query);


        if( mysqli_query($con,$query)){
       
            $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                        Record Added Sucessfully
                        </div>
                    </div>';
                    header('location:view_project_list.php');
    
           }
           else
           {

            $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                Record Not Added
                </div>
            </div>';
            header('location:view_project_list.php');
    
           }
}
include('./header.php');
?>
  
</main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-14">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><style width: 100px;></style><h3 class="text-left font-weight-light ">New Project </h3></div>
                <div class="card-body">
                    <form method="POST" action="create_project.php" enctype="multipart/form-data">
                        <h5>Project Details</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                <h5>Name</h5>
                                    <div class="form-floating mb-4 mb-md-0">
                                        <input class="form-control" type="text" name="name"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                <h5>Customer</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control select2" name="status"  id="customer" style="width: 100%;">
                                    <option value="Select You Blood Group">---------Select Customer---------</option>
                                        <?php
                                            while($row=mysqli_fetch_array($eqry)){
                                            echo '<option value="'.$row['id'].'" text-align="center">'.$row['comp_name'].'</option>';
                                            }
                                    ?>
                                       
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Engineers</h5>
                                        <div class="form-floating mb-3 mb-md-0">
                                            <select class="form-control select2" name="status"  id="employee" style="width: 100%;">
                                            <option value="Select You Blood Group">---------Select Engineers---------</option>
                                            <?php
                                            while($emp_row=mysqli_fetch_array($emp_q1)){
                                            echo '<option value="'.$emp_row['id'].'" text-align="center">'.$emp_row['emp_name'].'</option>';
                                            }
                                    ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                <h5>Status</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                    <select class="form-control select2" name="status"  id="status" style="width: 100%;">
                                    <option value="Select You Blood Group">------------------Select Status------------------</option>
                                        <option value="Yet to Kick Off">Yet to Kick Off</option>
                                        <option value="Started">Started</option>
                                        <option value="Blocked/Pending">Blocked/Pending</option>
                                        <option value="Inprogress">Inprogress</option>
                                        <option value="On-Hold">On-Hold</option>
                                        <option value="Done">Done</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">                        
                                <div class="col-md-6">
                                    <h5>Start Date</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control"  type="date"  name="start_date" />
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <h5>End Date</h5>
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control"  type="date" name="end_date"  />
                                        </div>
                                </div>
                            </div>
                             <div class="row mb-5">                                               
                                <div class="d-grid " >
                                <input type="submit" id="btn"  class="btn btn-md btn-primary" value="Create Project"  style="width: 580 px; margin: 0 auto"  name="register" />
                            </div>
                         </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
</main>

 <?php include('./footer.php'); ?>