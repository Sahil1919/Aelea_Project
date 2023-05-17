<?php
if ($_SESSION['user'] && $_SESSION['user']!= ''){

}
else{
    echo "<script> window.location.href= 'index.php' </script>";
}
?>