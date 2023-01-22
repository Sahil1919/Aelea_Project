<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
        
    if ($_SESSION['User_type']=='admin' || $_SESSION['User_type']=='management' || $_SESSION['User_type']=='reporting manager' ){
        $assign_by = ucfirst($_SESSION['User_type']);
        $task_id = $_GET['task_id'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $achievement = $_POST['other_remark'];
        $benefit = $_POST['other_remark1'];
        $concern = $_POST['Concern'];
        $due_date = $_POST['duedate'];
        // $work_assign_date = date( 'd-m-y g:i:s A' );
        $total = isset($_FILES["file_attachment"]) ? count($_FILES["file_attachment"]["name"]) : 0 ;
        
        if ($total>0){
            if ($status=='Open'){
        for ($i=0; $i<$total; $i++) {
            $source = $_FILES["file_attachment"]["tmp_name"][$i];
            $destination = $_FILES["file_attachment"]["name"][$i];
            $collector[] = $destination;
            move_uploaded_file($source, "task_doc/$destination");
          }}
          else{
            for ($i=0; $i<$total; $i++) {
                $source = $_FILES["file_attachment"]["tmp_name"][$i];
                $destination = $_FILES["file_attachment"]["name"][$i];
                $collector[] = $destination;
                move_uploaded_file($source, "attachment/$destination");
              }
          }
        }
        $docs =  implode(", ",$collector);
    
        $query = "UPDATE `assign_task` SET ";
    
        if ($status=='Close') {
            $query .= "`work_com_date`=now(),";
            $query .= "`status`='$status',";
            $query .= "`Achievements`='$achievement',";
            $query .= "`Benefits`='$benefit',";
            // $query .= "`task`='$concern',";
            // $query .= "`work_due_date`='$due_date',";
            // $query .= "`work_assign_date`='$work_assign_date',";
        }
    
        if ($status=='Open'){
            $query .= "`task_doc`='$docs',";
            $query .= "`work_com_date`=null,";
            $query .= "`status`='$status',";
            $query .= "`Achievements`='$achievement',";
            $query .= "`Benefits`='$benefit',";
            $query .= "`task`='$concern',";
            $query .= "`work_due_date`='$due_date',";
            $query .= "`work_assign_date`=now(),";
            $query .= "`assignby`='$assign_by',";
        }
        else{
            $query .= "`attachments`='$docs',";
        }
        $query .= "`status`='$status',";
        $query .= "`Achievements`='$achievement',";
        $query .= "`Benefits`='$benefit',";
        $query .= "`attachments`='$docs',";
        $query .= "`remark`='$remark' WHERE `task_id`='$task_id' ";
        $update_password = mysqli_query($connection, $query);
        if (!$update_password) {
            die('QUERY FAILD change pashword' . mysqli_error($connection));
        } 
    }
    
    $emp_id = $_SESSION['user'];
    $task_id = $_GET['task_id'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $achievement = $_POST['other_remark'];
    $benefit = $_POST['other_remark1'];
    $total = isset($_FILES["file_attachment"]) ? count($_FILES["file_attachment"]["name"]) : 0 ;
    if ($total>0){
    for ($i=0; $i<$total; $i++) {
        $source = $_FILES["file_attachment"]["tmp_name"][$i];
        $destination = $_FILES["file_attachment"]["name"][$i];
        $collector[] = $destination;
        move_uploaded_file($source, "attachment/$destination");
      }
    }
    $docs =  implode(",",$collector);

    $query = "UPDATE `assign_task` SET ";

    if ($status=='Close') {
        $query .= "`work_com_date`=now(),";
    }

    $query .= "`status`='$status',";
    $query .= "`Achievements`='$achievement',";
    $query .= "`Benefits`='$benefit',";
    $query .= "`attachments`='$docs',";
    $query .= "`remark`='$remark' WHERE `task_id`='$task_id' and `emp_id`='$emp_id'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } 
}
?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Change Status</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function() {

    if ($( "#status option:selected" ).text()=='--Select--'){
       
        jQuery('div[name=concern]').hide();  
            jQuery('label[name=concern]').hide();  
            jQuery('input[name=concern]').hide(); 
            jQuery('div[name=duedate]').hide();  
            jQuery('label[name=duedate]').hide();  
            jQuery('input[name=duedate]').hide(); 
        jQuery('textarea[name=other_remark]').hide();  
            jQuery('textarea[name=other_remark1]').hide();  
            jQuery('div[name=other_remark]').hide(); 
            jQuery('div[name=other_remark1]').hide();
            jQuery('label[name=other_remark]').hide();
            jQuery('label[name=other_remark1]').hide();    
            jQuery('div[name=remark]').hide();  
            jQuery('textarea[name=remark]').hide();  
            jQuery('div[name=remark]').hide(); 
            jQuery('input[name=file_attachment]').hide(); 
            jQuery('label[name=file_attachment]').hide(); 
            jQuery('div[name=file_attachment]').hide(); 

    }
    jQuery("#status").change(function() {
        
        if (jQuery(this).val() === 'Close'){ 
            // jQuery('textarea[name=other_remark]').show(); 
             
            jQuery('textarea[name=other_remark]').show();  
            jQuery('textarea[name=other_remark1]').show();  
            jQuery('div[name=other_remark]').show(); 
            jQuery('div[name=other_remark1]').show();
            jQuery('label[name=other_remark]').show();
            jQuery('label[name=other_remark1]').show();    
            jQuery('input[name=file_attachment]').show(); 
            jQuery('label[name=file_attachment]').show(); 
            jQuery('div[name=file_attachment]').show(); 
            jQuery('div[name=remark]').hide();  
            jQuery('textarea[name=remark]').hide();  
            jQuery('div[name=remark]').hide(); 
            jQuery('div[name=concern]').hide();  
            jQuery('label[name=concern]').hide();  
            jQuery('input[name=concern]').hide(); 
            jQuery('div[name=duedate]').hide();  
            jQuery('label[name=duedate]').hide();  
            jQuery('input[name=duedate]').hide(); 
                        

        } else if (jQuery(this).val() === 'Open'){
            
            jQuery('div[name=concern]').show();  
            jQuery('label[name=concern]').show();  
            jQuery('input[name=concern]').show(); 
            jQuery('div[name=duedate]').show();  
            jQuery('label[name=duedate]').show();  
            jQuery('input[name=duedate]').show(); 
            jQuery('textarea[name=other_remark]').hide();  
            jQuery('textarea[name=other_remark1]').hide();  
            jQuery('div[name=other_remark]').hide(); 
            jQuery('div[name=other_remark1]').hide();
            jQuery('label[name=other_remark]').hide();
            jQuery('label[name=other_remark1]').hide();    
            jQuery('input[name=file_attachment]').show(); 
            jQuery('label[name=file_attachment]').show(); 
            jQuery('div[name=file_attachment]').show(); 
            jQuery('div[name=remark]').hide();  
            jQuery('textarea[name=remark]').hide();  
            jQuery('div[name=remark]').hide(); 

        }else if (jQuery(this).val() === 'WIP'){
            
            jQuery('div[name=concern]').hide();  
            jQuery('label[name=concern]').hide();  
            jQuery('input[name=concern]').hide(); 
            jQuery('div[name=duedate]').hide();  
            jQuery('label[name=duedate]').hide();  
            jQuery('input[name=duedate]').hide(); 
            jQuery('textarea[name=other_remark]').hide();  
            jQuery('textarea[name=other_remark1]').hide();  
            jQuery('div[name=other_remark]').hide(); 
            jQuery('div[name=other_remark1]').hide();
            jQuery('label[name=other_remark]').hide();
            jQuery('label[name=other_remark1]').hide();    
            jQuery('input[name=file_attachment]').hide(); 
            jQuery('label[name=file_attachment]').hide(); 
            jQuery('div[name=file_attachment]').hide(); 
            jQuery('div[name=remark]').show();  
            jQuery('textarea[name=remark]').show();  
            jQuery('div[name=remark]').show(); 

        }  
        
        else {
            // jQuery('textarea[name=other_remark]').hide();  
            jQuery('textarea[name=other_remark]').show();  
            jQuery('textarea[name=other_remark1]').hide();  
            jQuery('div[name=other_remark]').hide(); 
            jQuery('div[name=other_remark1]').hide();
            jQuery('label[name=other_remark]').hide();
            jQuery('label[name=other_remark1]').hide();  
            jQuery('input[name=file_attachment]').hide(); 
            jQuery('label[name=file_attachment]').hide(); 
            jQuery('div[name=file_attachment]').hide(); 
            jQuery('div[name=remark]').hide();  
            jQuery('textarea[name=remark]').hide();  
            jQuery('div[name=remark]').hide(); 
        }
    });
});
</script>

<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box">

                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Change Status</h5>                                   
                    </div>  
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data">


                    <div class="row">


                        <div class="col-sm-3">
                            <div class="form-group"><label for="">Change Status</label>
                                <select id='status' name="status" class="form-control" >
                                    <option value='select' selected >--Select--</option>
                                    <?php  if ($_SESSION['User_type']=='employee')
                                    {?>
                                        <!-- <option value="Open">Open</option> -->
                                        <option value="WIP">WIP</option>
                                        <option value="Close">Close</option>  
                                        <option value="Cancel">Cancel</option>
                                        
                                    <?php } else {?>
                                        <option value="Open">Open</option>
                                    <option value="WIP">WIP</option>
                                    <option value="Close">Close</option>  
                                    <option value="Cancel">Cancel</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3" name='remark'>
                            <div class="form-group" name='remark'><label for="" name='remark'>Remark</label>
                                <textarea  name="remark" class="form-control" placeholder="Remark"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3" name ='other_remark'>
                            <div class="form-group" name='other_remark'><label for="" name='other_remark'>Achievements</label>
                                <textarea  name="other_remark" class="form-control" placeholder="Achievements"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3" name='other_remark1'>
                            <div class="form-group" name='other_remark1'><label for="" name='other_remark1'>Benefits</label>
                                <textarea  name="other_remark1" class="form-control" placeholder="Benefits"></textarea>
                            </div>
                        </div>
                        
                        <div class="col-sm-3" name='concern'>
                            <div class="form-group" name='concern'><label for="" name='concern'>Do Next</label>
                                <textarea class="form-control " rows="1" name="Concern" placeholder="Enter Do Next" name='concern' ></textarea>
                            </div>
                        </div>

                        <div class="col-sm-3" name='duedate'>
                            <div class="form-group"  name='duedate'><label for=""  name='duedate'>Due Date </label>  
                                <input class="form-control" id="from-datepicker" name="duedate" placeholder="" type="datetime-local"  name='due date'>                                      
                            </div>
                        </div>
                        <div class="col-sm-3" name='file_attachment'>
                                    <div class="form-group" name='file_attachment'><label for=""name ='file_attachment'>File Attachment</label>
                                        <input name="file_attachment[]" type="file" multiple>
                                    </div>
                                </div>
                            <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
                            <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css"> -->
                            
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Change Status" name="submit">
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

