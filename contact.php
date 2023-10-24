<?php
include("./include/db.php");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="./include/css/header.css">
</head>
<body>
    <div class="main-1">
        <?php include("./include/header.php");?>
    </div>
    
    <div class="In-touch"> 
        <div class="information">
            <div class="title">
                <h3>Our contact</h3>
               
            </div>
            <div class="contact">
                <div class="adresse">
                    <h4>
                        <img src="./include/img/Icons/adresse.png" alt=""> Hendrick Cinsciencelean 23, 2980, Zoersel, Belgium
                    </h4>
                </div>
                <div class="telephone">
                    <p>
                        <h4>
                            <img src="./include/img//Icons/telephone.png" alt=""> (+33) 6 98 78 10 76
                        </h4>
                    </p> 
                </div>
                <div class="email">
                    <p>
                        <h4>
                            <img src="./include/img/Icons/email.png" alt=""> juwix.designlab@gmail.com
                        </h4>
                    </p>
                </div>
            </div>
            <div class="form"> 
                <form action="" method="post">
                    <input type="text" name="Name" id="Name" placeholder="Name" class="input">
                    <input type="email" name="email" id="email" placeholder="Email" class="input">
                    <textarea name="message" id="" cols="5" rows="3" class="input" style="height: 70px;">Write your message here</textarea>
                    <button type="submit" class="button-send">Send</button>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                      if (isset($_POST["email"])) {
                          $name = $_POST["Name"];
                          $email = $_POST["email"];
                          $message = $_POST["message"];
                  
                          $statement = $pdo->prepare("INSERT INTO Contact (`Name`, email, `message`) VALUES (?, ?, ?)");
                          $result = $statement->execute([$name, $email, $message]);
                  
                          if ($result) {
                              echo '<h4 style="color: green;">Your message was registered successfully</h4>';
                          } else {
                              echo 'There was an error in the process';
                          }
                      }
                  }
                    ?>
                </form>
            </div>
        </div>
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15472.03223678551!2d-0.141899875!3d51.5013644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM1PCsDUwJzA2LjMiTiAxwrAwNSc1MS4yIkU!5e0!3m2!1sen!2sus!4v1628135560024!5m2!1sen!2sus" width="600" height="467" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
       
    </div>
</body>
</html>
