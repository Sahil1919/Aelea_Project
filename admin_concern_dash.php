
<?php 

// $connection = mysqli_connect("localhost","root","","task_management");
if ($_SESSION['User_type'] =='management' || $_SESSION['User_type'] =='admin'){
    $retailer_account = "SELECT task_id FROM assign_concern";
    $Total_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_task = mysqli_num_rows($result);
    }
    $retailer_account = "SELECT task_id FROM assign_concern where status='Open'";
    $open_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $open_task = mysqli_num_rows($result);
    }
    $retailer_account = "SELECT task_id FROM assign_concern where status='WIP'";
    $WIP_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $WIP_task = mysqli_num_rows($result);
    }
    $retailer_account = "SELECT task_id FROM assign_concern where status='Close'";
    $close_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $close_task = mysqli_num_rows($result);
    }
    $retailer_account = "SELECT task_id FROM assign_concern where status='Cancel'";
    $cancel_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $cancel_task = mysqli_num_rows($result);
    }
}
else{
    $sess_report_id = $_SESSION['user'];
    // ________________________________________________
    $Total_emp_task=0;
    $qry = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.emp_id='$sess_report_id' or assign_concern.userid = '$sess_report_id' ";
    if ($result = mysqli_query($connection, $qry)) {
        $Total_task = mysqli_num_rows($result);
    }
  
    // ________________________________________________
    
    $Total_emp_task_open = 0;
    $qry = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.emp_id='$sess_report_id' and assign_concern.status='Open' ";
    // $open_task = 0;
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task_open = mysqli_num_rows($result);
    }

    $retailer_account = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.userid='$sess_report_id' and assign_concern.status='Open' ";
    $Total_rm_task_open = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task_open = mysqli_num_rows($result);
    }

    $open_task = $Total_emp_task_open + $Total_rm_task_open;
    
    //________________________________________________________________

    $Total_emp_task_close = 0;
    $qry = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.emp_id='$sess_report_id' and assign_concern.status='Close'";
    // $open_task = 0;
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task_close = mysqli_num_rows($result);
    }

    $retailer_account = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.userid='$sess_report_id' and assign_concern.status='Close'";
    $Total_rm_task_close = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task_close = mysqli_num_rows($result);
    }

    $close_task = $Total_emp_task_close + $Total_rm_task_close;
    
    //________________________________________________________________

    $Total_emp_task_wip = 0;
    $qry = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.emp_id='$sess_report_id' and assign_concern.status='WIP'";
    // $open_task = 0;
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task_wip = mysqli_num_rows($result);
    }

    $retailer_account = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.userid='$sess_report_id' and assign_concern.status='WIP'";
    $Total_rm_task_wip = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task_wip = mysqli_num_rows($result);
    }

    $WIP_task = $Total_emp_task_wip + $Total_rm_task_wip;
    
    //________________________________________________________________

    $Total_emp_task_cancel = 0;
    $qry = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.emp_id='$sess_report_id' and assign_concern.status='Cancel'";
    // $open_task = 0;
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task_cancel = mysqli_num_rows($result);
    }

    $retailer_account = "SELECT DISTINCT * FROM aeleacommodities_tasksM.assign_concern where assign_concern.userid='$sess_report_id' and assign_concern.status='Cancel'";
    $Total_rm_task_cancel = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task_cancel = mysqli_num_rows($result);
    }

    $cancel_task = $Total_emp_task_cancel + $Total_rm_task_cancel;
    
    //________________________________________________________________
}
?>

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <li class="breadcrumb-item"><a id='donext' href="Dashboard.php"><span>Dashboard</span></a></li>
    <li class="breadcrumb-item"><a id='donext' href="work_dash.php?source=admin_donext_dash"><span>Do Next</span></a></li>
    <li class="breadcrumb-item"><a href="work_dash.php?source=admin_a&b_dash"><span>Achievement & benefits</a></span></li>
    <li class="breadcrumb-item"><a href="work_dash.php?source=admin_concern_dash"><span>Concern</span></a></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
    <div class='scrollmenu'>
<div class="row">
            <div class="col-sm-12">
                <div class="row">
                <div class="col-md-8">
                <div class="element-wrapper">
                    <div class="element-actions">

                    
                    </div>
                    <h6 class="element-header">Concern</h6>
                    <div class="element-content">
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list.php">
                                    <div class="label">Total</div>
                                    <div class="value"><?php echo $Total_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_open_list.php">
                                    <div class="label">Open</div>
                                    <div class="value"><?php echo $open_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_close_list.php">
                                    <div class="label">Close</div>
                                    <div class="value"><?php echo $close_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list_wip.php">
                                    <div class="label">WIP</div>
                                    <div class="value"><?php echo $WIP_task; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list_cancel.php">
                                    <div class="label">Cancel</div>
                                    <div class="value"><?php echo $cancel_task; ?></div>
                               </a>
                            </div>

                            
</div>


<?php include './includes/Plugin.php'; ?>
  
</div>


<?php include './includes/admin_footer.php'; ?>
        
        <script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdfHtml5'
        ]
    } );
} );
        </script>