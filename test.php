<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<input id="someInput">
<a style="width: 100%;" href="">Share Concern</a>


<script>

$(document).ready(function() {

//your code for construct the table 
var table = $('#example').DataTable();//change this to be equal to the id of your table

$('#example').on( 'click', 'button', function () { //change this to be equal to the id of your table
var index = table.row( this ).index();
console.log(index);
var data_row = table.row( $(this).parents('tr') ).data();
console.log(data_row[0]);
alert('Name: ' + data_row[0] + "\n" + 'Age: ' + data_row[1]);
$.ajax( { 
        type : 'POST',
        data : {'data0': data_row[0], 'data1': data_row[1] },
        url  : 'wrap.php',            
        success: function ( data ) {
          alert( data );              
        },
        error: function ( xhr ) {
          alert( "error" );
        }
      });
} );
});


</script>