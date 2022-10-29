<?php include 'includes/db.php';


session_start();
$chck_Active_User = '';
if (isset($_POST['login'])) {
    $uemail = mysqli_real_escape_string($connection, $_POST['User_nm']);
    $pass = mysqli_real_escape_string($connection, $_POST['Paswd']);
    $sql = "select * from emp_login where user_id = '$uemail' and pswd = '$pass'";
    $q = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($q);
    $count = mysqli_num_rows($q);

    if ($count > 0) {
        $_SESSION['user'] = $row['id'];
        $_SESSION['emp_name'] = $row['emp_name'];
        $_SESSION['emp_pro'] = $row['emp_pro'];
        $_SESSION['User_type'] = $row['user_role'];
        //$_SESSION['User_type']=$row['user_role'];
        //$_SESSION['User_type']=$row['user_role'];


        $chck_Active_User = $row['status'];
        if ($chck_Active_User == '0') {
            echo "<script>alert('your account is currently deactivated. please contact customer care +918305453647');  window.location.href='../login.php';</script>";
        } else {
            echo "<script>alert ('Login Successfull');
       window.location.href='dashboard.php';
       </script>";
        }
    } else { ?>
        <script>
            alert('Failed to login');
            window.location.href = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login & Signup Form | CodingNepal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Login and Signup Form Design\style.css">
  </head>
  <body>
    <div class="wrapper">
      <center><img src="Login and Signup Form Design\logo.jpg" alt="" width="90" height="80"></center>
      <div class="title-text">
        <div class="title login">Aelea Commodities</div>
        <div class="title signup">Aelea Commodities </div>
      </div>
      <div class="form-container">
        <!-- <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div> -->
        <div class="form-inner">
          <form action="#" class="login" method="post">
            <div class="field">
              <input name = "User_nm" type="text" placeholder="Email Address" type="text" required>
            </div>
            <div class="field">
              <input name = "Paswd" type="password" placeholder="Password" type="password" required>
            </div>
            <!--<div class="pass-link"><a href="#">Forgot password?</a></div>-->
            <div class="field btn">
              <div class="btn-layer"></div>
              <input name="login" type="submit" value="Login" class="btn btn-primary">
              
            </div>
            <!-- <div class="signup-link">Not a member? <a href="">Signup now</a></div> -->
          </form>
          <!-- <form action="#" class="signup">
            <div class="field">
              <input type="text" placeholder="Email Address" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Confirm password" required>
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Signup">
            </div>
          </form> -->
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
