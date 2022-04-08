<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Record App - Editing Transaction</title>
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

        // Get value sent over
        $id = $_GET['id'];

        // Create Query
        $query = "SELECT * FROM transaction WHERE id=" . $id;

        // Get result of query
        $result = mysqli_query($conn, $query);

        if(count(array($result)) == 1){
            // Fetch Data
            $transaction = mysqli_fetch_array($result);
            $datelog = $transaction['datelog'];
            $documentcode = $transaction['documentcode'];
            $action = $transaction['action'];
            $employee_id = $transaction['employee_id'];
            $office_id = $transaction['office_id'];
            $remarks = $transaction['remarks'];
        }

        // Free result
        mysqli_free_result($result);

        // Close connection
        mysqli_close($conn);
    ?>

    <div class="wrapper">
        <div class="sidebar" data-image="/assets/img/sidebar-1.jpg"  data-color="azure">
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
                    <li>
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

            
    <?php
        require('config/config.php');
        require('config/db.php');

        // Check if submitted
        if(isset($_POST['submit'])){

            // Get form data
            $datelog = mysqli_real_escape_string($conn, $_POST['datelog']);
            $documentcode = mysqli_real_escape_string($conn, $_POST['documentcode']);
            $action = mysqli_real_escape_string($conn, $_POST['action']); 
            $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
            $employee_id = mysqli_real_escape_string($conn, $_POST['employee_id']);
            $office_id = mysqli_real_escape_string($conn, $_POST['office_id']);

            // Create Update Query
            $query = "UPDATE transaction SET datelog='$datelog', documentcode='$documentcode', action='$action', 
            remarks='$remarks', employee_id='$employee_id', office_id='$office_id' WHERE id=" . $id;

            // Execute Query
            if(mysqli_query($conn, $query)){
                 
            }else{
                echo 'ERROR: ' . mysqli_error($conn);
            }
        }
    ?>

            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Transaction</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action=" <?php $_SERVER['PHP_SELF']; ?> ">
                                       
                                        <div class="row">

                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Datelog</label>
                                                    <input type="text" class="form-control" name="datelog" value=" <?php echo $datelog; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Document Code</label>
                                                    <input type="text" class="form-control" name="documentcode" placeholder="Type here..."
                                                    value=" <?php echo $documentcode; ?> ">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 px-1">
                                                <div class="form-group">
                                                    <label>Action</label>
                                                    <select class="form-control" name="action">
                                                        <option value="IN" <?php if($action=="IN") 
                                                        echo 'selected="selected"'; ?> >IN</option>

                                                        <option value="OUT" <?php if($action=="OUT") 
                                                        echo 'selected="selected"'; ?>>OUT</option>

                                                        <option value="COMPLETE" <?php if($action=="COMPLETE") 
                                                        echo 'selected="selected"'; ?> >COMPLETE</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <input type="text" class="form-control" name="remarks" placeholder="Type here..."
                                                    value=" <?php echo $remarks; ?> ">
                                                </div>
                                            </div>
                                            
                                        </div>
                                       
                                        <div class="row">
                                           
                                        <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label> Employee </label>
                                                    <select class="form-control" name="employee_id">
                                                        <option value="" disabled selected hidden>Select....</option>
                                                        <?php 
                                                            $query = "SELECT id, CONCAT(lastname,', ',firstname) as Employee FROM recordsapp_db.employee";
                                                            $result = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_array($result)){
                                                                if($row['id'] == $employee_id){

                                                                    echo "<option value=" . $row['id'] . " selected>" . $row['Employee'] . '</option>';
                                                           
                                                                }else{
                                                                    echo "<option value=" . $row['id'] . ">" . $row['Employee'] . '</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label> Office </label>
                                                    <select class="form-control" name='office_id'>
                                                        <option>Select....</option>
                                                        <?php 
                                                            $query = "SELECT id, name FROM recordsapp_db.office";
                                                            $result = mysqli_query($conn, $query);
                                                           
                                                            while ($row = mysqli_fetch_array($result)){
                                                                
                                                                if($row['id'] == $office_id){
                                                                   
                                                                    echo "<option value=" . $row['id'] . " selected>" . $row['name'] . '</option>';

                                                                }else{

                                                                    echo "<option value=" . $row['id'] . ">" . $row['name'] . '</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
    
                                        <button type="submit" name="submit" value="Submit" class="btn btn-info btn-fill pull-right">Update</button>
                                        <div class="clearfix"></div>  <br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
