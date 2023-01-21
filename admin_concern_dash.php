
<?php
include './includes/admin_header.php';

?>
<?php 
$connection = mysqli_connect("localhost","root","","task_management");
$retailer_account = "SELECT task_id FROM assign_concern";
$Total_concern = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_concern = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status = 'Open'";
$open_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $open_task1 = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Close'";
$close_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $close_task1 = mysqli_num_rows($result);
    
}

$retailer_account = "SELECT task_id FROM assign_concern where status='WIP'";
$WIP_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $WIP_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_concern where status='Cancel'";
$cancel_task1 = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $cancel_task = mysqli_num_rows($result);
}?>

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <li class="breadcrumb-item"><a id='donext' href="Dashboard.php" ><span>Dashboard</span></a></li>
    <li class="breadcrumb-item"><a id='donext' href="admin_donext_dash.php" ><span>Do Next</span></a></li>
    <li class="breadcrumb-item"><a href="admin_a&b_dash.php"><span>Achievement & benefits</a></span></li>
    <li class="breadcrumb-item"><a id='donext'><span>Concern</span></a></li>
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
                    <div>
                    <h6 class="element-header">Concerns</h6>
                    <div class="element-content">
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list.php">
                                    <div class="label">Total Concern</div>
                                    <div class="value"><?php echo $Total_concern; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_open_list.php">
                                    <div class="label">Open Concern</div>
                                    <div class="value"><?php echo $open_task1; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_close_list.php">
                                    <div class="label">Close Concern</div>
                                    <div class="value"><?php echo $close_task1; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list_wip.php">
                                    <div class="label">WIP Concern</div>
                                    <div class="value"><?php echo $WIP_task1 ; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="assign_concern_list_cancel.php">
                                    <div class="label">Cancel Concern</div>
                                    <div class="value"><?php echo $cancel_task1; ?></div>
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