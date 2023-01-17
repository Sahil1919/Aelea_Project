<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Html2Pdf.js Tutorial to Add Page breaks</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"></script>
</html>

<div id="element">
    <div>
      <h1>This is the first page inside PDF Document</h1>
    </div>
    <div class="html2pdf__page-break"></div>
    <div>
      <h1>This is the second page inside PDF Document</h1>
    </div>
  </div>
  <script>
  let element = document.getElementById('element')
  html2pdf(element)
</script>