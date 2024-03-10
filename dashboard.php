<?php 
include('middleware.php');
include('./db_connection.php');
include('./header.php'); 

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


?>
<main>
                    <div class="container-fluid px-4"><br>
                        <!-- <h1 class="mt-4">Dashboard</h1> -->
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body"><i class="fa fa-id-badge"></i><h4>Employee  <?php echo $data['total_emp_count']; ?></h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="view_employee_list.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                             

                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body"><h4><i class="fas fa-users"></i><br>Projects <?php echo $data['total_project_count']; ?> </h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="customers.php"> View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body"><h4><i class="fas fa-users"></i><br>Customers <?php echo $data['total_customers_count']; ?> </h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="customers.php"> View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><i class="fas fa-project-diagram" ></i><h4>Diagrams <?php echo $data['diagram_count']; ?> </h4></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="diagrams.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fas fa-clipboard-list"></i><h4>Route Card <?php echo $data['route_card_count']; ?></h4> </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="route_card_list.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Project - Area Chart 
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                       Progress
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
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
      label: "Production",
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