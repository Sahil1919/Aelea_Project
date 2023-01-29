<?php

include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    $assign_by = ucfirst($_SESSION['emp_name']);
    $userid = $_SESSION['user'];
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
           $task  = $_POST['Concern'];
    // $due_date = $_POST['duedate'];
           //  = $_POST['file_attachment'];
    $query = "INSERT INTO `assign_concern`( `emp_id`, `userid`,`task`, `assignby`, `task_doc`, `work_assign_date`, `work_due_date`, `status`)";
     $query .= " VALUES ('$employee_id','$userid','$task','$assign_by','$docs',now(),'','Open')";
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
    <li class="breadcrumb-item"><span>Assign Concern</span></li>
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
                                    <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Assign Concern</h5>                                   
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
                                                          
                 $qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','management','admin','reporting manager') and status='1'") or die("select query fail" . mysqli_error());
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
                                    <div class="form-group"><label for="">Concern</label>
                                        <textarea class="form-control " rows="1" name="Concern" placeholder="Enter Do Next" ></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-sm-3">
                                    <div class="form-group"><label for="">Due Date </label>  
                                        <input class="form-control" id="from-datepicker" name="duedate" placeholder="" type="datetime-local" >                                      
                                    </div>
                                </div> -->
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
                                         <input class="btn btn-primary" type="submit" value="Assign Concern" name="submit">
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