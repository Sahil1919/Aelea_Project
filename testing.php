<?php 
include './includes/db.php';

$qry = mysqli_query($connection, "SELECT * FROM emp_login where user_role IN ('employee','management','admin','reporting manager')") or die("select query fail" . mysqli_error());
$count = 0;
while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
  
    $id = $row['id'];
    // echo $id;
    $emp_code = $row['emp_code'];
            $emp_name = $row['emp_name'];
            $user_id = $row['user_id'];
            $pswd = $row['pswd'];
            $status = $row['status'];
            $created = $row['created'];
            $user_role = ucfirst($row['user_role']);
            echo $user_role;
            $report_id = $row['report_to'];
            echo $report_id;
            if (strlen($report_id) != 0) 
            {
              $qry = mysqli_query($connection, "SELECT emp_code,emp_name FROM emp_login where id = '$report_id' ") or die("select query fail" . mysqli_error());
              while ($report_row = mysqli_fetch_assoc($qry))
              {
                $report_code = $report_row['emp_code'];
                $report_name = $report_row['emp_name'];
              }         
            }
            else{
              $report_code = "";
              $report_name = "";
            }       
            // echo $report_name;
}
?>