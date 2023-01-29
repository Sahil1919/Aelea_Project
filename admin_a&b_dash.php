
<?php
include './includes/admin_header.php';
?>
<?php 
$connection = mysqli_connect("localhost","root","","task_management");
if ($_SESSION['User_type'] =='management' || $_SESSION['User_type'] =='admin'){
    $retailer_account = "SELECT task_id FROM assign_task";
    $Total_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_task = mysqli_num_rows($result);
    }
   
    $retailer_account = "SELECT task_id FROM assign_task where status='Close'";
    $close_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $close_task = mysqli_num_rows($result);
    }
    
}
else{
    $sess_report_id = $_SESSION['user'];
    // ________________________________________________
    $Total_emp_task=0;
    $qry = "SELECT id,task_id FROM emp_login,assign_task where user_role IN ('employee','reporting manager') and emp_id=id and report_to='$sess_report_id' ";
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task = mysqli_num_rows($result);
    }
    
    $retailer_account = "SELECT DISTINCT task_id FROM emp_login,assign_task where user_role IN ('reporting manager') and emp_id='$sess_report_id' ";
    $Total_rm_task = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task = mysqli_num_rows($result);
    }

    $Total_task = $Total_rm_task+$Total_emp_task;
    // ________________________________________________
    
    //________________________________________________________________

    $Total_emp_task_close = 0;
    $qry = "SELECT id,task_id FROM emp_login,assign_task where user_role IN ('employee','reporting manager') and assign_task.status='Close' and emp_id=id and report_to='$sess_report_id'";
    // $open_task = 0;
    if ($result = mysqli_query($connection, $qry)) {
        $Total_emp_task_close = mysqli_num_rows($result);
    }

    $retailer_account = "SELECT DISTINCT task_id FROM emp_login,assign_task where user_role IN ('reporting manager') and assign_task.status= 'Close' and emp_id='$sess_report_id'";
    $Total_rm_task_close = 0;
    if ($result = mysqli_query($connection, $retailer_account)) {
        $Total_rm_task_close = mysqli_num_rows($result);
    }

    $close_task = $Total_emp_task_close + $Total_rm_task_close;
    
    //________________________________________________________________
    
    //________________________________________________________________
}
?>

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <li class="breadcrumb-item"><a id='donext' href="Dashboard.php" ><span>Dashboard</span></a></li>
    <li class="breadcrumb-item"><a id='donext' href="admin_donext_dash.php"><span>Do Next</span></a></li>
    <li class="breadcrumb-item"><a href="admin_a&b_dash.php"><span>Achievement & benefits</a></span></li>
    <li class="breadcrumb-item"><a href="admin_concern_dash.php"><span>Concern</span></a></li>
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
                    <h6 class="element-header">Achievement & Benefits</h6>
                    <div class="element-content">
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="total_list_a&b.php">
                                    <div class="label">Total</div>
                                    <div class="value"><?php echo $Total_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="total_a&b_done.php">
                                    <div class="label">Close</div>
                                    <div class="value"><?php echo $close_task; ?></div>
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