<?php
session_start();
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
    $query = "INSERT INTO `emp_login`(`emp_code`, `emp_name`, `user_id`, `pswd`, `status`, `created`, `user_role`, `emp_pro`, `email_id`, `emp_mob`) VALUES ('$emp_code','$Name','$userid','$pswd','1',now(),'employee','$post_image','$emailid','$mobile')";
    //  $update_psqd = "UPDATE `user_details` SET Pswd='$NewPSWD' where  `User_ID`='$userID' and Pswd='$oldPSWD'  ";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } else {

        echo "<script>alert('record saved successfully');</script>";
        // return 'pass';
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
    $emp_id=$_GET['emp_id'];
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
        $query .= "`user_id`='$userid',";
        $query .="`pswd`='$pswd',";
        // $query .= "`status`='',";
      //  $query .= "`created`='',";
       //$query .= "`user_role`='',";
        $query .= "`emp_pro`='$post_image',";
        $query .= "`email_id`='$emailid',";
        $query .= "`emp_mob`='$mobile' WHERE `id`='$emp_id'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD Update' . mysqli_error($connection));
    } else {

        echo "<script>alert('record update successfully');</script>";
        // return 'pass';
    }
}
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $query="delete from emp_login where id='$id'";
     $delete_data = mysqli_query($connection, $query);
      if (!$delete_data) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
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
    <li class="breadcrumb-item"><a href=<?php echo "Dashboard.php?user=".$_SESSION['user']?>>Home</a></li>
    <li class="breadcrumb-item"><span>Employee</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<!-- <div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i"> -->
    <div class="element-box">
        
        <table id="example" style="width: 100%;" class="display table table-bordered table-responsive" style="width:100%">
        <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Emp Code</th>
                        <th>Name</th>
                        <th>Role Type</th>
                        <th>Reporting To</th>
                         <th>Mobile No</th>
                          <th>Email ID</th>
                           <!-- <th>User ID</th> -->
                            <!-- <th>PSWD</th> -->
                             <th>Profile</th>
                              <th>Date</th>
                              <th>Status</th>
                               <th>Edit</th>
                          <th>Delete</th>
                    </tr>
            </thead> 
            <tbody>

    <?php

if ($_SESSION['User_type']=='reporting manager'){
    $sess_report_id = $_SESSION['user'];
$qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee') and status = '0' and report_to= '$sess_report_id'  ") or die("select query fail" .$connection->mysqli_error());
}
else{
    $qry = mysqli_query($connection, "SELECT * FROM emp_login where status='0' and  `user_role` IN ('employee', 'management','reporting manager','admin')") or die("select query fail" .$connection->mysqli_error());
}
$count = 0;
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $id = $row['id'];
            $emp_code = $row['emp_code'];
            $emp_name = $row['emp_name'];
            $user_id = $row['user_id'];
            $pswd = $row['pswd'];
            $status = $row['status'];
            $created = $row['created'];
            $user_role = ucfirst($row['user_role']);
            $report_id = $row['report_to'];
             
            if (strlen($report_id) != 0) 
            {
              $qry1 = mysqli_query($connection, "SELECT emp_code,emp_name FROM emp_login where id = '$report_id' ") or die("select query fail" .$connection->mysqli_error());
              while ($report_row = mysqli_fetch_assoc($qry1))
              {
                $report_code = $report_row['emp_code'];
                $report_name = $report_row['emp_name'];
              }         
            }
            else{
              $report_code = "";
              $report_name = "";
            }

            $emp_pro = $row['emp_pro'];
            $email_id = $row['email_id'];
            $emp_mob = $row['emp_mob'];
                                                                             $status = '';
    $btnClass = '';
    if ($row['status'] == '1') {
        $btnClass = "btn  btn-success btn-sm";
        $status = "Active";
    } else {
        $status = "Deactive";
        $btnClass = "btn btn-danger btn-sm";
    }
    ?>
                    <tr>
  <td><?php echo $count;?></td>
  <td><?php echo $emp_code;?></td>
  <td><?php echo $emp_name;?></td>
  <td><?php echo $user_role;?></td> 
  <td><?php if (strlen($report_id) != 0) echo $report_code."/".$report_name; else echo $report_code.$report_name;?></td> 
  <td><?php echo $emp_mob;?></td> 
  <td><?php echo $email_id;?></td> 
  
    <!-- <td><?php echo $user_id;?></td>  -->
  <!-- <td><?php echo $pswd;?></td>  -->

    <!--<td><?php echo $emp_pro;?></td>--> 
    <td> <img src="user_profile/<?php echo $emp_pro;?>" height="80px" width="80px"></td> 
      <td><?php echo $created;?></td> 
      <td><a href="employee_active.php?id=<?php echo $row['id']; ?>&Status=<?php echo $row['status']; ?>" class="<?php echo $btnClass; ?> " ><?php echo $status; ?></a></td>
    <td><a class="btn btn-primary" href="employee.php?source=update_emp&emp_id=<?php echo $id;?>">Edit</a></td>
                              <td><a class="btn btn-danger" href="employee_active.php?delete=<?php echo $id;?>">Delete</a></td>
                    </tr>
<?php }?>
</tbody>    </table>
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