<?php 
include './includes/db.php';

$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

$url_components = parse_url($CurPageURL);

parse_str($url_components['query'], $params);


if ($params['search']!=''){

}
else{
    $id = $params['id'];
	echo $id;
    $qry = mysqli_query($connection, "SELECT * FROM pdf_views WHERE emp_id='$id' ") or die("select query fail" . mysqli_error());
    while ($row = mysqli_fetch_assoc($qry)) 
    {        
	

		$emp_name = $row['emp_name'];
        echo $emp_name;
    }
}
?>
