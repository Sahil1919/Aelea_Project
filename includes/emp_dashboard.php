
<div class="row">
            <div class="col-sm-12">
                <div class="row">
                <div class="col-md-8">
                <div class="element-wrapper">
                    <div class="element-actions">
<?php 
$emp_id=  $_SESSION['user'];
$retailer_account = "SELECT task_id FROM assign_task where emp_id='$emp_id'";
$Total_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Open' and  emp_id='$emp_id'";
$open_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $open_task = mysqli_num_rows($result);
}


$retailer_account = "SELECT task_id FROM assign_task where status='WIP' and  emp_id='$emp_id'";
$WIP_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $WIP_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Close' and  emp_id='$emp_id'";
$close_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $close_task = mysqli_num_rows($result);
}

$retailer_account = "SELECT task_id FROM assign_task where status='Cancel' and  emp_id='$emp_id'";
$cancel_task = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $cancel_task = mysqli_num_rows($result);
}
?>
                    </div>
                    <h6 class="element-header">Do Next</h6>
                    <div class="element-content">
                        <div class="row">

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_task_list.php">
                                    <div class="label">Total (Do Next)</div>
                                    <div class="value"><?php echo $Total_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_task_list_open.php">
                                    <div class="label">Open (Do Next)</div>
                                    <div class="value"><?php echo $open_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_task_list_close.php">
                                    <div class="label">Close (Do Next)</div>
                                    <div class="value"><?php echo $close_task; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_task_list_wip.php">
                                    <div class="label">WIP (Do Next)</div>
                                    <div class="value"><?php echo $WIP_task; ?></div>
                               </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="emp_assign_task_list_cancel.php">
                                    <div class="label">Cancel (Do Next)</div>
                                    <div class="value"><?php echo $cancel_task; ?></div>
                               </a>
                            </div>


                    
                        </div>
                    </div>
                </div>
          </div> 
                <div class="col-md-4">
                      <!--------------------

                </div>
            </div>
            </div>
        </div>    