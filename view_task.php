
<?php
include './includes/admin_header.php';
include './includes/data_base_save_update.php';
//include 'includes/App_Code.php';
include 'includes/App_Code.php';
$AppCodeObj=new App_Code();

// found work

?>
<!--------------------
START - Breadcrumbs
-------------------->
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="employee.php">Back</a></li>
    <li class="breadcrumb-item"><span>Employee Dashboard</span></li>
</ul>
<!--------------------
END - Breadcrumbs
-------------------->
<div class="content-panel-toggler"><i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span></div>
<div class="content-i">
    <div class="content-box">
        <?php         
            include './includes/emp_dashboard_view.php';          
        ?>
      
    </div>
       


    </div>


<?php include './includes/Plugin.php'; ?>
  
</div>


<?php include './includes/admin_footer.php'; ?>
        
        <script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdfHtml5'
        ]
    } );
} );
        </script>