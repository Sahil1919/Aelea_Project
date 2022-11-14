<?php
include './includes/data_base_save_update.php';
include './includes/db.php';
$qry = mysqli_query($connection, "SELECT * FROM assign_task order by work_assign_date desc") or die("select query fail" . mysqli_error());
$count = 0;
date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y g:i:s A');
echo $date;
echo "<br>"; 

while ($row = mysqli_fetch_assoc($qry)) {
    $count = $count + 1;
    $work_due_date = strtotime($row['work_due_date']);
            $work_due_date = date( 'd-m-y g:i:s A', $work_due_date );



    if ($work_due_date>=$date){
        echo $date;
echo "<br>"; 
        echo $work_due_date;
        echo '<br>';
        echo "DUE";
        echo "<br>";
    }
    else{
        echo $date;
        echo "<br>"; 
        echo $work_due_date;
        echo "<br>";
        echo "Overdue";
        echo "<br>";
    }
}
?>
<?php

// echo "<br>";
// $arrlength = count($work_assign_date);

// for($x = 0; $x < $arrlength; $x++) {
//   echo $work_assign_date[$x];
//   echo "<br>";
// }
?>