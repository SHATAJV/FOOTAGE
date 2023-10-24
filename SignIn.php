

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Create An Account</title>
    <link rel="stylesheet" href="./include/css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
</head>
<body>
<div class="form-login">
    <div class="div-left d-flex">
        <a href="home.php" class="back col-12"> Go back</a>
    </div>
   
    <div class="head">
        <h1>Sign In</h1>
        <div class="Link">
            <h4>New user ?</h4>
            <h4><a href="./signUp.php" class="create">Create an account</a></h4>
        </div>
        <form action="#" method="post">
            <div class="input-group">
                <input class="text-input"
                    type="text"
                    name="email"
                    id="email"
                    placeholder="Username or email"
                />

                <input class="text-input"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Password"
                    required
                />

                <div class="keep-sign">
                    <input type="checkbox" name="keep_signed" id="keep_signed" />
                    <span class="myspan" style="padding-left: 3px">Keep me signed in</span>
                </div>
                <div>
                    <p><span><a href="forgot_password.php">Forgot your password?</a></span></p>
                </div>
                <button class="button-send" type="submit">Sign in</button>
            </div>
            <div class="icon-sign">
                <div class="hlines">
                    <hr>
                    <h6 class="H6">or sign in with</h6>
                    <hr>
                </div>
                <?php 
include("./include/db.php");

function sendLoginSuccessEmail($email) {
    $to = $email;
    $subject = "Login Successful";
    $message = "Hello " . $email . ",\n\nYou have successfully logged in to your account.";
    $headers = "From: shaiqhassibudin@gmail.com"; 

    // Use the PHP mail() function to send the email
    mail($to, $subject, $message, $headers);
}

if (isset($_POST['email'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email exists in the database
    $statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $statement->execute(array($email));

    if ($statement->rowCount() > 0) {
        // Retrieve the hashed password from the database
        $row = $statement->fetch();
        $hashed_password = $row['password'];

        // Verify the password using password_verify function
        if (password_verify($password, $hashed_password)) {
            // User login is successful
            session_start();

            $_SESSION['email'] = $email;
            $_SESSION["connected"] = 1;

            // Send login success email to the user
            sendLoginSuccessEmail($email);

            // Redirect the user to the My_upload.php page after login
            header("Location: My_upload.php");
            exit();
        } else {
            echo '<h4 style="color: red;">Unable to connect. Please check your email and password.</h4>';
        }
    } else {
        echo '<h4 style="color: red;">Unable to connect. Please check your email and password.</h4>';
    }
}
?>
                <div class="icon-sign-img">
                    <img src="./include/img/Icons/g.png" alt="google" />
                    <img src="./include/img/Icons/f.png" alt="facebook" />
                    <img src="./include/img/Icons/in.png" alt="linkedin" />
                    <img src="./include/img/Icons/twit.png" alt="twitter" />
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
