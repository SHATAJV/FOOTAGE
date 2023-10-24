<?php 
include("./include/db.php"); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <link rel="stylesheet" href="./include/css/signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
</head>
<body>
<div class="form-login">
    <div class="div-left d-flex">
        
        <a href="SignIn.php" class="back col-12"> Go back</a>
    </div>
   
    <div class="head">
        <h1 > Forgot password</h1>
        <div class="Link">
            <h4>we will send you a link to reset your password</h4>
         
        </div>
        <form action="#" method="post">
        <div class="input-group">
            <input class="text-input"
                type="text"
                name="email"
                id="email"
                placeholder="email"
            />

            <button class="button-send" type="submit" >
                Send a mail
            </button>
            </div>
            <div class="icon-sign">
                <div class="hlines">
                 <hr>
                <h6 class="H6">or sign in with</h6>
                <hr>
                </div>
                
                <div class="icon-sign-img">
                    <img src="./include/img/Icons/g.png" alt="google" />
                    <img src="./include/img/Icons/f.png" alt="facebook" />
                    <img src="./include/img/Icons/in.png" alt="linkedin" />
                    <img src="./include/img/Icons/twit.png" alt="twitter" />
                </div>
            </div>
         
        </form>
        <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input (email)
    $email = $_POST["email"];

    // Sanitize the email input to prevent SQL injection
    $email = htmlspecialchars($email);

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Email exists, send reset password link (You can implement the email sending functionality here)
        // For the sake of this example, we'll just display a success message in green
        echo '<p style="color: green;">We have sent an email for changing your password. Please check your email.</p>';
    } else {
        // Email does not exist, show an error message in red
        echo '<p style="color: red;">Your email does not exist. You should sign up first.</p>';
    }
}
?>

    </div>
</div>
</body>
</html>




