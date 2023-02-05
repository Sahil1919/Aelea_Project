<?php
include './includes/db.php';
// $sess_report_to = $_SESSION['user'];
// if ($_SESSION['User_type'] == 'reporting manager'){
    
//     $qry = mysqli_query($connection, "SELECT * FROM approval_list where approval_status = 'Pending' and report_to = '$sess_report_to' ") or die("select query fail" . mysqli_error());
//     $count = mysqli_num_rows($qry);
// }
// elseif ($_SESSION['User_type'] == 'reporting manager'){

// }
// else{
$qry = mysqli_query($connection, "SELECT * FROM approval_list where approval_status = 'Pending' ") or die("select query fail" . mysqli_error());
$count = mysqli_num_rows($qry);
// }
// $count = $row['total'];
if ($count!=0){
  echo $count;
}
else{
  echo "";
}

?>