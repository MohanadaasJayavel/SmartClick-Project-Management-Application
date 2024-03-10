<?php 
include('middleware.php');
include('./db_connection.php');




if(isset($_GET['diagram_id']))
   echo  $query= "select *,(select count(*) from mst_route_card where is_active=true and route_diagram_id=a.id) route_card_count from mst_diagram a where is_active=true and customer_id=".$_GET['diagram_id'];
  
else
    $query= "select * ,(select count(*) from mst_route_card where is_active=true and route_diagram_id=a.id) route_card_count from mst_diagram a where is_active=true";

$eqry=mysqli_query($con,$query);


$query= "select * from mst_projects where is_active=true";
$eqry=mysqli_query($con,$query);

include('./header.php');
?>
<main>
 <div class="container-fluid px-4"><br>

    <!-- <h1 class="mt-4"><i class="fa fa-layer-group"></i>projects</h1> -->
    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Projects</li>
                        </ol>
        <?php
            if($_SESSION['msg']!='')
                echo $_SESSION['msg'];
            $_SESSION['msg']='';
        ?>

     <div class="card mb-4">
            <div class="card-header text-end" >
                <?php 
                if(in_array('can_create_projects', $_SESSION['user_permissions'])) 
                    echo '<a  class="btn btn-primary" href="create_project.php" ><i class="fa fa-plus" ></i> Add</a>';                
                ?>   
                <a  class="btn btn-success" href="download_customers.php" ><i class="fa fa-download" ></i> Download </a>
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
                        <?php
                           
                            while($row=mysqli_fetch_array($eqry)){                                        
                        ?>
                        
                            <tr>
                            <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['start_date']; ?></td>
                                <td><?php echo $row['end_date']; ?></td>    
                                                                       
                                <td><?php  if($row['status'] =='Yet to Kick Off'){
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
                                        ?></td>                                              
                            

                                <td class="text-center">
                                  
										<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					                      Action
					                    </button>
                                        <div class="dropdown-menu" style="">
                                            <?php
                                            echo '<a href="view_project.php?id='. $row['id'].'" class="dropdown-item view_task"> <i class="fas fa-eye"></i> View</a>';
                                            echo '<a  href="edit_project.php?id='. $row['id'].'" class="dropdown-item view_task"><i class="fas fa-edit" ></i> Edit</a>';
                                            echo '<a href="delete_customers.php?id='. $row['id'].'" class="dropdown-item view_task"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>'
                                            ?>
                                        </div>
                                            
                                        <!-- </div> -->
									</td>
                            </tr>
                        
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
    </div>
</div>
</main>
<?php include('./footer.php'); ?>                