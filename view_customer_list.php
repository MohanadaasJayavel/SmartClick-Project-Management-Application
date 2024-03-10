<?php 
include('middleware.php');
include('./db_connection.php');

// $query= "select * from mst_customers where is_active=true";
$query= "select *,(select count(*) from mst_projects where is_active =true and customer_id = a.id) project_count from mst_customers a where is_active =true";
$eqry=mysqli_query($con,$query);

include('./header.php');
?>
<main>
                    <div class="container-fluid px-4"><br>
                        <!-- <h1 class="mt-4"><i class="fas fa-users"></i>Customers</h1> -->
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Customers</li>
                        </ol>

                        <?php

                            if($_SESSION['msg']!='')
                                echo $_SESSION['msg'];
                            $_SESSION['msg']='';

                            ?>

                       
                       
                        <div class="card mb-4">
                            <div class="card-header text-end" >
                            <?php 
                            if(in_array('can_create_customer', $_SESSION['user_permissions'])) 
                               echo '<a  class="btn btn-primary" href="create_customer.php" ><i class="fa fa-plus" ></i> Add</a>';
                            ?>   
                             <a  class="btn btn-success" href="download_customers.php" ><i class="fa fa-download" ></i> Download </a>
                            </div>
            
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                           <th>Sno.</th>
                                            <th>Company Name</th>
                                            <th>Projects</th>
                                            <th>Contact No</th>
                                            <th>Office - Email ID</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                    <th>Sno.</th>
                                            <th>Company Name</th>
                                            <th>Projects</th>
                                            <th>Contact No</th>
                                            <th>Office - Email ID</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $sno=1;
                                        while($row=mysqli_fetch_array($eqry)){
                                    ?>
                                    
                                        <tr>
                                        <td><?php echo $sno++; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                          <td><?php echo $row['project_count'] ;?></td>
                                            <td><?php echo $row['contact_no']; ?></td>
                                            <td><?php echo $row['email_address']; ?></td>                                            
                                            <td><?php 
                                                if ($row['is_active']==true)
                                                {
                                                    echo 'Yes';
                                                } 
                                                else 
                                                {
                                                   echo 'No';
                                                }
                                                ?></td>
                                             <td>
                                                   
                                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                Action
                                              </button>
                                              <div class="dropdown-menu" style="">
                                              
                                                                                              
                                               <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                               <i class="fas fa-eye" ></i> View
                                               </button>
                                                -->
                                               <?php
                                                echo '<a  class="dropdown-item view_task" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-eye"></i> View</a>';
                                                echo '<a href="edit_customers.php?id='. $row['id'].'" class="dropdown-item "><i class="fas fa-edit" ></i> Edit</a>';
                                               echo '<a href="delete_customers.php?id='. $row['id'].'" class="dropdown-item "><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>'
                                              ?>
                                              </div>    <!-- Modal -->
                                               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                 <div class="modal-dialog" role="document">
                                                   <div class="modal-content">
                                                     <div class="modal-header">
                                                       <h5 class="modal-title" id="exampleModalLabel"> View Customer</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                       </button>
                                                     </div>
                                                     <div class="modal-body">
                                                     <div class="card mt-3">
                                                            <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h3 text-align="center">Organization Details</h3>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Organization Name </h6>
                                                                <span class="text-secondary"><?php echo $row['name']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Contact No</h6>
                                                                <span class="text-secondary"><?php echo $row['contact_no']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Email</h6>
                                                                <span class="text-secondary"><?php echo $row['email_address']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Website Link</h6>
                                                                <span class="text-secondary"><?php echo $row['web_link']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Address</h6>
                                                                <span class="text-secondary"><?php echo $row['address']; ?></span>
                                                            </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card mt-3">
                                                            <ul class="list-group list-group-flush">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h3 text-align="center">Contact Person Details</h3>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0"> Name </h6>
                                                                <span class="text-secondary"><?php echo $row['contact_name']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Contact No</h6>
                                                                <span class="text-secondary"><?php echo $row['contact_ph_no']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Email</h6>
                                                                <span class="text-secondary"><?php echo $row['cont_email']; ?></span>
                                                            </li>
                                                            <!-- <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Website Link</h6>
                                                                <span class="text-secondary"><?php echo $row['comp_web_link']; ?></span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                                <h6 class="mb-0">Address</h6>
                                                                <span class="text-secondary"><?php echo $row['comp_address_1']; ?></span>
                                                            </li> -->
                                                            </ul>
                                                        </div>
                                                     </div>
                                                     
                                                   </div>
                                                 </div>
                                               </div>
                                                                                            
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