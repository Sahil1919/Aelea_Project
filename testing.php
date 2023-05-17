<?php
session_start();
// session_destroy();
?>
<p>
Hello visitor, you have seen this page <?php echo $_SESSION['user']; echo $_SESSION['emp_name']; echo $_SESSION['emp_profile_']; echo $_SESSION['emp_User_type']; ?> times.
</p>