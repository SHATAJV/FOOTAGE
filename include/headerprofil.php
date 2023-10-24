<?php
include("db.php");
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profil.php</title>
  <link rel="stylesheet" href="./include/css/profil_header.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  <div class="main">
    <header>
      <div class="main_header">
        <div class="logo">
          <a href="../home.php">FOOTAGE</a>
        </div>
        <div class="menu">
          <a href="my_upload.php">My Upload</a>
          <a href="download.php">My download</a>
          <a href="search.php">Search</a>
        </div>
        <div class="session">
          <ul>
            <li class="user-name"><?php echo $user['Name']; ?> <i class="fa-solid fa-chevron-down"></i>
              <ul class="dropdown">
                <li><a href="logout.php">Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </header>
  </div>   

  <!-- Rest of your HTML content goes here -->

</body>
</html>
