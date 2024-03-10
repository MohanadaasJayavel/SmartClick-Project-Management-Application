<?php 

include('middleware.php');
include('./db_connection.php');

$query="select count(id) total_emp_count,
(select count(id) from mst_projects where is_active = true ) total_project_count,
(select count(id) from mst_customers where is_active = true ) total_customers_count,
(select count(id) from mst_tasks where is_active = true ) total_tasks_count from mst_employee where is_active = true";
$eqry=mysqli_query($con,$query);
$data=mysqli_fetch_array($eqry);


//$yearwise_routecard_query = "select group_concat(res.month_name) month_name, group_concat(total_count) total_count from ( select concat('\"',date_format(created_at,\"%M\"),'\"') month_name, count(created_at) total_count from mst_route_card where is_active=true and date_format(created_at,'%Y')= date_format(now(),'%Y')  group by  date_format(created_at,'%M') order by date_format(created_at,'%m') asc ) res";
$yearwise_routecard_query = "select group_concat(res.month_name) month_name, group_concat(total_count) total_count from ( select concat('\"',date_format(created_at,\"%M\"),'\"') month_name, count(created_at) total_count from mst_projects where is_active=true and date_format(created_at,'%Y')= date_format(now(),'%Y')  group by  date_format(created_at,'%M') order by date_format(created_at,'%m') asc ) res";

$yearwise_routecard_query=mysqli_query($con,$yearwise_routecard_query);
$yearwise_routecard_data=mysqli_fetch_array($yearwise_routecard_query);

$monthwise_routecard_query = "select group_concat(res.month_name) month_name, group_concat(total_count) total_count from (
    select concat('\"',date_format(created_at,'%M %d'),'\"') month_name, count(created_at) total_count 
    from mst_projects where is_active=true and date_format(created_at,'%Y%m')='202106'
    -- date_format(now(),'%Y%m') 
     group by  date_format(created_at,'%M%d') 
    order by date_format(created_at,'%d') asc
    ) res ";

$monthwise_routecard_query=mysqli_query($con,$monthwise_routecard_query);
$monthwise_routecard_data=mysqli_fetch_array($monthwise_routecard_query);
include('./header.php'); 
?>
<div class="container-fluid">
   
  <hr>
    <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <b>Project Progress</b>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0 table-hover">
                                <colgroup>
                                <col width="5%">
                                <col width="30%">
                                <col width="35%">
                                <col width="15%">
                                <col width="15%">
                                </colgroup>
                                <thead>
                                <th>#</th>
                                <th>Project</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th></th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 1;
                                        $stat = array("Yet to Kick Off","Started","Blocked/Pending","Inprogress","Done,On-Hold");
                                        $where = "";
                                        $qry = $con->query("SELECT * FROM mst_projects $where ORDER BY name ASC");
                                        while($row = $qry->fetch_assoc()):
                                        
                                            $tprog = $con->query("SELECT COUNT(*) FROM mst_tasks WHERE project_id = {$row['id']}")->fetch_row()[0];
                                            $cprog = $con->query("SELECT COUNT(*) FROM mst_tasks WHERE project_id = {$row['id']} AND status <> 'To Do'")->fetch_row()[0];
                                            $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                                            $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $i++ ?>
                                        </td>
                                        <td>
                                            <a>
                                                <?php echo ucwords($row['name']) ?>
                                            </a>
                                            <br>
                                            <small>
                                                Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                                            </small>
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                                                </div>
                                            </div>
                                            <small>
                                                <?php echo $prog ?>% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">
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
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm" href="./view_project.php?id=<?php echo $row['id'] ?>">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>  
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-md-3">
                    <!-- <div class="col-xl-3 col-md-6"> -->
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                                <h4 style="padding-left:24%">Total Projects </h4>
                                 <div style="padding-left:44%"><i class="fa fa-layer-group"></i></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php
                                $totalProjectsQuery = "SELECT COUNT(*) AS total_projects FROM mst_projects WHERE is_active = true";
                                $totalProjectsResult = $con->query($totalProjectsQuery);
                                $totalProjects = $totalProjectsResult->fetch_assoc()['total_projects'];
                            ?>
                            <h3 style="padding-left:44%"><a href="view_project_list.php" style="text-decoration:none;color:white"><?php echo $totalProjects; ?></a></h3>
                            </div>
                        </div>

                    <!-- </div> -->
                </div>
                <div class="col-md-3">
                    <!-- <div class="col-xl-3 col-md-6"> -->
                        <div class="card bg-secondary text-white mb-4">
                            <div class="card-body">
                                <h4 style="padding-left:24%">Total Tasks </h4>
                                 <div style="padding-left:44%"><i class="fa fa-layer-group"></i></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <?php
                            // Query to get the total number of tasks
                        $totalTasksQuery = "SELECT COUNT(*) AS total_tasks FROM mst_tasks where is_active=true";
                        $totalTasksResult = $con->query($totalTasksQuery);
                        $totalTasks = $totalTasksResult->fetch_assoc()['total_tasks'];
                    ?>
                    <h3 style="padding-left:44%"><a href="view_project_list.php" style="text-decoration:none;color:white"><?php echo $totalTasks; ?></h3>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
                
    </div>
 </div>


 <!-- <main> -->
                    <div class="container-fluid px-4"><br>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header" style="color:black">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Project - Area Chart 
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header" style="color:black">
                                        <i class="fas fa-chart-bar me-1"></i>
                                       Project- Production
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </main> -->
<?php include('./footer.php'); ?>    

<script type="text/javascript">
//Bar chart
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';
// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php echo $yearwise_routecard_data['month_name']; ?>],
    datasets: [{
      label: "Production count of Projects",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [<?php echo $yearwise_routecard_data['total_count']; ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 50,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});


//Area chart

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php echo $monthwise_routecard_data['month_name']; ?>],
    datasets: [{
      label: "Route Card Production",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [<?php echo $monthwise_routecard_data['total_count']; ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 50,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});


</script>