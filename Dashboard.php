
<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
//include 'includes/App_Code.php';
include 'includes/App_Code.php';
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
    <?php if ($_SESSION['User_type']=='employee')
    {?>
        <li class="breadcrumb-item"><span>Dashboard</span></li>
        <li class="breadcrumb-item"><a href="emp_a&b_dash.php"><span>Achievement & benefits</a></span></li>
        <li class="breadcrumb-item"><a href="emp_concern_dash.php"><span>Concerns</span></a></li>

     <?php } else {?>
        <li class="breadcrumb-item"><span>Dashboard</span></li>
        <li class="breadcrumb-item"><a id='donext' href="admin_donext_dash.php" ><span>Do Next</span></a></li>
        <li class="breadcrumb-item"><a href="admin_a&b_dash.php"><span>Achievement & benefits</a></span></li>
        <li class="breadcrumb-item"><a href="admin_concern_dash.php"><span>Concerns</span></a></li>
     <?php } ?>
    
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
                          <!-- <marquee direction="left" style="background: #0a7cf8;" onmouseover="this.stop();" onmouseout="this.start();">
<span class="breadcrumb-item">
       <?php
                                            $qry = mysqli_query($connection, "SELECT * FROM news_and_update where news_type='alert' order by created desc") or die("select query fail" . mysqli_error());
                                            //  $stateData = $AppCodeObj->select_state();
                                            while ($row = mysqli_fetch_assoc($qry)) {
                                                $news_title = $row['news_title'];
                                                ?>
    
    <a href="#" style="color:#fff;font-size: 18px;"><?php echo $news_title;?>&nbsp; <strong>|</strong> </a>
                                            <?php }?>
</span>
        
         
                  </marquee> -->
        <?php
        // echo $_SESSION['User_type'];         
        if($_SESSION['User_type']=='admin')
        {
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


<?php include './includes/Plugin.php'; ?>
  
</div>


<?php include './includes/admin_footer.php'; ?>
        
       
<script>

var user_type = <?php echo(json_encode($_SESSION['User_type'])); ?>;
$('#donext').on('click', function() {
    
    })
</script>   