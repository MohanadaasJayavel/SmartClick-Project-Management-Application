<?php 

include('middleware.php');
include('./db_connection.php');

$query= "select a.*, b.status as project_status , b.name as ProjectName, b.start_date as ProjectStartDate ,b.end_date as ProjectEndDate  from mst_tasks a inner join mst_projects b on b.id = a.project_id where a.is_active= true";
$eqry=mysqli_query($con,$query);


include('./header.php'); 
?>

<main>
 <div class="container-fluid px-4"><br>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tasks</li>
    </ol>
    
                <div class="card mb-4">
                 <div class="card-body">
                    <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Task</th>
                            <th>Project Started</th>
                            <th>Project Due date</th>
                            <th>Project Status</th>
                            <th>Task Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            while($row=mysqli_fetch_array($eqry)){                                        
                        ?>
                            <tr>
                            <td style="width:10%;"> TM - <?php echo $row['id']; ?></td>
                                <td style="width:15%;color:red"><?php echo $row['ProjectName']; ?></td>
                                <td style="width:20%"><?php echo $row['name']; ?></td>
                                <td style=""><?php echo $row['ProjectStartDate']; ?></td>    
                                <td style=""><?php echo $row['ProjectEndDate']; ?></td>         
                                <td style="">
                                    <?php  if($row['project_status'] =='Yet to Kick Off'){
                                                    echo "<span class='badge badge-secondary'>{$row['project_status']}</span>";
                                                }elseif($row['project_status'] =='Started'){
                                                    echo "<span class='badge badge-primary'>{$row['project_status']}</span>";
                                                }
                                                 elseif($row['project_status'] =='Blocked/Pending'){
                                                    echo "<span class='badge badge-danger'>{$row['project_status']}</span>";
                                                }
                                                 elseif($row['project_status'] =='Inprogress'){
                                                    echo "<span class='badge badge-info'>{$row['project_status']}</span>";
                                                }
                                                 elseif($row['project_status'] =='Done'){
                                                    echo "<span class='badge badge-success'>{$row['project_status']}</span>";
                                                }
                                                 elseif($row['project_status'] =='On-Hold'){
                                                    echo "<span class='badge badge-warning'>{$row['project_status']}</span>";
                                                }
                                    ?>
                                </td> 
                                <td style="">
                                    <?php
                                        if($row['status'] =='To Do'){
                                            echo "<span class='badge badge-secondary'>{$row['status']}</span>";
                                        }elseif($row['status'] =='Blocked'){
                                            echo "<span class='badge badge-danger'>{$row['status']}</span>";
                                        }
                                        elseif($row['status'] =='Code Review'){
                                            echo "<span class='badge badge-info'>{$row['status']}</span>";
                                        } elseif($row['status'] =='QA Testing'){
                                            echo "<span class='badge badge-warning'>{$row['status']}</span>";
                                        }
                                        elseif($row['status'] =='Release Ready'){
                                            echo "<span class='badge badge-primary'>{$row['status']}</span>";
                                        }
                                        elseif($row['status'] =='Reopened'){
                                            echo "<span class='badge badge-warning'>{$row['status']}</span>";
                                        }
                                        elseif($row['status'] =='Done'){
                                            echo "<span class='badge badge-success'>{$row['status']}</span>";
                                        }
                                    ?>
                                </td>                                             
                            </tr>
                        
                            <?php } ?>
                        </tbody>
                   
                    
                    </table>
                </div>
    </div>
</div>
</main>