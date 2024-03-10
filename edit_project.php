<?php 
include('middleware.php');
include('./db_connection.php');

$status_arr = array("Yet to Kick Off","Started","Blocked/Pending","Inprogress","On-Hold","Done" );


if(isset($_POST['update_project']))

{
    echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] ;
    $name=$_POST['name'];
    $customer_id = $_POST['customer_id'];
    $employee_id = $_POST['user_ids'];
    $status=$_POST['status'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $cust_id=$_POST['cust_id'];
    
  $query="update mst_projects set ";
                            $query.="name='".$name."',";
                            $query.="customer_id='".$customer_id."',";
                            $query.="user_ids='".$employee_id."',";
                            $query.="status='".$status."',";
                            $query.="start_date='".$start_date."',";
                            $query.="end_date='".$end_date."' where id=".$cust_id;



                            
echo "Update query: " .$query;
      if( mysqli_query($con,$query)){
       
        $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                   Project Updated Sucessfully
                    </div>
                </div>';
                header('location:view_project_list.php');

       }
       else
       {
        $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
            Project  not Updated 
            </div>
        </div>';
        header('location:view_project_list.php');

       }
    
      
}

$cust_view_query= 'select * from mst_projects where id='.$_GET['id'];
$eqry=mysqli_query($con,$cust_view_query);
$data=mysqli_fetch_array($eqry);


include('./header.php'); 
?>

<main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-left font-weight-light ">Edit  Project </h3></div>
                <div class="card-body">
                    <form method="POST" action ="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] ?>" enctype="multipart/form-data">
                    <!-- <form method="POST" action="" enctype="multipart/form-data"> -->
                        <!-- <h5>Project Details</h5> -->
                            <div class="row mb-3">
                                <div class="col-md-112">
                                <h5>Project Title</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" type="text" value="<?php echo $data['name']?>" name="name"/>
                                        <input type="hidden" name="cust_id" value="<?php echo $data['id']; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Customer</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                    <select name="customer_id"  class ="form-control">                                                        
                                        <?php
                                            $dest_query = mysqli_query($con,"select * from mst_customers where is_active=true and is_removed=false");
                                            while($row=mysqli_fetch_array($dest_query)){
                                                if($row['id']===$data['customer_id'])
                                                echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                                                else
                                                echo '<option value="'.$row['id'].'" >'.$row['name'].'</option>';

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
                                        <select name="user_ids"  class ="form-control">                                                        
                                        <?php
                                            $dest_query = mysqli_query($con,"select * from mst_employee where is_active=true and is_removed=false");
                                            while($row=mysqli_fetch_array($dest_query)){
                                                if($row['id']===$data['user_ids'])
                                                echo '<option value="'.$row['id'].'" selected>'.$row['emp_name'].'</option>';
                                                else
                                                echo '<option value="'.$row['id'].'" >'.$row['emp_name'].'</option>';

                                            }
                                        ?>
                                    </select>
                                        </div>
                                </div>
                         
                                <div class="col-md-6">
                                <h5>Status</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                    <select name="status" class ="form-control"> 
                                    <option value="" selected>----------Select Status----------</option>
                                        <?php
                                            foreach($status_arr as $val){
                                            if($data['status']==$val)
                                            echo '<option value="'.$val.'" selected>'.$val.'</option>';
                                            else
                                            echo '<option value="'.$val.'">'.$val.'</option>';
                                            }
                                        ?>                                   
                                    </select>
                                    </div>
                                </div>
                                </div>

                                <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5>Start Date</h5>
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control"  type="date"  value="<?php echo $data['start_date']?>" name="start_date" />
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <h5>End Date</h5>
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control"  type="date"  value="<?php echo $data['start_date']?>" name="end_date"  />
                                        </div>
                                </div>
                            </div>
                       
                             <div class="row mb-5">                                               
                                <div class="d-grid " >
                                <input type="submit" id="btn"  class="btn btn-md btn-primary" value="Update Project"  style="width: 580 px; margin: 0 auto"  name="update_project" />
                            </div>
                         </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
</main>

 <?php include('./footer.php'); ?>