<?php 
include('middleware.php');
include('./db_connection.php');

$blood_group_arr = array('A+','A-','B+','B-','O+','O-','AB+','AB-');

if(isset($_POST['update']))
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
    $emp_designation_id=$_POST['emp_designation'];
    $emp_role_id=$_POST['emp_role'];
    $is_active=$_POST['is_active'];
    
    if($emp_role_id!=""){
        $emp_is_login_user=true;         
    }
    else {
        $emp_is_login_user=false;
        $emp_role_id='NULL';
    }

    $query="update mst_employee set ";
    $query.="emp_name='".$emp_name."',";
    $query.="emp_last_name='".$emp_last_name."',";
    $query.="emp_gender='".$emp_gender."',";
    $query.="emp_contact_no='".$emp_contact_no."',";
    $query.="emp_emergency_contact_no='".$emp_emergency_contact_no."',";
    $query.="emp_date_of_birth='".$emp_date_of_birth."',";
    $query.="emp_date_of_joining='".$emp_date_of_joining."',";
    $query.="emp_email='".$emp_email."',";
    $query.="emp_address='".$emp_address."',";
    $query.="emp_blood_group='".$emp_blood_group."',";
    $query.="emp_is_login_user='".$emp_is_login_user."',";
    $query.="emp_username='".$emp_username."',";
    $query.="emp_role_id='".$emp_role_id."',";
    $query.="emp_designation_id='".$emp_designation_id."',";
    $query.="is_active=".$is_active;

   
    if($_FILES['emp_profile_pic']['size']>0){

     $file_ext=strtolower(end(explode('.',$_FILES['emp_profile_pic']['name'])));
     $emp_profile_pic= "uploads/employee_photos/".str_replace(" ","",$emp_name).'_'.date('YmdHis').'.'.$file_ext;
     $file_tmp = $_FILES['emp_profile_pic']['tmp_name'];
     move_uploaded_file($file_tmp,$emp_profile_pic);
     $query.=",emp_profile_pic='".$emp_profile_pic."'";
    }
   
   $query.=" where id=".$_POST['emp_db_id'];
  
     
      if( mysqli_query($con,$query)){
       
        $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    Record Updated Sucessfully
                    </div>
                </div>';
                header('location:view_employee_list.php');

       }
       else
       {
        $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Record Not Updated
            </div>
        </div>';
        header('location:view_employee_list.php');

       }
    
      
}


$emp_view_query='select me.*, mr.id role_id, mr.role_name,
md.id designation_id, md.designation_name from mst_employee me
left join mst_roles mr on mr.id = me.emp_role_id
left join mst_designation md on md.id = me.emp_designation_id
where me.id='.$_GET['id'];

$eqry=mysqli_query($con,$emp_view_query);

$data=mysqli_fetch_array($eqry);

include('./header.php');
?>

<main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Employee </h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="edit_employee.php" enctype="multipart/form-data">
                                            <h5>Employee details</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" name="emp_name" value="<?php echo $data['emp_name']; ?>" placeholder="Enter your first name" />
                                                        <label for="emp_name"> Name</label>
                                                        <input type="hidden" name="emp_db_id" value="<?php echo $data['id']; ?>" />

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" name="emp_last_name" value="<?php echo $data['emp_last_name']; ?>" placeholder="Enter your first name" />
                                                        <label for="emp_name"> Last name</label>
                                                        <input type="hidden" name="emp_db_id" value="<?php echo $data['id']; ?>" />

                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="emp_id"  value="<?php echo $data['emp_id']; ?>"placeholder="Enter your last name" />
                                                        <label for="emp_id"> Employee No</label>
                                                    </div>
                                                </div> -->
                                                 
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text"  name="emp_contact_no" value="<?php echo $data['emp_contact_no']; ?>" placeholder="Enter your contact_no" />
                                                        <label for="emp_contact_no"> Contact No</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="emp_emergency_contact_no"  value="<?php echo $data['emp_emergency_contact_no']; ?>" placeholder="Enter your emergency contact_no" />
                                                        <label for="emp_emergency_contact_no"> Emergency Contact No</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="date"  name="emp_date_of_birth"  value="<?php echo $data['emp_date_of_birth']; ?>" placeholder="Enter your Date of Birth"/>
                                                        <label for="emp_date_of_birth"> Date-Of-Birth</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="date" name="emp_date_of_joining" value="<?php echo $data['emp_date_of_joining']; ?>" placeholder="Enter your Date Of Joining" />
                                                        <label for="emp_date_of_joining"> Date-Of-Joining</label>
                                                    </div>
                                                </div>
                                                
                                               
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text"  name="emp_email"  value="<?php echo $data['emp_email']; ?>" placeholder="Enter your email" />
                                                        <label for="emp_email"> Email ID</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                             <div class="form-group">
                                                                    <label for="exampleInputFile">Upload Profile Pic</label>
                                                                    <input class="form-control" type="file" id="emp_profile_pic"  name="emp_profile_pic" value="<?php echo $data['emp_profile_pic']; ?>" />
                                                             </div>

                                                        

                                                  
                                                </div>
                                                 
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="emp_bloodgroup">Blood Group </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_blood_group"  >
                                                        <option value="" selected>----------Select Blood Group----------</option>
                                                        <?php
                                                         foreach($blood_group_arr as $val){
                                                            if($data['emp_blood_group']==$val)
                                                            echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                                            else
                                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                                         }
                                                        ?>
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
                                                        <?php
                                                            if($data['emp_gender']=='male')
                                                            echo '<option value="male" selected >Male</option>';
                                                            else
                                                            echo '<option value="male">Male</option>';

                                                            if($data['emp_gender']=='female')
                                                            echo '<option value="female" selected >Female</option>';
                                                            else
                                                            echo '<option value="female" >Female</option>';
                                                      
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                           

                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                <label for="emp_address"   class="form-label">Address</label>

                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <textarea class="form-control" name="emp_address"  rows="10"><?php echo trim($data['emp_address']); ?></textarea> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label for="emp_bloodgroup">Designation </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_designation" required="required">
                                                        <option value="">-----------Select Designation-----------</option>
                                                        
                                                        <?php
                                                            $dest_query = mysqli_query($con,"select * from mst_designation where is_active=true and is_removed=false");
                                                            while($row=mysqli_fetch_array($dest_query)){
                                                                if($data['designation_id']==$row['id'])
                                                                    echo '<option value="'.$row['id'].'" selected>'.$row['designation_name'].'</option>';
                                                                else
                                                                    echo '<option value="'.$row['id'].'">'.$row['designation_name'].'</option>';

                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <label for="emp_role_id">Role </label>
                                                    <div class="form-floating mb-3 mb-md-0">
                                                    <select name="emp_role" required="required">
                                                    <option value="" selected>-----------Select Role-----------</option>

                                                    <?php
                                                            $dest_query = mysqli_query($con,"select * from mst_roles where is_active=true and is_removed=false");
                                                            while($row=mysqli_fetch_array($dest_query)){
                                                                if($data['role_id']==$row['id'])
                                                                    echo '<option value="'.$row['id'].'" selected>'.$row['role_name'].'</option>';
                                                                else
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
                                                        <input class="form-control" type="text" name="emp_username"  value="<?php echo $data['emp_username']; ?>" placeholder="Enter your  Username" />
                                                        <label for="emp_username"> Username</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="password" name="emp_password" value="<?php echo $data['emp_password']; ?>"  placeholder="enter your Password" />
                                                        <label for="emp_password">Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                
                                                <div class="col-md-2">

                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <h6> Active</h6>

                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                        <?php
                                                            if($data['is_active']){
                                                                echo '<input  type="radio" name="is_active" value="true" checked /> Yes <input  type="radio" name="is_active" value="false"  /> No';
                                                                
                                                            }else{
                                                                echo '<input  type="radio" name="is_active" value="true" /> Yes <input  type="radio" name="is_active" value="false" checked  /> No';

                                                            }

                                                          
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="row mb-3">                                               
                                                 <div class="d-grid " >
                                                 <input type="submit" id="btn" class="btn btn-md btn-primary" value="Update Employee Details"  name="update" />
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
