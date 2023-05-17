<?php
$db['db_host']="localhost";
$db['db_user']="root";
$db['db_pass']="";
$db['db_name']="task_management";
// $db['db_host']="localhost";
// $db['db_user']="aeleacommodities_rahilm";
// $db['db_pass']="i8DyK^JLR_gG";
// $db['db_name']="aeleacommodities_tasksM";
foreach($db as $key => $value)
{
    define(strtoupper($key),$value);
}
//$connection =mysqli_connect('localhost','root','','global_touch');
global $connection;
$connection =mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
//    if($connection)
//    {
//        echo "we are connected";
//    }
?>