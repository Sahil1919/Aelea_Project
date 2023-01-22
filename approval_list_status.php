<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './includes/App_Code.php';
$app_code_obj=new App_Code();
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    $task_doc = $_FILES['file_attachment']['name'];
    $task_doc_temp = $_FILES['file_attachment']['tmp_name'];
    move_uploaded_file($task_doc_temp, "task_doc/$task_doc");
    
    $employee_id = $_POST['empid'];
           $task  = $_POST['task'];
           //  = $_POST['file_attachment'];
    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `status`)";
     $query .= " VALUES ('$employee_id','$task','$assign_by','$task_doc',now(),'Open')";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {

        echo "<script>alert('Record Save Successfully');</script>";
       // return 'pass';
    }
}

if(isset($_GET['share']) && isset($_GET['user_id']) && isset($_GET['emp_id']) )
{
    $task_id=$_GET['share'];
    $task_id = $task_id+1;
    $userID=$_GET['user_id'];
    $emp_id=$_GET['emp_id'];
    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `work_due_date`, `status`)";
     $query .= " VALUES ('$emp_id','','Admin','',now(),'','')";
    $update_password = mysqli_query($connection, $query);
    
    $query="UPDATE assign_task AS tab1 , assign_task AS tab2 SET tab2.`task`= tab1.`task`, tab2.work_due_date=tab1.work_due_date , tab2.assignby=tab1.assignby, tab2.task_doc=tab1.task_doc, tab2.work_due_date=tab1.work_due_date,tab2.work_com_date=tab1.work_com_date ,tab2.status=tab1.status,tab2.remark=tab1.remark   
    WHERE tab1.emp_id=$userID AND  tab2.`emp_id` =$emp_id";
    
    $update_password = mysqli_query($connection, $query);
    $task_id = $task_id-1;
    $query1="UPDATE `approval_list` SET `approval_status`='Approved', `approve_req`='1' WHERE `task_id`='$task_id' ";
    $update_password1 = mysqli_query($connection, $query1);
    if (!$update_password1) {
        echo "uiu";
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    }
   
}

if(isset($_GET['approve_req']) && isset($_GET['user_id']) && isset($_GET['emp_id']) )
{
    $task_id=$_GET['approve_req'];
    $userID=$_GET['user_id'];
    $emp_id=$_GET['emp_id'];
    // $update="UPDATE  job1 SET name='$name',email='$email',phn='$number',sub='$sub' WHERE id='$id";
    $query="UPDATE `assign_task` SET `emp_id`='$emp_id' WHERE `task_id`='$task_id' and emp_id='$userID'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    }
    else{
        $query="UPDATE `approval_list` SET `approval_status`='Approved', `approve_req`='1' WHERE `task_id`='$task_id' ";
        $update_password = mysqli_query($connection, $query);
    }
}


if(isset($_GET['reject']) && isset($_GET['user_id']) && isset($_GET['emp_id']) )
{
    $task_id=$_GET['reject'];
    $userID=$_GET['user_id'];
    $emp_id=$_GET['emp_id'];
    // $update="UPDATE  job1 SET name='$name',email='$email',phn='$number',sub='$sub' WHERE id='$id";
    
    $query="UPDATE `approval_list` SET `approval_status`='Reject', `approve_req`='0' WHERE `task_id`='$task_id' ";
    $update_password = mysqli_query($connection, $query);
    // header("Refresh:0; url=./includes/sidemenu.php");
}
?>

<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Approval List</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box">

                            <div class="row">
                            <div class="scrollmenu">
                                 <div class="col-md-12">
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Approval List</h5>    
                                                                   
                                </div>  
                                
                                <div class="element-box">
                                <!-- <div>
                                <a id="download" href='#' class="btn btn-danger float-right"><i class="fa fa-download"></i> Download PDF</a>
</div>
<br><br> -->
    <!-- <form action="GET" action='wrap.php'> -->
       <table id="example" style="width: 100%;" class="display table table-bordered table-responsive" style="width:100%">
       <!-- <a id='example' style="width: 100%;" class="display table table-bordered table-responsive" style="width:100%" href="assign_task_list.php?delete_task=<?php echo $row['task_id'];?>">Delete</a> -->
       <thead>
                    <tr>
                        <th>S No.</th>
                        <th>From Employee Name</th>
                        <th>To Employee Name</th>
                        <th>Do Next</th>
                         <th>Assigned By</th>
                          <th>Download File</th>
                           <th>Assign Work Date</th>
                           <th>Work Due Date</th>
                            <th>Work Complete Date</th>
                             <th>Work Status</th>
                             <th>Remark</th>
                             <th>Due Status</th>
                              
<!--                               <th>Edit</th>-->
                        <th>Reporting To</th>
                        <th>Approval For</th>
                          <th>Approval Status</th>
                          <!-- <th>Approve Request</th> -->
                    </tr>
        </thead>
        <tbody>
     <?php
//     if ($_SESSION['User_type'] == 'reporting manager'){
//         $sess_report_id = $_SESSION['user'];
// $qry = mysqli_query($connection, "SELECT * FROM approval_list where approval_status = 'Pending' and report_to='$sess_report_id' ") or die("select query fail" . mysqli_error());
//     }
//     else{
    $sess_id = $_SESSION['user'];
    $qry = mysqli_query($connection, "SELECT * FROM approval_list where user_id = '$sess_id' ") or die("select query fail" . mysqli_error());
    // }

$count = 0;
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y g:i:s A');
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $user_id = $row['user_id'];
    $emp_id = $row['emp_id'];

    // $query = mysqli_query($connection, "SELECT * FROM emp_login WHERE id = '$user_id'");
    // $data=mysqli_fetch_assoc($query);
    // $from_name = $data['emp_name'];

            // $emp_id = $row['emp_id']; 
            // $user_role = $row['user_role'];
            $task = $row['task'];
            $assignby = $row['assign_by'];
            $task_doc = $row['task_doc'];
            $work_assign_date = strtotime($row['work_assign_date']);
            $work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );

            $work_due_date = strtotime($row['work_due_date']);
            $work_due_date = date( 'd-m-y g:i:s A', $work_due_date );

            $work_com_date = strtotime($row['work_com_date']);
            // echo gettype($work_com_date);
            if (gettype($work_com_date)!='integer'){
                
                $work_com_date = date( 'd-m-y g:i:s A', $work_com_date);
            }
            else{
                $work_com_date = '';
            }
            

           $status  = $row['status'];
                $remark  = $row['remark'];
                $report_to = $row['report_to'];
                $approval_for = $row['approval_for'];
                $approval_status = $row['approval_status'];
                $approval_required = $row['approve_req'];
    ?>
                    <tr>
  <td><?php echo $count;?></td>
  <td> <?php echo $app_code_obj->getName($user_id);?></td>
  <!-- <td><?php echo $app_code_obj->get_User_role($user_id);?></td>  -->
  <td> <?php echo $app_code_obj->getName($emp_id);?></td>
  <!-- <td><?php echo $app_code_obj->get_User_role($emp_id);?></td>  -->
  <td><?php echo $task;?></td>
  <td><?php echo $assignby;?></td> 
  <td>
      <?php if($task_doc !='')
      {?>
      <?php $docs = explode(",",$task_doc);?>
      <?php foreach($docs as $value) 
        {?>
        <?php  $value =  ltrim($value);?>
      <a href="task_doc/<?php echo $value;?>" class="btn btn-primary">Download</a> 
      <br>
      <br>
      <?php }?>
      <?php }?>
  </td> 
  
    <td><?php echo $work_assign_date;?></td> 
    <td><?php echo $work_due_date;?></td> 
  <td><?php echo $work_com_date;?></td> 
  <td>
    <a href="#" class="btn btn-success"> <?php echo" $status";?></a>
   </td> 
   <td>
    <?php if ($status=='Close')
    {?>
     <a style="width: 100%;" class="btn btn-info" href="achievement&benefits.php?task_id=<?php echo $task_id;?>">View A & B</a>

     <?php } else { echo" $remark";}?>
   </td>
    
   <?php if($work_com_date && $status!='WIP'): ?>

    <?php if($work_due_date >= $date): ?>
            <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>

    <?php elseif($work_com_date <= $work_due_date): ?>
        <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>
            <?php else: ?>    
            <td><a href="#" class="btn btn-danger"> <?php echo "Overdue";?></a> <br></td> 
        <?php endif; ?>

    <?php elseif($work_due_date >= $date): ?>
    <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>
<?php else: ?>    
<td><a href="#" class="btn btn-danger"> <?php echo "Overdue";?></a> <br></td> 

<?php endif; ?>

   
    
<!--    <td> <img src="user_profile/<?php echo $emp_pro;?>" height="80px" width="80px"></td> 
      <td><?php echo $created;?></td> 
      <td><a href="employee.php?id=<?php echo $row['task_id']; ?>&Status=<?php echo $row['status']; ?>" class="<?php echo $btnClass; ?> " ><?php echo $status; ?></a></td>
    <td><a class="btn btn-primary" href="employee.php?source=update_emp&emp_id=<?php echo $id;?>">Edit</a></td>-->
    <td><?php echo $app_code_obj->getName($report_to);?></td>
    <td><?php echo $approval_for?></td>
    <?php if ($approval_status == 'Pending') {?>
    <td><a href="#" class="btn btn-warning"> <?php echo $approval_status;?></a> <br></td>
    <?php } elseif($approval_status=='Approved') {?>
        <td><a href="#" class="btn btn-success"> <?php echo $approval_status;?></a> <br></td>
        <?php } else{?>
            <td><a href="#" class="btn btn-danger"> <?php echo $approval_status;?></a> <br></td>
            <?php }?>
    <!-- <td> 
    <?php if ($approval_for=='Transfer Do Next')
    {?>
    <a class="btn btn-success" href="approval_list.php?approve_req=<?php echo $row['task_id']; ?>&user_id=<?php echo $row['user_id']; ?>&emp_id=<?php echo $row['emp_id']; ?>">Approve</a>
    <?php } else {?>  
        <a class="btn btn-success" href="approval_list.php?share=<?php echo $row['task_id'];?>&user_id=<?php echo $row['user_id'];?>&emp_id=<?php echo  $row['emp_id']; ?>">Approve</a>
    <?php } ?> 
    <br><br>
    <a class="btn btn-danger" href="approval_list.php?reject=<?php echo $row['task_id'];?>&user_id=<?php echo $row['user_id'];?>&emp_id=<?php echo  $row['emp_id']; ?>"> Reject </a>
    </td> -->
</tr>

<?php }?>
        </tbody>
       </table></form>
   </div>
                            </div>
           
            </div>
        </div>
    </div>
</div>
        </div>
                                
                                
<?php include './includes/Plugin.php'; ?>
        <?php include './includes/admin_footer.php'; ?>

<script>


$(document).ready(function() {
    $('#example').DataTable( {
        // dom: 'Blfrtip',
        "lengthMenu": [[25,50,100,500], [25,50,100,500]]
    } );
} );
$url = "tabletesting.php?search=";
// $url = "testing.php?search=";
$('#download').on('click', function() {
    var value = $('.dataTables_filter input').val();
    console.log(value);
    if (value === undefined || value===""){
        window.location.href = $url;
    }
    else{
        // var value = $('.dataTables_filter input').val();
        window.location.href = $url+ value;
    }
    })

$(document).ready(function() {
    $('.datepicker').datepicker({
  weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
  showMonthsShort: true
});
} );
        </script> 
                              