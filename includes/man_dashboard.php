
<div class='scrollmenu'>
<div class="row">
            <div class="col-sm-12">
                <div class="row">
                <div class="col-md-8">
                <div class="element-wrapper">
                    <div class="element-actions">
<?php 

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


$emp_id=  $_SESSION['user'];
  $retailer_account = "SELECT task_id FROM assign_task where emp_id='$emp_id'";
  $Total_task_man = 0;
  if ($result = mysqli_query($connection, $retailer_account)) {
      $Total_task_man = mysqli_num_rows($result);
  }
?>
                    </div>
                    <h6 class="element-header">Dashboard</h6>
                    <div class="element-content">
                        
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee.php">
                                    <div class="label">Total Employee</div>
                                    <div class="value"><?php echo $Total_emp; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee_active.php">
                                    <div class="label">Active Employee</div>
                                    <div class="value"><?php echo $Active_emp; ?></div>
                                    <!--                                                    <div class="trending trending-down-basic"><span>9%</span><i class="os-icon os-icon-arrow-down"></i></div>-->
                                </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee_deactive.php">
                                    <div class="label">Deactivate Employee</div>
                                    <div class="value"><?php echo $Deactive_emp; ?></div>
                                </a>
                            </div>      
                            
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="man_view_portal.php">
                                    <div class="label">My Concerns List</div>
                                    <div class="value"><?php echo $Total_task_man; ?></div>
                               </a>
                            </div>

</div>

