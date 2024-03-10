<?php
include('middleware.php');
include('./db_connection.php');

$query="update mst_employee set is_active=false,is_removed=true where id=".$_GET['id'];



if( mysqli_query($con,$query)){
       
    $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                Record deleted Sucessfully
                </div>
            </div>';
            header('location:view_employee_list.php');

   }
   else
   {
    $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
        Record Not deleted
        </div>
    </div>';
    header('location:view_employee_list.php');

   }

  


?>