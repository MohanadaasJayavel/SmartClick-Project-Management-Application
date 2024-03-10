<!DOCTYPE html>
<?php
session_start();
include "db_connection.php";
if(isset($_POST['login']))
{ 	
	$username=$_POST['uname'];
	$password=$_POST['password'];
	$qry="select me.id, me.emp_name, me.emp_gender, 
    me.emp_date_of_birth, me.emp_date_of_joining, me.emp_blood_group, 
    me.emp_contact_no, me.emp_emergency_contact_no, me.emp_address, 
    me.emp_profile_pic, me.emp_role_id, me.emp_designation_id, 
    me.emp_username, me.emp_password, me.emp_is_login_user, 
    me.created_at, me.updated_at , me.is_active, me.is_removed,
    group_concat(mp.permission_name) user_permission from mst_employee me
    inner join mst_roles mr on mr.id=me.emp_role_id
    inner join trn_roles_permissions trp on trp.role_id = mr.id
    inner join mst_permissions mp on mp.id = trp.permission_id
    where me.emp_username='$username' and me.emp_password='$password'
    and me.is_active=true and me.is_removed=false and me.emp_is_login_user=true
    and mp.is_active=true
    group by me.id, me.emp_name, me.emp_gender, 
    me.emp_date_of_birth, me.emp_date_of_joining, me.emp_blood_group, 
    me.emp_contact_no, me.emp_emergency_contact_no, me.emp_address, 
    me.emp_profile_pic, me.emp_role_id, me.emp_designation_id, 
    me.emp_username, me.emp_password, me.emp_is_login_user, 
    me.created_at, me.updated_at , me.is_active, me.is_removed";

	$eqry=mysqli_query($con,$qry);
	$uqry=mysqli_fetch_array($eqry);
	
	$num=mysqli_num_rows($eqry);
	
	
	if($num>0)
	{
		$_SESSION['username']=$uqry['emp_username'];
        $_SESSION['user_permissions']=explode(',',$uqry['user_permission']);
        $_SESSION['msg'] = '';
		header("location:manage_task.php");		
		
	}
	else{
        $_SESSION['auth_err'] = 'Invalid username and/or Password!';

	} 
	
} 

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Konnectify </title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="assets/img/konnectify_logo.png">
    </head>
    <body >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                    <br>                 

                        <div class="row justify-content-center"> 
                               
                            <div class="col-lg-5">
                           
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                               
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">
                                        <img src="assets/img/konnectify_name.png" width="200px" height="50px"> 
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="text-center text-warning"><h4>
                                                <?php 
                                                    if(isset($_SESSION['auth_err'])) 
                                                        echo $_SESSION['auth_err'];
                                                        $_SESSION['auth_err']='';
                                                      
                                                 ?>
                                             </h4></div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" placeholder="admin"  name = "uname" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password"   name  = "password"/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                           <!-- <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                 <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div> -->
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="#">Forgot Password?</a> -->
                                                <!-- <a class="btn btn-primary" href="login.php">Login</a> -->
                                              <button type="submit" name="login" class="btn btn-primary"  style="width: 180 px; margin: 0 auto">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="#">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4 text-center">
                    Copyright &copy; Konnectify.co 2023
                        
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
