<?php
session_start();
include './includes/admin_header.php';
include './includes/data_base_save_update.php';

?>

            <?php
            if (isset($_GET['source'])) {

                $source = $_GET['source'];
            } else {

                $source = '';
            }

            switch ($source) {

                case 'admin_donext_dash';               
                    include "admin_donext_dash.php";
                    break;

                case 'admin_concern_dash';
                    include "admin_concern_dash.php";
                    break;

                case 'admin_a&b_dash';
                    include "admin_a&b_dash.php";
                    break;

                case 'emp_concern_dash';
                    include "emp_concern_dash.php";
                    break;

                default:
                    if ($_SESSION['User_type']=='employee'){
                        include "emp_a&b_dash.php";
                    }
                    else{
                        include "admin_a&b_dash.php";
                    }
                    
                    break;
                    
                    
            }
            ?>
            <!--            <div class="element-box">
            
                                        <div class="row">
                                             <div class="col-md-12">
                                                <h5 style="color: blue;border-bottom: 1px solid blue;padding: 10px;">Add New Employee</h5>                                   
                                            </div>  
                                        </div>
                                              <form class="container" action="#" method="post" enctype="multipart/form-data">
            
            
                                        <div class="row">
            
                                      
                                            <fieldset class="col-md-12">
                                                <legend>Company Details
                                                    <hr></legend>
                                            </fieldset>
            
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Employee Code</label>
                                                    <input class="form-control" name="emp_code" placeholder="Employee Code" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Name</label>
                                                    <input class="form-control" name="Name" placeholder="Name" type="text">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label for="">Email ID</label>
                                                    <input class="form-control" name="emailid" placeholder="Email ID" type="email">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Mobile No.</label>
                                                    <input class="form-control" name="mobile" placeholder="Mobile No." type="text">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Profile</label>
                                                    <input name="profile" type="file">
                                                </div>
                                            </div>
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">User ID</label>
                                                    <input class="form-control" name="userid" placeholder="User ID" type="text">
                                                </div>
                                            </div>
            
             <div class="col-sm-3">
                                                <div class="form-group"><label for="">Password</label>
                                                    <input class="form-control" name="pswd" placeholder="password" type="password">
                                                </div>
                                            </div>
            
            
            
            
                                            <div class="form-buttons-w text-right">
                                                <input class="btn btn-primary" type="submit" value="Add Employee" name="submit">
                                            </div>
                                        </div>
                                    </form>
                                        </div>-->

        </div>
    </div>
</div>
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