<?php
session_start();
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    $assign_by = ucfirst($_SESSION['User_type']);
    $minutes_to_add = 330;
    $time = new DateTime();
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $stamp = $time->format('Y-m-d H:i');  
    // echo $stamp;
    // $stamp = $time->format('Y-m-d H:i');     
$total = isset($_FILES["file_attachment"]) ? count($_FILES["file_attachment"]["name"]) : 0 ;
    
if ($total>0){
for ($i=0; $i<$total; $i++) {
    $source = $_FILES["file_attachment"]["tmp_name"][$i];
    $destination = $_FILES["file_attachment"]["name"][$i];
    $collector[] = $destination;
    move_uploaded_file($source, "task_doc/$destination");
  }
}
$docs =  implode(",",$collector);
    
    $employee_id = $_POST['empid'];
           $test_task  = $_POST['Concern'];
           $task = str_replace("'","''",$test_task);
    $due_date = $_POST['duedate'];
    // echo $due_date;
    
           //  = $_POST['file_attachment'];
    $query = "INSERT INTO `assign_task`( `emp_id`, `task`, `assignby`, `task_doc`, `work_assign_date`, `work_due_date`, `status`)";
     $query .= " VALUES ('$employee_id','$task','$assign_by','$docs','$stamp','$due_date','Open')";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {

        echo "<script>alert('Record Save Successfully');</script>";
       // return 'pass';
    }
    // $query = " SELECT work_assign_date, CONVERT(datetime, SWITCHOFFSET(CONVERT(DATETIMEOFFSET, work_assign_date), DATENAME(TZOFFSET, SYSDATETIMEOFFSET())))  AS LOCAL_IST FROM assign_task;"
    // $update_password = mysqli_query($connection, $query);
    // if (!$update_password) {
    //     die('QUERY FAILD change pashword' . mysqli_error($connection));
    // } else {

    //     echo "<script>alert('Record Save Successfully');</script>";
    //    // return 'pass';
    // }
}
?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Assign Do Next</span></li>
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
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Do Next</h5>                                   
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
    if ($_SESSION['User_type']=='reporting manager'){    
        $sess_report_id = $_SESSION['user'];                                                      
    $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','reporting manager') and status='1' and report_to='$sess_report_id' or id='$sess_report_id' ") or die("select query fail" . $connection->mysqli_error());
    }
    else{
        $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','management','reporting manager','admin') and status='1'") or die("select query fail" . $connection->mysqli_error());
    }

    $count = 0;
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $id = $row['id'];
            $emp_code = $row['emp_code'];
            $emp_name = $row['emp_name'];
            $user_role =  ucfirst($row['user_role']);
        
            echo "<option value=".$id.">".$emp_code."/".$emp_name."/".$user_role."</option>";
}?>
                                              
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Do Next</label>
                                        <textarea class="form-control " rows="1" name="Concern" placeholder="Enter Do Next" ></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">Due Date </label>  
                                        <input class="form-control" id="from-datepicker" name="duedate" placeholder="" type="datetime-local" >                                      
                                    </div>
                                </div>
                                    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
                                    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css"> -->
                                    

                                <div class="col-sm-3">
                                    <div class="form-group"><label for="">File Attachment</label>
                                        <input name="file_attachment[]" type="file" multiple>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <br>
                                         <input class="btn btn-primary" type="submit" value="Assign Do Next" name="submit">
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