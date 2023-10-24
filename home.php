<?php
include("./include/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOOTAGE</title>
    <link rel="stylesheet" href="./include/css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- class main in page -->
    <div class="main">
        <!-- class image header -->
        <div class="background-image">
            <img src="./include/img/Images/home.jpg" alt="photo of boy with drone">
            <!-- class nav bar -->
            <div class="Nav">
                <div class="logo">FOOTAGE</div>
                <div class="icon">
                    <a class="cool-link" href="home.php">Home</a>
                    <a class="cool-link" href="#our-service">Services</a>
                    <a class="cool-link" href="contact.php">Contact</a>
                </div>
                <div class="account">
                    <a href="signUp.php">register</a>
                    <a href="SignIn.php"><button class="button" type="submit">login </button></a>
                </div>
            </div>
            <!-- class titre main de site -->
            <div class="titre">
                <h1>Video and Photography <br> Footage Database</h1>
                <h5 style="margin: 15px;">
                    membre of footage log in to submit your footage
                    <p>a custom profesionelle video? contact</p>
                </h5>
                <a href="SignIn.php">
                    <button class="button" type="submit">login</button>
                </a>
                <a href="contact.php">
                    <button class="button" type="submit">contact</button>
                </a>
            </div>
        </div>
        <!-- section servise -->
        <h2 id="our-service">Our Services</h2>
        <div class="publicité">
            <div class="img1">
                <img src="./include/img/Images/img-1.jpg" alt="drone">
                <a href="Drone_video.php">Dronevideographie</a>
                <p>
                    we create both drone videographi and dronphotographi for use in visual communication and digital media
                </p>
            </div>
            <div class="img2">
                <img src="./include/img/Images/img2.jpg" alt="phtograph">
                <h3><a href="photography.php"> photography</a></h3>
                <p>
                    for video and photo creation we also use fulle frame camera to obtain the best quality
                </p>
            </div>
            <div class="img3">
                <img src="./include/img/Images/img3.jpg" alt="ordinqteur">
                <h3><a href="promotion.php">promotion video</a></h3>
                <p>
                    for ypur bussiness we creat a custom promotional video using both drone and regular footage
                </p>
            </div>
        </div>
        <!-- section video site -->
        <div class="video">
            <video controls autoplay loop src="./include/img/Images/video.mp4"></video>
        </div>
        <!-- contact -->
        <div class="In-touch">
            <div class="information">
                <div class="title">
                    <h3>GET IN TOUCH</h3>
                </div>
                <div class="contact">
                    <div class="adresse">
                        <h4><img src="./include/img/Icons/adresse.png" alt=""> hendrick cinsciencelean 23, 2980, Zoersel,Belguim</h4>
                    </div>
                    <div class="telephone">
                        <p><h4><img src="./include/img/Icons/telephone.png" alt=""> (+33) 6 98 78 10 76</h4></p>
                    </div>
                    <div class="email">
                        <p><h4><img src="./include/img/Icons/email.png" alt=""> juwix.designlab@gmail.com</h4></p>
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
        <!-- section footer -->
    </div>
    <footer>
        <div class="icon-footer col-12 justify-content-between">
            <img class="icon-footer-icon" src="./include/img/Icons/face-h.png" alt="facebook">
            <img class="icon-footer-icon" src="./include/img/Icons/insta-h.png" alt="insta">
            <img class="icon-footer-icon" src="./include/img/Icons/linedin-h.png" alt="linedin">
            <img class="icon-footer-icon" src="./include/img/Icons/mail-h.png" alt="mail-h">
            <img class="icon-footer-icon" src="./include/img/Icons/twit-h.png" alt="twit-h">
        </div>
        <h3>FOOTAGE</h3>
        <h6 style="margin-top: 5px;">copyright @2023 all right resieved</h6>
        <h5 style="margin-top: 5px;">Authors: Hassibudin Shaiq (Front-end)/ Shahrzad Tajvidi(Back-end)</h5>
    </footer>

    
</body>
</html>
