<?php include("./include/headerprofil.php");  ?>


<link rel="stylesheet" href="./include/css/myupload.css">
<body>
  <div class="mainbody">

  <form action="upload.php" method="post" enctype="multipart/form-data">
       <label for="file">Upload</label>
         <input type="file" name="file" size="30">
         <input class="button" type="submit" name="upload" value="upload">
         <p><strong>Note:</strong>  les formats .jpg, .jpeg, .gif et .png  accepted just until size 5 Mo.</p>
    </form>
  </div>
    
