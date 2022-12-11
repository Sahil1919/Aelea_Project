<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
$msg = '';
$AppCodeObj = new databaseSave();
if (isset($_POST['submit'])) {
    
    if ($_SESSION['User_type']=='admin' || $_SESSION['User_type']=='management' ){
        // $emp_id = $_SESSION['user'];
    $task_id = $_GET['task_id'];
    $achievement = $_POST['Achievements'];
    $benefit = $_POST['Benefits'];
    $query = "UPDATE `assign_task` SET ";
    $query .= "`Achievements`='$achievement',";
    $query .= "`Benefits`='$benefit' WHERE `task_id`='$task_id'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } 
    }

    $emp_id = $_SESSION['user'];
    $task_id = $_GET['task_id'];
    $achievement = $_POST['Achievements'];
    $benefit = $_POST['Benefits'];
    $query = "UPDATE `assign_task` SET ";

    $query .= "`Achievements`='$achievement',";
    $query .= "`Benefits`='$benefit' WHERE `task_id`='$task_id' and `emp_id`='$emp_id'";
    $update_password = mysqli_query($connection, $query);
    if (!$update_password) {
        die('QUERY FAILD change pashword' . mysqli_error($connection));
    } 
}

if(isset($_GET['task_id']))
{
    $task_id=$_GET['task_id'];
    
}
?>

<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
    <li class="breadcrumb-item"><span>Achievement & Benefits</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->

<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <div class="element-box">

                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Achievement & Benefits</h5>                                   
                    </div>  
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data">


                    <div class="row">
                <body>

                <div class="container mt-3">          
                <table class="table table-bordered">
                    <thead>
                    <tr>
                    <th><img src="achieve1.JPG" alt="" width="500"  height="110"></th>
                    <th><img src="ben.jpg" alt="" width="500"  height="110"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                                                            $emp_id=  $_SESSION['user'];
                 $qry = mysqli_query($connection, "SELECT `Achievements`,`Benefits`,attachments FROM assign_task where task_id=$task_id ") or die("select query fail" . mysqli_error());
                 $row = mysqli_fetch_assoc($qry);
                 $achievement = $row['Achievements'];
                 $benefit = $row['Benefits'];
                 $attachments = $row['attachments']

                   ?>
                 <tr>
                        <td><pre><?php echo $achievement?></pre></td>
                        <td><pre><?php echo $benefit?></pre></td>
                    
                    </tr>
                    
                    </tbody>
                </table>
                <div>  <a href="#" class="btn btn-warning" id='edit' name = 'edit'>Edit</a>
                <h5 id='jshow' style="color: blue;border-bottom: 1px solid blue;padding: 10px;" name='jshow'></h5>                                   

                <div id='jshow'>
                    <br id='jshow'>
                    <br id='jshow'>
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data" id='jshow'>

                    <div class="row" id='jshow'>
                    
                        <div class="col-sm-3" name='Achievements' id='jshow'>
                            <div class="form-group" name='Achievements' id='jshow'><label for="" name='Achievements' id='jshow'>Achievements</label>
                                <textarea id='jshow' rows='5' name="Achievements" class="form-control" placeholder="Achievements"><?php echo $achievement?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3" name ='Benefits'id='jshow'>
                            <div class="form-group" name='Benefits' id='jshow'><label for="" name='Benefits' id='jshow'>Benefits</label>
                                <textarea id='jshow' rows="5"  name="Benefits" class="form-control" placeholder="Benefits"><?php echo $benefit?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <br>
                                <input class="btn btn-primary" type="submit" value="Confirm Changes" name="submit">
                                <!--<label for="">Conform Password</label>-->
                                <!--<input class="form-control" name="CPSWD" placeholder="Conform Password" type="password">-->
                            </div>
                        </div>

                </div>
                
                </body>                                
      
                    <div class="col-md-12">
                        <div>
                            <br>
                        </div>
                        <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Attachments</h5>                                   
                    </div>  
                </div>
                <form class="container" action="#" method="post" enctype="multipart/form-data">


                    <div class="row">

                    <?php if($attachments !='')
                        {?>
                        <?php $docs = explode(",",$attachments);?>
                        <?php foreach($docs as $value) 
                            {?>
                            <?php  $value =  ltrim($value);?>                            
                            <div>
                                <br>
                                <?php echo $value;?>
                                <div>  <a href="attachment/<?php echo $value;?>" class="btn btn-primary">Download</a>                
                        <?php }?>
                        <?php }?>

                    </div>

                        <!--                                <div class="form-buttons-w text-right">
                                                            <input class="btn btn-primary" type="submit" value="Change Password" name="submit">
                                                        </div>-->
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

<script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">
    </script>


<script>
jQuery(document).ready(function() {

    jQuery('h5[name=jshow]').hide();  
    jQuery('label[id=jshow]').hide();
    jQuery('div[id=jshow]').hide();
    jQuery('form[id=jshow]').hide();
    jQuery('br[id=jshow]').hide();

    jQuery("#edit").click(function() {
        jQuery('h5[name=jshow]').show();  
        jQuery('label[id=jshow]').show();
        jQuery('div[id=jshow]').show();
        jQuery('form[id=jshow]').show();
        jQuery('br[id=jshow]').show();

    });
});
</script>


<?php include './includes/Plugin.php'; ?>
<?php include './includes/admin_footer.php'; ?>

