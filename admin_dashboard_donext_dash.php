
<?php
include './includes/admin_header.php';

?>
<?php 

$connection = mysqli_connect("localhost","root","","task_management");

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management') ";
$Total_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_emp = mysqli_num_rows($result);
}

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management') and status='1' ";
$Active_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Active_emp = mysqli_num_rows($result);
}

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management') and status='0' ";
$Deactive_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Deactive_emp = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task";
$Total_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Open'";
$open_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $open_task = mysqli_num_rows($result);
}


$retailer_account = "SELECT task_id FROM assign_task where status='WIP'";
$WIP_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $WIP_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Close'";
$close_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $close_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Cancel'";
$cancel_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $cancel_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern";
$Total_concern = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_concern = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern";
$open_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $open_task1 = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Close'";
$close_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $close_task1 = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='WIP'";
$WIP_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $WIP_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Cancel'";
$cancel_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $cancel_task = mysqli_num_rows($result);
}?>

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <li class="breadcrumb-item"><a id='donext' href="Dashboard.php" ><span>Dashboard</span></a></li>
    <li class="breadcrumb-item"><a id='donext' href="wrap.php" ><span>Do Next</span></a></li>
    <li class="breadcrumb-item"><a href=""><span>Achievement & benefits</a></span></li>
    <li class="breadcrumb-item"><a href="assign_task.php"><span>Concerns</span></a></li>
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
                    <h6 class="element-header">Do Next</h6>
                    <div class="element-content">
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_task_list.php">
                                    <div class="label">Total</div>
                                    <div class="value"><?php echo $Total_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_task_open_list.php">
                                    <div class="label">Open</div>
                                    <div class="value"><?php echo $open_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_task_list_close.php">
                                    <div class="label">Close</div>
                                    <div class="value"><?php echo $close_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_task_list_wip.php">
                                    <div class="label">WIP</div>
                                    <div class="value"><?php echo $WIP_task; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_task_list_cancel.php">
                                    <div class="label">Cancel</div>
                                    <div class="value"><?php echo $cancel_task; ?></div>
                               </a>
                            </div>

                            
</div>


<?php include './includes/Plugin.php'; ?>
  
</div>


<?php include './includes/admin_footer.php'; ?>
        
 