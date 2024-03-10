<?php 
include('middleware.php');
include('./db_connection.php');

if(isset($_POST['update']))
{
    $name=$_POST['name'];
    $contact_no=$_POST['contact_no'];
    $email_address=$_POST['email_address'];
    $web_link=$_POST['web_link'];
    $address=$_POST['address'];
    $contact_name=$_POST['contact_name'];
    $contact_ph_no=$_POST['contact_ph_no'];
    $cont_email=$_POST['cont_email'];
    $cust_id=$_POST['cust_db_id'];
    
  

  $query="update mst_customers set  ";
                            $query.="name='".$name."',";
                            $query.="contact_no='".$contact_no."',";
                            $query.="email_address='".$email_address."',";
                            $query.="web_link='".$web_link."',";
                            $query.="address='".$address."',";
                            $query.="contact_name='".$contact_name."',";
                            $query.="contact_ph_no='".$contact_ph_no."',";
                            $query.="cont_email='".$cont_email."' where id=".$cust_id;
                            

     
      if( mysqli_query($con,$query)){
       
        $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                    Record Updated Sucessfully
                    </div>
                </div>';
                header('location:view_customer_list.php');

       }
       else
       {
        $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Record Not Updated
            </div>
        </div>';
        header('location:view_customer_list.php');

       }
    
      
}

$cust_view_query= 'select * from mst_customers where id='.$_GET['id'];
$eqry=mysqli_query($con,$cust_view_query);
$data=mysqli_fetch_array($eqry);


include('./header.php'); 
?>


                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Customer</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="edit_customers.php" enctype="multipart/form-data">
                                            <h5>Company details</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="name"  value="<?php echo $data['name']; ?>" placeholder="Enter your first name" />
                                                        <label for="inputFirstName"> Name</label>
                                                        <input type="hidden" name="cust_db_id" value="<?php echo $data['id']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="contact_no" value="<?php echo $data['contact_no']; ?>" placeholder="Enter your last name" />
                                                        <label for="inputLastName"> Contact no</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="email_address"  value="<?php echo $data['email_address']; ?>" placeholder="Enter your first name" />
                                                        <label for="inputFirstName"> Email ID</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="web_link" value="<?php echo $data['web_link']; ?>" placeholder="Enter your last name" />
                                                        <label for="inputLastName"> Web Link</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-floating mb-3">
                                                <input class="form-control"  type="text" name="address"  value="<?php echo $data['address']; ?>" placeholder="enter Address 1" />
                                                <label for="inputEmail"> Address</label>
                                            </div>
                                            <div class="row mb-3">
                                                <h5>Contact Person Details</h5>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  type="text" name="contact_name" value="<?php echo $data['contact_name']; ?>"  placeholder="Enter your  name" />
                                                        <label for="inputFirstName"> Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="tel"  name="contact_ph_no" value="<?php echo $data['contact_ph_no']; ?>" placeholder="Enter your last name" />
                                                        <label for="phone">Contact no </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">

                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control"  type="text" name="cont_email" value="<?php echo $data['cont_email']; ?>"  placeholder="Enter your email " />
                                                        <label for="inputLastName">Email ID</label>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div class="mt-4 mb-0">
                                                              <!-- <button type="button" class="btn btn-primary" align-end>Primary</button>-->
                                                 <div class="d-grid " >
                                                 <input type="submit" id="btn"  class="btn btn-md btn-primary" value="Update Customer Details"  name="update"/>
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


