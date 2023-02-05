<div id="newpost"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
 $(function() {
  function newPost() {
      $("#newpost").empty().load("test.php");
   }
    var res = setInterval(newPost, 5000);
 });
</script>