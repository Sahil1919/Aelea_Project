<?php
session_start();
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
include './includes/App_Code.php';
$app_code_obj=new App_Code();
$msg = '';
$AppCodeObj = new databaseSave();

?>

<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="Dashboard.php">Back</a></li>
    <!-- <li class="breadcrumb-item"><span>Assign Do Next List</span></li> -->
</ul>
<br>
<!--------------------
END - Breadcrumbs
-------------------->

<?php 
 include "./includes/emp_dashboard.php"
?>


<script>


$(document).ready(function() {
    $('#example').DataTable( {
        // dom: 'Blfrtip',
        "lengthMenu": [[25,50,100,500], [25,50,100,500]]
    } );
} );
$url = "generator.php?search=";
// $url = "testing.php?search=";
$('#download').on('click', function() {
    var value = $('.dataTables_filter input').val();
    console.log(value);
    if (value === undefined || value===""){
        window.location.href = $url;
    }
    else{
        // var value = $('.dataTables_filter input').val();
        window.location.href = $url+ value;
    }
    })

$(document).ready(function() {
    $('.datepicker').datepicker({
  weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
  showMonthsShort: true
});
} );
        </script> 
                              