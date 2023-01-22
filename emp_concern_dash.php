
<?php
include './includes/admin_header.php';

?>
<?php 
$emp_id=  $_SESSION['user'];

$retailer_account = "SELECT task_id FROM assign_concern where emp_id='$emp_id'";
$Total_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Open' and  emp_id='$emp_id'";
$open_concern = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $open_concern = mysqli_num_rows($result);
}


$retailer_account = "SELECT task_id FROM assign_concern where status='WIP' and  emp_id='$emp_id'";
$wip_concern = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $wip_concern = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Close' and  emp_id='$emp_id'";
$close_concern = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $close_concern = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Cancel' and  emp_id='$emp_id'";
$cancel_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $cancel_task = mysqli_num_rows($result);
}
?>

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <li class="breadcrumb-item"><a href="Dashboard.php" ><span>Dashboard</span></a></li>
    <!-- <li class="breadcrumb-item"><a id='donext' href="#" ><span>Do Next</span></a></li> -->
    <li class="breadcrumb-item"><a href="admin_a&b_dash.php"><span>Achievements & Benefits</a></span></li>
    <li class="breadcrumb-item"><a href="emp_concern_dash.php"><span>Concern</span></a></li>
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
                    <h6 class="element-header">Concerns</h6>
                    <div class="element-content">
                        <div class="row">

                        <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_concern_list.php">
                                    <div class="label">Total Concern</div>
                                    <div class="value"><?php echo $Total_task; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_concern_list_open.php">
                                    <div class="label">Open Concern</div>
                                    <div class="value"><?php echo $open_concern; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_concern_list_close.php">
                                    <div class="label">Close Concern</div>
                                    <div class="value"><?php echo $close_concern; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_concern_list_wip.php">
                                    <div class="label">WIP Concern</div>
                                    <div class="value"><?php echo $wip_concern; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_concern_list_cancel.php">
                                    <div class="label">Cancel Concern</div>
                                    <div class="value"><?php echo $cancel_task; ?></div>
                               </a>
                            </div>
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