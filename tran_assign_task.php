<?php
session_start();
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {

    if ($_SESSION['User_type']=='admin' || $_SESSION['User_type']=='management' || $_SESSION['User_type']=='reporting manager' )
    {
        $task_id=$_GET['task_id'];    
    $employee_id = $_POST['empid'];
           $query="UPDATE `assign_task` SET `emp_id`='$employee_id' WHERE `task_id`='$task_id' ";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } 
    }
    else{
   $userID = $_SESSION['user'];
   $task_id=$_GET['task_id'];    
    $employee_id = $_POST['empid'];
    $result=mysqli_query($connection,"SELECT * from emp_login WHERE id='$userID'");
	$data1=mysqli_fetch_assoc($result);
    $report_to = $data1['report_to'];

    $result1=mysqli_query($connection,"SELECT *  from assign_task WHERE `task_id`='$task_id' and emp_id='$userID'");
	$data=mysqli_fetch_assoc($result1);
    
    $task = $data['task'];
    $assign_by = $data['assignby'];
    $task_doc = $data['task_doc'];
    $work_assign_date = $data['work_assign_date'];
    $work_due_date = $data['work_due_date'];
    $work_com_date = $data['work_com_date'];
    $status = $data['status'];
    $remark = $data['remark'];
    $approval_for = 'Transfer Do Next';
    $approval_status = 'Pending';
    $approve_req = 0;
    

    $query = "INSERT INTO `approval_list`(`user_id`, `emp_id`, `task_id`, `task`, `assign_by`, `task_doc`, `work_assign_date`, `work_due_date`, `work_com_date`, `status`, `remark`, `report_to`, `approval_for`, `approval_status`,`approve_req`)";
    $query.= "VALUES ('$userID','$employee_id','$task_id','$task','$assign_by','$task_doc','$work_assign_date','$work_due_date','$work_com_date','$status','$remark','$report_to','$approval_for','$approval_status','$approve_req')";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } 

    //        $query="UPDATE `assign_task` SET `emp_id`='$employee_id' WHERE `task_id`='$task_id' and emp_id='$userID'";
    // $update_password = mysqli_query($connection, $query);
    // if (!$update_password) {
    //     die('QUERY FAILD change pashword' . mysqli_error($connection));
    // }
    }
}
?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Transfer Do Next</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box">

                            <div class="row">
                                 <div class="col-md-12">
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Transfer Do Next</h5>                                   
                                </div>  
                            </div>
                                  <form class="container" action="#" method="post" enctype="multipart/form-data">


                            <div class="row">

<!--                          
                                <fieldset class="col-md-12">
                                    <legend>Company Details
                                        <hr></legend>
                                </fieldset>-->

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Employee</label>
                                        <select id="emp_id" name="empid" class="form-control select2">
                                            <option>--select Employee--</option>
    <?php
    $sess_report_id = $_SESSION['user'];
    if ($_SESSION['User_type']=='reporting manager'){    
                                                             
    $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','reporting manager') and status='1' and report_to='$sess_report_id' or id='$sess_report_id' ") or die("select query fail" . mysqli_error($connection));
    }
    elseif ($_SESSION['User_type']=='management' || $_SESSION['User_type']=='admin'){
        $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','management','reporting manager','admin') and status='1'") or die("select query fail" . mysqli_error($connection));
    }
    else{
        $qry1 = mysqli_query($connection, "SELECT report_to FROM emp_login where id='$sess_report_id' ") or die("select query fail" . mysqli_error($connection));
        $row = mysqli_fetch_assoc($qry1);
        
        $report_to_id = $row['report_to'];
        
        $qry = mysqli_query($connection, "SELECT * FROM emp_login where report_to = '$report_to_id' ") or die("select query fail" . mysqli_error($connection));
    }
                                                          
// $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','management','repoting manager') and status='1'") or die("select query fail" . mysqli_error($connection));
$count = 0;
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $id = $row['id'];
            $emp_code = $row['emp_code'];
            $emp_name = $row['emp_name'];
            $user_role = ucfirst($row['user_role']);
            echo "<option value=".$id.">".$emp_code."/".$emp_name.'/'.$user_role."</option>";
}?>
                                              
                                            
                                        </select>
                                    </div>
                                </div>
                       
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <br>
                                         <input class="btn btn-primary" type="submit" value="Transfer Do Next" name="submit">
                                        <!--<label for="">Conform Password</label>-->
                                        <!--<input class="form-control" name="CPSWD" placeholder="Conform Password" type="password">-->
                                    </div>
                                </div>




<!--                                <div class="form-buttons-w text-right">
                                    <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                                </div>-->
                            </div>
                        </form>
                            </div>
           
            </div>
        </div>
    </div>
</div>

                                
                                
<?php include './includes/Plugin.php'; ?>
        <?php include './includes/admin_footer.php'; ?>
    
        <script>
    $('.select2').select2();
</script>