
<div class='scrollmenu'>
<div class="row">
            <div class="col-sm-12">
                <div class="row">
                <div class="col-md-8">
                <div class="element-wrapper">
                    <div class="element-actions">
<?php 

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management','reporting manager','admin') ";
$Total_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Total_emp = mysqli_num_rows($result);
}

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management','reporting manager','admin') and status='1' ";
$Active_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Active_emp = mysqli_num_rows($result);
}

$retailer_account = "SELECT id FROM emp_login where user_role IN ('employee','management','reporting manager','admin') and status='0' ";
$Deactive_emp = 0;
if ($result = mysqli_query($connection, $retailer_account)) {
    $Deactive_emp = mysqli_num_rows($result);
}
if ($_SESSION['User_type'] == 'reporting manager'){
                                    
    $qry = mysqli_query($connection, "SELECT * FROM approval_list where approval_status = 'Pending' and report_to = '$sess_report_to' ") or die("select query fail" . mysqli_error());
    $count = mysqli_num_rows($qry);
}
elseif ($_SESSION['User_type'] == 'reporting manager'){

}
else{
$qry = mysqli_query($connection, "SELECT * FROM approval_list where approval_status = 'Pending' ") or die("select query fail" . mysqli_error());
$count = mysqli_num_rows($qry);
}
?>
                    </div>
                    <h6 class="element-header">Dashboard</h6>
                    <div class="element-content">
                        
                        <div class="row">
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee.php">
                                    <div class="label">Total Employee</div>
                                    <div class="value"><?php echo $Total_emp; ?></div>
 </a>
                            </div>
                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee_active.php">
                                    <div class="label">Active Employee</div>
                                    <div class="value"><?php echo $Active_emp; ?></div>
                                    <!--                                                    <div class="trending trending-down-basic"><span>9%</span><i class="os-icon os-icon-arrow-down"></i></div>-->
                                </a>
                            </div>

                            <div class="col-sm-4 col-xxxl-3">
                                <a class="element-box el-tablo" href="employee_deactive.php">
                                    <div class="label">Deactivate Employee</div>
                                    <div class="value"><?php echo $Deactive_emp; ?></div>
                                </a>
                            </div>                      
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
 $(function() {
  function newPost() {
        var count = "<?= $count ?>"
        if (count!=0){
      $("#refresh_div").empty().load("test.php");
        }
        else {
            $('#pos').addClass('messages-left').removeClass('messages-notifications os-dropdown-position-left');
            $('#refresh_div').remove()
            // $('#icon').append('<div class="messages-left"><i class="os-icon os-icon-mail-14"></i><div class="new-messages-count"></div></div>')
            // $("#i").remove()
        }
   }
    var res = setInterval(newPost, 500);
    
 });
</script>
