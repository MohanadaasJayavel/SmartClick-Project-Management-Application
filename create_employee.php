<?php 
include('middleware.php');
include('./db_connection.php');

if(isset($_POST['register']))
{
    $emp_name=$_POST['emp_name'];
    $emp_last_name=$_POST['emp_last_name'];
    $emp_gender=$_POST['emp_gender'];
    $emp_contact_no=$_POST['emp_contact_no'];
    $emp_emergency_contact_no=$_POST['emp_emergency_contact_no'];
    $emp_date_of_birth=$_POST['emp_date_of_birth'];
    $emp_date_of_joining=$_POST['emp_date_of_joining'];
    $emp_email=$_POST['emp_email'];
    $emp_address=$_POST['emp_address'];
    $emp_blood_group=$_POST['emp_blood_group'];
    $emp_username=$_POST['emp_username'];
    $emp_password=$_POST['emp_password'];
    $emp_profile_pic=$_POST['emp_profile_pic'];
    $emp_designation_id=$_POST['emp_designation'];
    $emp_role_id=$_POST['emp_role'];
    
    
    if($emp_role_id!=""){
        $emp_is_login_user=true; 
        
    }
    else {
        $emp_is_login_user=false;
        $emp_role_id='NULL';
    }

    $file_ext=strtolower(end(explode('.',$_FILES['emp_profile_pic']['name'])));
     $emp_profile_pic= "uploads/employee_photos/".str_replace(" ","",$emp_name).'_'.date('YmdHis').'.'.$file_ext;
     $file_tmp = $_FILES['emp_profile_pic']['tmp_name'];
    
    move_uploaded_file($file_tmp,$emp_profile_pic);
    
	  $query="insert into mst_employee (id,emp_name,emp_last_name,emp_gender,emp_contact_no,emp_emergency_contact_no,emp_date_of_birth,emp_date_of_joining,
      emp_email,emp_address,emp_blood_group,emp_is_login_user,emp_username,emp_password,emp_profile_pic,emp_role_id,emp_designation_id,is_active,is_removed)
       values('','$emp_name','$emp_last_name','$emp_gender','$emp_contact_no', '$emp_emergency_contact_no', '$emp_date_of_birth', '$emp_date_of_joining', '$emp_email', '$emp_address', 
      '$emp_blood_group', '$emp_is_login_user', '$emp_username', '$emp_password', '$emp_profile_pic',$emp_role_id,$emp_designation_id,true,false )";
     
     
      if( mysqli_query($con,$query)){
       
        $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    Record Added Sucessfully
                    </div>
                </div>';
                header('location:view_employee_list.php');

       }
       else
       {
        $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Record Not Added
            </div>
        </div>';
        header('location:view_employee_list.php');

       }
    
      
}





include('./header.php');
?>

<main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create  Employee </h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="create_employee.php" enctype="multipart/form-data">
                                            <h5>Employee details</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" name="emp_name" placeholder="Enter your first name" />
                                                        <label for="emp_name"> First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="emp_last_name" placeholder="Enter your last name" />
                                                        <label for="emp_last_name"> Last Name</label>
                                                    </div>
                                                </div>
                                                 
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                       

                                                        <input class="form-control" type="phone"  name="emp_contact_no" placeholder="123-45-678">
                                                        <label for="emp_contact_no"> Contact No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="emp_emergency_contact_no" placeholder="Enter your emergency contact_no" />
                                                        <label for="emp_emergency_contact_no"> Emergency Contact No</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="date"  name="emp_date_of_birth"  placeholder="Enter your Date of Birth"/>
                                                        <label for="emp_date_of_birth"> Date-Of-Birth</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="date" name="emp_date_of_joining" placeholder="Enter your Date Of Joining" />
                                                        <label for="emp_date_of_joining"> Date-Of-Joining</label>
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text"  name="emp_email" placeholder="Enter your email" />
                                                        <label for="emp_email"> Email ID</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">

                                                            <div class="form-group">
                                                                    <label for="exampleInputFile">Upload Profile Pic</label>
                                                                    <input type="file" id="emp_profile_pic"  name="emp_profile_pic" value="Photo" />
                                                             </div>
                                                   
                                                </div>
                                                 
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="emp_bloodgroup">Blood Group </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_blood_group" >
                                                        <option value="Select You Blood Group" selected>----------Select Blood Group----------</option>
                                                        <option value="A+">A+</option>
                                                        <option value="A-">A-</option>
                                                        <option value="B+">B+</option>
                                                        <option value="B-">B-</option>
                                                        <option value="O+">O+</option>
                                                        <option value="O-">O-</option>
                                                        <option value="AB+">AB+</option>
                                                        <option value="AB-">AB-</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <label for="emp_gender">Gender </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_gender">
                                                        <option value="" selected>-----------Select Gender-----------</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                           

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                <label for="emp_address" class="form-label">Address</label>

                                                    <div class="form-floating mb-3 mb-md-0">
                                                     <textarea class="form-control" name="emp_address" rows="10"></textarea> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="emp_bloodgroup">Designation </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_designation">
                                                        <option value="" selected>-----------Select Designation-----------</option>
                                                        
                                                        <?php
                                                            $dest_query = mysqli_query($con,"select * from mst_designation where is_active=true and is_removed=false");
                                                            while($row=mysqli_fetch_array($dest_query)){
                                                                echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="emp_role_id">Role </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                            <select name="emp_role">
                                                                    <option value="" selected>-----------Select Role-----------</option>

                                                                            <?php
                                                                                    $dest_query = mysqli_query($con,"select * from mst_roles where is_active=true and is_removed=false");
                                                                                    while($row=mysqli_fetch_array($dest_query)){
                                                                                        echo '<option value="'.$row['id'].'">'.$row['role_name'].'</option>';
                                                                                    }
                                                                                ?>
                                                            </select>
                                                   
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <h5> Login Details</h5>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" name="emp_username" placeholder="Enter your  Username" />
                                                        <label for="emp_username"> Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" name="emp_password" placeholder="enter your Password" />
                                                        <label for="emp_password">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">                                               
                                                 <div class="d-grid " >
                                                 <input type="submit" id="btn"  class="btn btn-md btn-primary" value="Create Employee Account"  name="register" />
                                                </div>
                                            </div> 
                                        </form>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
        
<?php include('./footer.php'); ?>
