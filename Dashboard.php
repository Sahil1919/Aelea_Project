<?php
session_start();

include './includes/admin_header.php';
include './includes/data_base_save_update.php';
//include 'includes/App_Code.php';
include './includes/App_Code.php';
$AppCodeObj=new App_Code();

// found work
$msg = '';
$Genrate = new App_Code();
$appC0de = new databaseSave();
if (isset($_GET['UserID']) && isset($_GET['Status'])) {

    $userID = $_GET['UserID'];
    $Inactive = $_GET['Status'];
    $msg = $Inactive;
    if ($Inactive == '1') {

        $query = "UPDATE `user_details` SET `Inactive`='0' WHERE User_ID='$userID'";
        $Active_User = mysqli_query($connection, $query);
        if (!$Active_User) {
            die('QUERY FAILD' . mysqli_error($connection));
        }
    } else if ($Inactive == '0') {
        //   echo $Inactive;
        $query = "UPDATE `user_details` SET `Inactive`='1' WHERE User_ID='$userID'";
        $deactive_User = mysqli_query($connection, $query);
        if (!$deactive_User) {
            die('QUERY FAILD' . mysqli_error($connection));
        }
    }
    //  header("location:./admin/retailer_account_list.php");
    
}
?>
<!--------------------
START - Breadcrumbs
-------------------->

<ul class="breadcrumb">
<div class="scrollmenu">
    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
    <td>
    
    <?php 
    
     if (strtolower($_SESSION['User_type'])=='employee')
    { ?>

        <li class="breadcrumb-item"><span>Dashboard</span></li>
        <li class="breadcrumb-item"><a href="work_dash.php?source=emp_a&b_dash"><span>Achievement & benefits</a></span></li>
        <li class="breadcrumb-item"><a href="work_dash.php?source=emp_concern_dash"><span>Concerns</span></a></li>

     <?php } else  
     {?>
        
        <li class="breadcrumb-item"><span>Dashboard</span></li>
        <li class="breadcrumb-item"><a id='donext' href="work_dash.php?source=admin_donext_dash"><span>Do Next</span></a></li>
        <li class="breadcrumb-item"><a href="work_dash.php?source=admin_a&b_dash"><span>Achievement & benefits</a></span></li>
        <li class="breadcrumb-item"><a href="work_dash.php?source=admin_concern_dash"><span>Concerns</span></a></li>
     <?php } ?>
    
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        
        <?php 
        // echo $_SESSION['User_type'];         
        if($_SESSION['User_type']=='admin')
        {       
                // echo $_SERVER['DOCUMENT_ROOT'];
               include './includes/admin_dashboard.php';  
               //include './includes/admin_dashboard_donext_dash.php';  
        } 
        elseif($_SESSION['User_type']=='management' || $_SESSION['User_type']=='reporting manager'){
            include './includes/man_dashboard.php';
        }
 else {
       include './includes/emp_dashboard.php';   
 }
      
        
        ?>
      
    </div>
       


    </div>


<?php  include './includes/Plugin.php'; ?>
  
</div>


<?php include 'includes/admin_footer.php'; ?>
        
       
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
</script> -->