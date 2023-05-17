<?php
session_start();
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
     $query .= " VALUES ('$employee_id','$task','Admin','$task_doc',now(),'Open')";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {

        echo "<script>alert('Record Save Successfully');</script>";
       // return 'pass';
    }
}

?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Assign Do Next List</span></li>
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
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Do Next List</h5>                                   
                                </div>  
                            </div>
                                <div class="element-box">
                                <div>
                                <a id="download" href='#' class="btn btn-danger float-right"><i class="fa fa-download"></i> Download PDF</a>
</div>
<br><br>

   <table id="example" style="width: 100%;" class="display table table-bordered table-responsive" style="width:100%">
        <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Employee Name</th>
                        <th>Do Next</th>
                         <th>Assigned By</th>
                         <th>Report To</th>
                          <th>Download File</th>
                           <th>Assign Work Date</th>
                           <th>Work Due Date</th>
                            <th>Work Complete Date</th>
                             <th>Work Status</th>
                             <th>Remark</th>
                             <th>Due Status</th>
                              
<!--                               <th>Edit</th>-->
                          <th>Change Status/Transfer Concern/Share Concern</th>
                            <!-- <th>DELETE</th> -->
                        </tr>
        </thead>
        <tbody>
                                     <?php
                                                            $emp_id=  $_SESSION['user'];
                 $qry = mysqli_query($connection, "SELECT * FROM assign_task where emp_id='$emp_id' order by work_assign_date desc") or die("select query fail" . mysqli_error($connection));
$count = 0;
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y g:i:s A');
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $task_id = $row['task_id'];
            $emp_id1 = $row['emp_id']; 
            $task = $row['task'];
            $assignby = $row['assignby'];
            $qry1 = mysqli_query($connection, "SELECT report_to FROM emp_login where id = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
        
            while ($report_row = mysqli_fetch_assoc($qry1))
            {
            if (strlen($report_row['report_to']) != 0) 
            {
                $report_to = $report_row['report_to'];
                
            }
            else{
                $report_to = "";
            }
            
            }
            $task_doc = $row['task_doc'];
            $work_assign_date = strtotime($row['work_assign_date']);
            $work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
            
            $work_due_date = strtotime($row['work_due_date']);
            $work_due_date = date( 'd-m-y g:i:s A', $work_due_date );

            $work_com_date = strtotime($row['work_com_date']);
            if ($work_com_date){
                
                $work_com_date = date( 'd-m-y g:i:s A', $work_com_date);
                
            }
           $status  = $row['status'];
               $remark  = $row['remark'];
    ?>
                    <tr>
  <td><?php echo $count;?></td>
  <td> <?php echo $app_code_obj->getName($emp_id1);?></td>
  <td><?php echo $task;?></td>
  <td><?php echo $assignby;?></td> 
  <td><?php echo $app_code_obj->getName($report_to);?></td>
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
       <?php } else { echo $task_doc;}?>
  </td> 
  <td><?php echo $work_assign_date;?></td> 
    <td><?php echo $work_due_date;?></td> 
  <td><?php echo $work_com_date;?></td> 
  <td><a href="#" class="btn btn-success"> <?php echo" $status";?></a></td> 
  <td>
    <?php if ($status=='Close')
    {?>
     <a style="width: 100%;" class="btn btn-info" href="achievement&benefits.php?task_id=<?php echo $task_id;?>">View A & B</a>

     <?php } else { echo" $remark";}?>
   </td>
   <?php 
   $originalTime = new DateTimeImmutable($date);
   $targedTime = new DateTimeImmutable($work_due_date);
   $interval = $originalTime->diff($targedTime);
   $interval = $interval->format("%a");
   ?>
    
   <?php if ($work_com_date=='') { if ($interval>0){?>
    <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>
    <?php } else { if (strtotime($work_due_date) >= strtotime($date)) 
        {?>
        <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>
    <?php } else {?>
        <td><a href="#" class="btn btn-danger"> <?php echo "Overdue";?></a> <br></td>
    <?php } } } else {?>
    <?php if (strtotime($work_com_date) <= strtotime($work_due_date)) { ?>
        <td><a href="#" class="btn btn-warning"> <?php echo "Due";?></a> <br></td>
    <?php } else {?>
        <td><a href="#" class="btn btn-danger"> <?php echo "Overdue";?></a> <br></td>
    <?php }}?>
    
<!--    <td> <img src="user_profile/<?php echo $emp_pro;?>" height="80px" width="80px"></td> 
      <td><?php echo $created;?></td> 
      <td><a href="employee.php?id=<?php echo $row['task_id']; ?>&Status=<?php echo $row['status']; ?>" class="<?php echo $btnClass; ?> " ><?php echo $status; ?></a></td>
    <td><a class="btn btn-primary" href="employee.php?source=update_emp&emp_id=<?php echo $id;?>">Edit</a></td>-->
                              <td>
                                  <a style="width: 100%;" class="btn btn-info" href="emp_change_status.php?task_id=<?php echo $task_id;?>">Change Status</a>
                                  <br>
                                  <br>
                                  <a style="width: 100%;" class="btn btn-success" href="tran_assign_task.php?task_id=<?php echo $task_id;?>">Transfer Do Next</a>
                                  <br>
                                  <br>
                                  <a style="width: 100%;" class="btn btn-warning" href="share_assign_task.php?task_id=<?php echo $task_id;?>">Share Do Next</a>
                              
                                </td>

                    </tr>
<?php }?>
        </tbody> </table>
   </div>
                            </div>
           
            </div>
        </div>
    </div>
</div>

                                
                                
<?php include './includes/Plugin.php'; ?>
        <?php include './includes/admin_footer.php'; ?>
                                <script>


var empid = <?php echo(json_encode($emp_id1)); ?>;
$(document).ready(function() {
    $('#example').DataTable( {
        // dom: 'Blfrtip',
        buttons: [
            'pdfHtml5'
        ]
    } );
} );
$url = "generator1.php?search=";
$id = "&id=";

$('#download').on('click', function() {
    var value = $('.dataTables_filter input').val();
    console.log(value);
    if (value === undefined || value===""){
        window.location.href = $url+$id+empid;
    }
    else{
        // var value = $('.dataTables_filter input').val();
        window.location.href = $url+ value+$id+empid;
    }
    })

$(document).ready(function() {
    $('.datepicker').datepicker({
  weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
  showMonthsShort: true
});
} );
  </script>                 