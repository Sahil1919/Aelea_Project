<?php
                                // include 'db.php';
                                $sess_report_to = $_SESSION['user'];
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
                                // $count = $row['total'];
                                // echo $count;
                                ?>
                <!--------------------
                START - Main Menu
                -------------------->
                <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
                    <div class="logo-w">
                        <a class="logo" href="#">
                        <div><img src="Login and Signup Form Design\logo.jpg" alt="" width="90" height="80"></div>
                            <div class="logo-label">Aelea Commodities</div>
                        </a>
                    </div>                    
                    
                        
                    <div class="logged-user-w avatar-inline">
                        <div class="logged-user-i">
                            <div class="avatar-w"><img alt="" src="user_profile/<?php echo $_SESSION['emp_pro'];?>"></div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name"><?php echo $_SESSION['emp_name'];?></div>
                                <div class="logged-user-role"><?php echo $_SESSION['User_type'];?></div>
                            </div>
                            <div class="logged-user-toggler-arrow">
                                <div class="os-icon os-icon-chevron-down"></div>
                            </div>
                            <div class="logged-user-menu color-style-bright">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w"><img alt="" src="user_profile/<?php echo $_SESSION['emp_pro'];?>"></div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name"><?php echo $_SESSION['emp_name'];?></div>
                                <div class="logged-user-role"><?php echo $_SESSION['User_type'];?></div>
                                    </div>
                                </div>
                                <div class="bg-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <ul>
                                    <?php if ($_SESSION['User_type']=='employee' || $_SESSION['User_type']=='reporting manager'){?>
                                   <li><a href="update_profile_for_emp.php"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a></li>
                                   <?php } else {?>
                                   <li><a href="update_emp_profile.php"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a></li>
                                   <?php }?> 
                                   <li><a href="change_password.php"><i class="os-icon os-icon-others-43"></i><span>Change Password</span></a></li>
                                    <li><a href="logout.php"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Main code -->
                    <h1 class="menu-page-header">Page Header</h1>
                    <?php if ($_SESSION['User_type']=="admin" || $_SESSION['User_type']=="management" )
                    {
                        
                    ?>
                           <ul class="main-menu" style="height: 840px;">

                        <li class="">
                            <a href="Dashboard.php">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layout"></div>
                                </div><span>Dashboard</span></a>

                        </li>
                        
                        <li class="sub-header"><span>User Manager</span></li>
                        <h1><div class="mt-4"></h1>
                        <li class=" has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-users"></div>
                                </div><span>Employee User</span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-header">Employee User</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-users"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li><a href="employee.php?source=add_emp">Create Employee Account</a></li>
                                        <li><a href="employee.php">Employee Account List</a></li>
                                        <li><a href="employee_active.php">Employee Account Activate</a></li>
                                        <li><a href="employee_deactive.php">Deactivate Employee Account</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="sub-header"><span>Task Management</span></li>
                        <h1><div class="mt-4"></h1>
                         <li class=" has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-pencil-12"></div>
                                </div><span>Do Next </span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-header">Do Next Management</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li><a href="assign_task.php">Assign Do Next</a></li>
                                        <li><a href="assign_task_list.php">Do Next List</a></li>  
                                        <li><a href="assign_task_open_list.php">Open Do Next</a></li>  
                                        <li><a href="assign_task_list_close.php">Close Do Next</a></li>  
                                        <li><a href="assign_task_list_wip.php">WIP(Work In Process) Do Next</a></li>  
                                        <li><a href="assign_task_list_cancel.php">Cancel Do Next</a></li>  
                                    </ul>
                                </div>
                            </div>
                        </li>
                         <!-- A & B management  Start-->
                         <li class=" has-sub-menu">
                            <a href="admin_a&b_dash.php">
                                <div class="icon-w">                                    
                                    <div class="os-icon os-icon-check-circle"></div>                                    
                                </div><span>A & B </span></a>
                        </li>
                        <!-- A & B management END  -->
                        <!-- Concern management  Start-->
                        <li class=" has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-message-square"></div>
                                </div><span>Concern </span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-header">Concern Management</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li><a href="assign_concern.php">Raise Concern</a></li>
                                        <li><a href="assign_concern_list.php">Concern List</a></li>  
                                        <li><a href="assign_concern_open_list.php">Open Concern</a></li>  
                                        <li><a href="assign_concern_close_list.php">Close Concern</a></li>  
                                        <li><a href="assign_concern_list_wip.php">WIP(Work In Process) Concern</a></li>  
                                        <li><a href="assign_concern_list_cancel.php">Cancel Concern</a></li>  
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!--Approval Request-->
                        <li class=" has-sub-menu">
                            <a href="approval_list.php">
                                <div class="icon-w" id="icon">                                    
                                        <div class="messages-notifications os-dropdown-position-left" id='pos'>
                                            <i class="os-icon os-icon-mail-14" id="i"></i>
                                            <div class="new-messages-count" id='refresh_div'>
                                             
                                            </div>
                                        </div>                                  
                                </div>
                                <span>Approval List </span></a>
                            </a>
                           
                                
                        </li>
                        <!--Approval Request END  -->

                    </ul>
                    
                        <?php 
                    }

            elseif ($_SESSION['User_type']=="reporting manager") {
                        
                ?>
                       <ul class="main-menu" style="height: 840px;">
,
                    <li class="">
                        <a href="Dashboard.php">
                            <div class="icon-w">
                                <div class="os-icon os-icon-layout"></div>
                            </div><span>Dashboard</span></a>

                    </li>
                    
                    <!-- <li class="sub-header"><span>User Manager</span></li>
                    <h1><div class="mt-4"></h1> -->
                    <!-- <li class=" has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-users"></div>
                            </div><span>Employee User</span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Employee User</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-users"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="employee.php?source=add_emp">Create Employee Account</a></li>
                                    <li><a href="employee.php">Employee Account List</a></li>
                                    <li><a href="employee_active.php">Employee Account Activate</a></li>
                                    <li><a href="employee_deactive.php">Deactivate Employee Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </li> -->
                    <li class="sub-header"><span>Task Management</span></li>
                    <h1><div class="mt-4"></h1>
                     <li class=" has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-pencil-12"></div>
                            </div><span>Do Next </span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Do Next Management</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="assign_task.php">Assign Do Next</a></li>
                                    <li><a href="assign_task_list.php">Do Next List</a></li>  
                                    <li><a href="assign_task_open_list.php">Open Do Next</a></li>  
                                    <li><a href="assign_task_list_close.php">Close Do Next</a></li>  
                                    <li><a href="assign_task_list_wip.php">WIP(Work In Process) Do Next</a></li>  
                                    <li><a href="assign_task_list_cancel.php">Cancel Do Next</a></li>  
                                </ul>
                            </div>
                        </div>
                    </li>
                     <!-- A & B management  Start-->
                     <li class=" has-sub-menu">
                        <a href="admin_a&b_dash.php">
                            <div class="icon-w">                                    
                                <div class="os-icon os-icon-check-circle"></div>                                    
                            </div><span>A & B </span></a>
                    </li>
                    <!-- A & B management END  -->
                    <!-- Concern management  Start-->
                    <li class=" has-sub-menu">
                        <a href="#">
                            <div class="icon-w">
                                <div class="os-icon os-icon-message-square"></div>
                            </div><span>Concern </span></a>
                        <div class="sub-menu-w">
                            <div class="sub-menu-header">Concern Management</div>
                            <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                            <div class="sub-menu-i">
                                <ul class="sub-menu">
                                    <li><a href="assign_concern.php">Raise Concern</a></li>
                                    <li><a href="assign_concern_list.php">Concern List</a></li>  
                                    <li><a href="assign_concern_open_list.php">Open Concern</a></li>  
                                    <li><a href="assign_concern_close_list.php">Close Concern</a></li>  
                                    <li><a href="assign_concern_list_wip.php">WIP(Work In Process) Concern</a></li>  
                                    <li><a href="assign_concern_list_cancel.php">Cancel Concern</a></li>  
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!--Approval Request-->
                    <li class=" has-sub-menu">
                            <a href="approval_list.php">
                                <div class="icon-w" id="icon">                                    
                                        <div class="messages-notifications os-dropdown-position-left" id='pos'>
                                            <i class="os-icon os-icon-mail-14" id="i"></i>
                                            <div class="new-messages-count" id='refresh_div'>
                                             
                                            </div>
                                        </div>                                  
                                </div>
                                <span>Approval List </span></a>
                            </a>
                           
                                
                        </li>
                    <!--Approval Request END  -->

                </ul>
                
                    <?php 
                }
 else {?>
                           <ul class="main-menu" style="height: 840px;">
                        <li class="">
                            <a href="Dashboard.php">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-layout"></div>
                                </div><span>Dashboard</span></a>

                        <h1><div class="mt-4"></h1>
                        <li class="sub-header"><span>Task Management</span></li>
                        <h1><div class="mt-4"></h1>
                         <li class=" has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-pencil-12"></div>
                                </div><span>Do Next </span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-header">Do Next Management</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li><a href="emp_assign_task.php">Assign Do Next</a></li> 
                                        <li><a href="emp_assign_task_list.php">Do Next List</a></li>  
                                        <li><a href="emp_assign_task_list_open.php">Open Do Next</a></li>  
                                        <li><a href="emp_assign_task_list_close.php">Close Do Next</a></li>  
                                        <li><a href="emp_assign_task_list_wip.php">WIP(Work In Process) Do Next</a></li>  
                                        <li><a href="emp_assign_task_list_cancel.php">Cancel Do Next</a></li>  
                                    </ul>
                                </div>
                            </div>
                        </li>
                         <!-- A & B management  Start-->
                         <li class=" has-sub-menu">
                            <a href="emp_a&b_dash.php">
                                <div class="icon-w">                                    
                                    <div class="os-icon os-icon-check-circle"></div>                                    
                                </div><span>A & B </span></a>
                        </li>
                        <!-- A & B management END  -->
                        <!-- Concern management  Start-->
                        <li class=" has-sub-menu">
                            <a href="#">
                                <div class="icon-w">
                                    <div class="os-icon os-icon-message-square"></div>
                                </div><span>Concern </span></a>
                            <div class="sub-menu-w">
                                <div class="sub-menu-header">Concern Management</div>
                                <div class="sub-menu-icon"><i class="os-icon os-icon-wallet-loaded"></i></div>
                                <div class="sub-menu-i">
                                    <ul class="sub-menu">
                                        <li><a href="emp_assign_concern.php">Raise Concern</a></li>
                                        <li><a href="emp_assign_concern_list.php">Total Concern List</a></li>  
                                        <li><a href="emp_assign_concern_list_open.php">Open Concern</a></li>  
                                        <li><a href="emp_assign_concern_list_close.php">Close Concern</a></li>  
                                        <li><a href="emp_assign_concern_list_wip.php">WIP(Work In Process) Concern</a></li>  
                                        <li><a href="emp_assign_concern_list_cancel.php">Cancel Concern</a></li>  
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!--Approval Request-->
                    <li class=" has-sub-menu">
                        <a href="approval_list_status.php">
                            <div class="icon-w">
                                    <div class="messages-left">
                                        <i class="os-icon os-icon-mail-14"></i>
                                        <div class="new-messages-count">
                                            
                                        </div>
                                    </div>
                                    
                            </div>
                            <span>Approval List </span></a>
                        </a>
                       
                            
                    </li>
                    </ul>
                    <?php     
 }
?>
             

                </div>
                <!--------------------
                END - Main Menu
                -------------------->



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
        }
   }
    var res = setInterval(newPost, 500);
    
 });
</script>
