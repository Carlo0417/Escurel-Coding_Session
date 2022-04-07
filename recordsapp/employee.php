<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Record App - Employees</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/assets/css/demo.css" rel="stylesheet" />
</head>

<body>

    <?php
        require('config/config.php');
        require('config/db.php');

        // Define the total number of results you want per page
        $results_per_page = 10;

        // Find the total number of results/rows storedc in the database
        $query = "SELECT * FROM employee";
        $result = mysqli_query($conn, $query);
        $number_of_result = mysqli_num_rows($result);
  
        // Determine the total number of pages availble
        $number_of_page = ceil($number_of_result / $results_per_page);
  
        // Determine which page number visitor is currently on
        if(!isset($_GET['page'])){
            $page = 1;
  
        }else{
            $page = $_GET['page'];
        }
  
        // Determine the sql LIMIT starting number for the results on the display page
        $page_first_result = ($page-1) * $results_per_page;
  

        // Create Query
        $query = 'SELECT employee.id, employee.lastname, employee.firstname, employee.address, office.name
        as office_name FROM employee, office WHERE employee.office_id = office.id LIMIT '. $page_first_result . ',' . $results_per_page;

        // Get the result
        $result = mysqli_query($conn, $query);

        // Fetch the data
        $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Free result
        mysqli_free_result($result);

        // Close the connection
        mysqli_close($conn);

    ?>


    <div class="wrapper">
        <div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    
            <div class="sidebar-wrapper">
                
            <div class="logo">
                <div class="row">
                    <div class="col-md-2">
                    <i class="nc-icon nc-icon nc-app pull-left" style="font-size: 20px; padding: 10px;"></i>
                   
                    </div>
                    <div class="col-md-10">
                    <a href="transaction.php" class="simple-text  pull-left">Record App</a>
                    </div>
                </div>
            </div>
            
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="transaction.php">
                            <i class="nc-icon nc-icon nc-badge"></i>
                            <p>Transactions</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="office.php">
                            <i class="nc-icon nc-alien-33"></i>
                            <p>Office</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="employee.php">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Employee</p>
                        </a>
                    </li>

                    <li class="nav-item active active-pro">
                        <a class="nav-link active" href="javascript:;">
                            <i class="nc-icon nc-spaceship"></i>
                            <p>Upgrade Plan</p>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="main-panel">
            <!-- Navbar -->

            <?php  include('includes/navbar.php') ?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>

                    <div class=row> 
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                           
                            <br/>

                            <div class="col-md-12">
                                    <div class="card-header ">
                                        <h2 class="card-title">Employees</h2>
                                        <p class="card-category">Here is the list of your employees</p>
                                    </div>
                                </div>

                                <br/>

                                <div class="row" style="padding: 15px;">
                                    <div class="col-md-6">
                                        <input id="myInput" onkeyup="myFunction()" placeholder="Search employees here..."
                                        style="padding: 5px; width: 250px; font-size: 15px;" class="pull-left">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="/employee-add.php">
                                            <button type="submit" class="btn btn-warning btn-fill pull-right"> Add New Employee </button>
                                        </a>
                                    </div> 
                                </div>

                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped" id="myTable">
                                        <thead>
                                            <th>Last name</th>
                                            <th>First name</th>
                                            <th>Address</th>
                                            <th>Office</th>
                                            <th>Action</th>
                                        </thead>

                                        <tbody>
                                            
                                            <?php foreach($employees as $employee) : ?>

                                            <tr>
                                                <td> <?php echo $employee['lastname']; ?> </td>
                                                <td> <?php echo $employee['firstname']; ?> </td>
                                                <td> <?php echo $employee['address']; ?> </td>
                                                <td> <?php echo $employee['office_name']; ?> </td>   
                                                <td> 
                                                    <a href="/employee-edit.php?id=<?php echo $employee['id']; ?>"> 
                                                        <button type="submit" class="btn btn-warning btn-fill pull-right">Edit</button>
                                                    </a>
                                                </td>                           
                                            </tr>
                                            
                                            <?php endforeach ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        for($page = 1; $page <= $number_of_page; $page++){
                            echo '<a href="employee.php?page='. $page . '">' . $page . '</a>';
                        }
                    ?>

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright text-center">©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p>
                </div>
            </footer>
        </div>
    </div>
  
</body>

<script>
    function myFunction() 
    {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      th = table.getElementsByTagName("th");
      
      for (i = 1; i < tr.length; i++) 
      {
        tr[i].style.display = "none";    
        for(var j = 0; j < th.length; j++)
        {
          td = tr[i].getElementsByTagName("td")[j];      
          if (td) 
          {
            if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1)                               
            {
                tr[i].style.display = "";
                break;
            }
          }
        }
      }
    }
  </script>

<!--   Core JS Files   -->
<script src="/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="/assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="/assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="/assets/js/demo.js"></script>

</html>
