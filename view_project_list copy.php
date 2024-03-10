<?php 
include('middleware.php');
include('./db_connection.php');


$query= "select * from mst_projects where is_active=true";

$eqry=mysqli_query($con,$query);



include('./header.php');
?>

<main>
<div class="container-fluid px-4">
<h1 class="mt-4"><i class="fas fa-users"></i>projects</h1>
<?php
if($_SESSION['msg']!='')
    echo $_SESSION['msg'];
$_SESSION['msg']='';
?>

<div class="card mb-4">
    <div class="card-header text-end" >
          <a  class="btn btn-primary" href="create_project.php" ><i class="fa fa-plus" ></i> Add</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
        <thead>
            <tr>
                <th>#</th>
                <th>Project</th>
                <th>Date Started</th>
                <th>Due date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
                <th>#</th>
                <th>Project</th>
                <th>Date Started</th>
                <th>Due date</th>
                <th>Status</th>
                <th>Action</th>
        </tr>
        </tfoot>
        <tbody>
       
        </tbody>
         </table>
    </div>

</div>
</div>
</main>
<?php include('./footer.php'); ?>                