<?php
if (isset($_POST['submit'])) {
    $emp_id = $_SESSION['user'];
    $task_id = $_GET['task_id'];
    // $employee_id =$emp_id; 
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $achievement = $_POST['other_remark'];
    $benefit = $_POST['other_remark1'];
    // $attachment = $_POST['file_attachment'];
    $attachment = $_FILES['file_attachment']['name'];
    echo $attachment;
    $attachment_temp = [$_FILES['file_attachment']['tmp_name']];
    echo $attachment_temp;
    move_uploaded_file($attachment_temp, "task_doc/$attachment");
}
?>
<div class="col-sm-3" name='file_attachment'>
                                    <div class="form-group" name='file_attachment'><label for=""name ='file_attachment'>File Attachment</label>
                                        <input name="file_attachment" type="file" multiple>
                                    </div>
                                </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Change Status" name="submit">
                                <!--<label for="">Conform Password</label>-->
                                <!--<input class="form-control" name="CPSWD" placeholder="Conform Password" type="password">-->
                            </div>
                        </div>