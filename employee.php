<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    //  $msg = $AppCodeObj->Insert_pan_data("pan_mst");
//    $temp = explode(".", $_FILES["profile"]["name"]);
//    $user_pro = round(gen_image_code_unique()) . '.' . end($temp);
//    move_uploaded_file($_FILES["profile"]["tmp_name"], "user_profile/" . $user_pro);

      $post_image = $_FILES['profile']['name'];
    $post_image_temp = $_FILES['profile']['tmp_name'];
    move_uploaded_file($post_image_temp, "user_profile/$post_image");
    $emp_code = $_POST['emp_code'];
    $Name = $_POST['Name'];
    $emailid = $_POST['emailid'];
    $mobile = $_POST['mobile'];
    //$profile = $_POST['profile'];
    $userid = $_POST['userid'];
    $pswd = $_POST['pswd'];
    $user_role = strtolower($_POST['usertype']);
    $report_to = strtolower($_POST['report_to']);
    // print($report_to);
    $qry = mysqli_query($connection, "SELECT emp_code FROM emp_login ") or die("select query fail" . mysqli_error());
    $flag = 0;
    while( $row = mysqli_fetch_assoc($qry)){
        if ($row['emp_code'] == $emp_code){
            echo "<script>alert('Employee Already Exist');</script>";
            $flag = 1 ;
            break;
        }
    }
    if ($flag !=1){
        $query = "INSERT INTO `emp_login`(`emp_code`, `emp_name`, `user_id`, `pswd`, `status`, `created`, `user_role`, `emp_pro`, `email_id`, `emp_mob`,`report_to`) VALUES ('$emp_code','$Name','$userid','$pswd','1',now(),'$user_role','$post_image','$emailid','$mobile','$report_to')";
        //  $update_psqd = "UPDATE `user_details` SET Pswd='$NewPSWD' where  `User_ID`='$userID' and Pswd='$oldPSWD'  ";
            $update_password = mysqli_query($connection, $query);
            if (!$update_password) {
                die('QUERY FAILD change pashword' . mysqli_error($connection));
            } else {
        
                echo "<script>alert('record saved successfully');</script>";
                // return 'pass';
            }
    }
   
        
    
}
if (isset($_GET['id']) && isset($_GET['Status'])) {
   
    $userID = $_GET['id'];
    $Inactive = $_GET['Status']; 
    $msg = $Inactive;
    if ($Inactive == '1') {
          
        $query = "UPDATE `emp_login` SET `status`='0' WHERE id='$userID'";
        $Active_User = mysqli_query($connection, $query);
         if(!$Active_User)
            {
                die('QUERY FAILD' . mysqli_error($connection));
            }
      
    } else if ($Inactive == '0'){
       //   echo $Inactive;
          $query = "UPDATE `emp_login` SET `status`='1' WHERE id='$userID'";
        $deactive_User = mysqli_query($connection, $query);
         if(!$deactive_User)
            {
                die('QUERY FAILD' . mysqli_error($connection));
            }
    }
  // header("location:./admin/retailer_account_list.php");
}
if (isset($_POST['update'])) {
    // var_dump($_POST['update']);
    $emp_id=$_GET['emp_id'];
      $post_image = $_FILES['profile']['name'];
    $post_image_temp = $_FILES['profile']['tmp_name'];
    move_uploaded_file($post_image_temp, "user_profile/$post_image");
    $emp_code = $_POST['emp_code'];
    $Name = $_POST['Name'];
    $emailid = $_POST['emailid'];
    $mobile = $_POST['mobile'];
    //$profile = $_POST['profile'];
    // $userid = $_POST['userid'];
    // $pswd = $_POST['pswd'];
    $emp_role = strtolower($_POST['usertype']);
    $emp_report_to = strtolower($_POST['report_to']);
       $query1 = "select * from emp_login where id=" . $emp_id . "";
        $select_userprofile_image1 = mysqli_query($connection, $query1);
        while ($row1 = mysqli_fetch_array($select_userprofile_image1)) {
            if (empty($post_image)) {
                $post_image = $row1['emp_pro'];
            }
        }
   // $query = "INSERT INTO `emp_login`(`emp_code`, `emp_name`, `user_id`, `pswd`, `status`, `created`, `user_role`, `emp_pro`, `email_id`, `emp_mob`) VALUES ('$emp_code','$Name','$userid','$pswd','1',now(),'employee','$post_image','$emailid','$mobile')";
 $query="UPDATE `emp_login` SET ";
        $query .= "`emp_code`='$emp_code',";
         $query .="`emp_name`='$Name',";
        // $query .= "`user_id`='$userid',";
        // $query .="`pswd`='$pswd',";
        // $query .= "`status`='',";
      //  $query .= "`created`='',";
       //$query .= "`user_role`='',";
        $query .= "`emp_pro`='$post_image',";
        $query .= "`email_id`='$emailid',";
        $query .= "`user_role`='$emp_role',";
        $query .= "`report_to`='$emp_report_to',";
        $query .= "`emp_mob`='$mobile' WHERE `id`='$emp_id'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD Update' . mysqli_error($connection));
    } 
    // else {

    //     echo "<script>alert('record update successfully');</script>";
    //     // return 'pass';
    // }
}
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query="delete from emp_login where id='$id'";
     $delete_data = mysqli_query($connection, $query);
      if (!$delete_data) {
        die('QUERY FAILD change password' . mysqli_error($connection));
    } else {
    }
    
}
if(isset($_GET['delete_task']))
{
    $task_id=$_GET['delete_task'];
    // echo $task_id;
    // $update="UPDATE  job1 SET name='$name',email='$email',phn='$number',sub='$sub' WHERE id='$id";
    $query="DELETE FROM `assign_task` WHERE task_id=$task_id";
    $delete_task = mysqli_query($connection, $query);
      if (!$delete_task) {
        die('QUERY FAILD change password' . mysqli_error($connection));
    } else {
    }
    
}

function gen_image_code_unique() {

    $today = date('YmdHi');
    $startDate = date('YmdHi', strtotime('-10 days'));
    $range = $today - $startDate;
    $rand = rand(0, $range);
    return ($startDate + $rand);
}
?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Employee</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <?php
            if (isset($_GET['source'])) {

                $source = $_GET['source'];
            } else {

                $source = '';
            }

            switch ($source) {

                case 'add_emp';
                    include "includes/add_emp.php";
                    break;

                case 'update_emp';
                    include "includes/edit_emp.php";
                    break;

                default:
                    include "includes/emp_list.php";
                    break;
            }
            ?>
            <!--            <div class="element-box">
            
                                        <div class="row">
                                             <div class="col-md-12">
                                                <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Add New Employee</h5>                                   
                                            </div>  
                                        </div>
                                              <form class="container" action="#" method="post" enctype="multipart/form-data">
            
            
                                        <div class="row">
            
                                      
                                            <fieldset class="col-md-12">
                                                <legend>Company Details
                                                    <hr></legend>
                                            </fieldset>
            
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Employee Code</label>
                                                    <input class="form-control" name="emp_code" placeholder="Employee Code" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Name</label>
                                                    <input class="form-control" name="Name" placeholder="Name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Email ID</label>
                                                    <input class="form-control" name="emailid" placeholder="Email ID" type="email">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Mobile No.</label>
                                                    <input class="form-control" name="mobile" placeholder="Mobile No." type="text">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Profile</label>
                                                    <input name="profile" type="file">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">User ID</label>
                                                    <input class="form-control" name="userid" placeholder="User ID" type="text">
                                                </div>
                                            </div>
            
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Password</label>
                                                    <input class="form-control" name="pswd" placeholder="password" type="password">
                                                </div>
                                            </div>
            
            
            
            
                                            <div class="form-buttons-w text-right">
                                                <input class="btn btn-primary" type="submit" value="Add Employee" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                        </div>-->

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


        </script> 