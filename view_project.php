<?php 

include('middleware.php');
include('./db_connection.php');

$project_view_query = 'select * from mst_projects where id='.$_GET['id'];
$eqry=mysqli_query($con,$project_view_query);
$row=mysqli_fetch_array($eqry);

$emp_query = 'select a.*,b.name from mst_employee a inner join mst_projects b on b.id = a.id where a.id ='.$_GET['id'];
$res_query=mysqli_query($con,$emp_query);
$mrow=mysqli_fetch_array($res_query);

$customer_query = 'select a.*,b.name from mst_projects a inner join mst_customers b on b.id  = a.customer_id where a.id ='.$_GET['id'];
$res_query=mysqli_query($con,$customer_query);
$nrow=mysqli_fetch_array($res_query);


$task_query = 'select  a.* , b.emp_name from mst_tasks a  inner join mst_employee b on  b.id  = a.employee_id where a.project_id  = '.$row['id'];
$task_res_query=mysqli_query($con,$task_query);
// $trow=mysqli_fetch_array($task_res_query);


$emp_query= "select *  from mst_employee where is_active=true";
$emp_q1=mysqli_query($con,$emp_query);



if(isset($_POST['Add_task']))
{
echo "Inside isset";
    $task_name=$_POST['task_name'];
    $task_description=$_POST['task_description'];
    $employee_id = $_POST['employee'];
    $status = $_POST['status'];

	  $query="insert into mst_tasks(id,project_id,employee_id,name,description,status,is_active,is_removed)
       values('','$row[id]','$employee_id','$task_name','$task_description','$status',true,false)";
    // alert($query);
    // echo '<script>alert($query)</script>';

    echo '<script type ="text/JavaScript">';  
echo 'alert('.$query.')';  
echo '</script>';

        // if( mysqli_query($con,$query)){
        if( $con->query($query) === TRUE){
        $last_id = $con->insert_id;
       
            $_SESSION['msg'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                        Task Added Sucessfully for project :<b>'. $row['name'].'</b>
                        </div>
                    </div>';
                    header('location:view_project_list.php');
                    // echo $query;
    
           }
           else
           {

            $_SESSION['msg'] = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                Task Not Added
                </div>
            </div>';
            header('location:view_project_list.php');
    
           }
}

include('./header.php'); 
?>

<div class="container">
    <div class="main-body">
        
        <div class="row gutters-sm mt-3">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Project Name</b></dt>
                                    <dd><?php echo $row['name'] ?></dd>
                                    <dt><b class="border-bottom border-primary">customer Name</b></dt>
                                    <dd><?php echo $nrow['name'] ?></dd>
                                    <dt><b class="border-bottom border-primary">Description</b></dt>
                                    <dd><?php echo $row['description'] ?></dd>
                                    <dt><b class="border-bottom border-primary">Project Owner:</b></dt>
                                    <dd><?php echo  $mrow['emp_name']  ?></dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt><b class="border-bottom border-primary">Start Date</b></dt>
                                    <dd><?php echo $row['start_date'] ?></dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">End Date</b></dt>
                                    <dd><?php echo $row['end_date'] ?></dd>
                                </dl>
                                <dl>
                                    <dt><b class="border-bottom border-primary">Status</b></dt>
                                    <dd>
                                      
                                        <?php
                                        if($row['status'] =='Yet to Kick Off'){
                                                    echo "<span class='badge badge-secondary'>{$row['status']}</span>";
                                                }elseif($row['status'] =='Started'){
                                                    echo "<span class='badge badge-primary'>{$row['status']}</span>";
                                                }
                                                 elseif($row['status'] =='Blocked/Pending'){
                                                    echo "<span class='badge badge-danger'>{$row['status']}</span>";
                                                }
                                                 elseif($row['status'] =='Inprogress'){
                                                    echo "<span class='badge badge-info'>{$row['status']}</span>";
                                                }
                                                 elseif($row['status'] =='Done'){
                                                    echo "<span class='badge badge-success'>{$row['status']}</span>";
                                                }
                                                 elseif($row['status'] =='On-Hold'){
                                                    echo "<span class='badge badge-warning'>{$row['status']}</span>";
                                                }
                                        ?>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="card mt-3" style="border:none">
                    <div class="row">
                  
                        <div class="col-md-14">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <span><b>Task List:</b></span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left:72%">
                                        Add New Task
                                        </button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="width:700px;margin:auto">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">New task</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" >
                                                                <div class="card-body">
                                                                    <form method="POST" action ="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $_GET['id'] ?>" id="insert_form">
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <h5>Task</h5>
                                                                                <div class="form-floating mb-3 mb-md-0">
                                                                                    <input class="form-control" type="text" name="task_name" required/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                            <div class="col-md-12">
                                                                                <h5>Description</h5>
                                                                                <div class="form-floating mb-3 mb-md-0">
                                                                                    <textarea class="form-control" id ="summernote" type="text" name="task_description" required/></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <h5>Engineers</h5>
                                                                                <div class="form-floating mb-3 mb-md-0">
                                                                                    <select name="employee" class="form-control" required>
                                                                                    <option required>---------Select Engineers---------</option>
                                                                                    <?php
                                                                                    while($emp_row=mysqli_fetch_array($emp_q1)){
                                                                                    echo '<option value="'.$emp_row['id'].'">'.$emp_row['emp_name'].'</option>';
                                                                                    }
                                                                            ?>
                                                                            </select>
                                                                                </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h5>Status</h5>
                                                                                <div class="form-floating mb-3 mb-md-0">
                                                                                    <select name="status" class="form-control" required>
                                                                                        <option required>---------Select status---------</option>
                                                                                        <option value="To Do">To Do</option>
                                                                                        <option value="Blocked">Blocked</option>
                                                                                        <option value="Code Review">Code Review</option>
                                                                                        <option value="QA Testing">QA Testing</option>
                                                                                        <option value="Release Ready">Release Ready</option>
                                                                                        <option value="Reopened">Reopened</option>
                                                                                        <option value="Done">Done</option>
                                                                                    </select>
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                         <!-- <div class="modal-footer"> -->
                                                                                <input type="submit" class="btn btn-primary" name="Add_task" id ="Add_task" value="Create Task" />
                                                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>                                                    
                                                                        <!-- </div> -->
                                                                    </form>
                                                                </div>
                                                </div>
                                                <!-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                                                    
                                                </div> -->
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                    <table class="table table-condensed m-0 table-hover">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="20%">
                                            <col width="40%">
                                            <col width="15%">
                                            <col width="15%">
                                            <col width="25%">
                                        </colgroup>
                                        <thead>
                                            <th>#</th>
                                            <th>Task</th>
                                            <th>Description</th>
                                            <th>Assignee</th>
                                            <th>Status</th>
                                        </thead>
                                        
                                        <tbody class="tbody">
                                        <?php
                                    $sno=1;
                                    while($trow=mysqli_fetch_array($task_res_query)){
                                ?>
                                
                                            <tr>
                                            <td><?php echo $sno++; ?></td>
                                            <td><?php echo $trow['name']?> </td>
                                            <td><?php echo $trow['description']?> </td>
                                            <td><?php echo $trow['emp_name']?> </td>
                                            <td>
                                            <?php
                                                if($trow['status'] =='To Do'){
                                                    echo "<span class='badge badge-secondary'>{$trow['status']}</span>";
                                                }elseif($trow['status'] =='Blocked'){
                                                    echo "<span class='badge badge-danger'>{$trow['status']}</span>";
                                                }
                                                elseif($trow['status'] =='Code Review'){
                                                    echo "<span class='badge badge-info'>{$trow['status']}</span>";
                                                } elseif($trow['status'] =='QA Testing'){
                                                    echo "<span class='badge badge-warning'>{$trow['status']}</span>";
                                                }
                                                elseif($trow['status'] =='Release Ready'){
                                                    echo "<span class='badge badge-primary'>{$trow['status']}</span>";
                                                }
                                                elseif($trow['status'] =='Reopened'){
                                                    echo "<span class='badge badge-warning'>{$trow['status']}</span>";
                                                }
                                                elseif($trow['status'] =='Done'){
                                                    echo "<span class='badge badge-success'>{$trow['status']}</span>";
                                                }
                                            ?>
                                            </td>
                                            
                                        </tbody>
                                        <?php } ?>
                                    </table>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                                                                                         
            </div>
        </div>
                                            </div>
    </div>
</div>        
 
<?php include('./footer.php'); ?>
