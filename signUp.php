
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
<body>
<div class="form-login">
    <div class="div-left d-flex">
        <a href="home.php" class="back col-12"> Go back</a>
    </div>
   
    <div class="head">
        <h1>Create An Account</h1>
        <div class="Link">
            <h4>Already an User ?</h4>
            <h4><a href="./signIn.php" class="create">Sign In</a></h4>
        </div>
        <form action="#" method="post">
            <input class="input-name"
            type="text"
            name="Name"
            id="Name"
            placeholder="Name">

            <input class="input-lname"
            type="text"
            name="Last_Name"
            id="Last_Name"
            placeholder="Last Name">

            <div class="input-group">
                <input class="text-input"
                    type="text"
                    name="email"
                    id="email"
                    placeholder="Email Address"
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
                <button class="button-send" type="submit">Sign Up</button>
            </div>
            <div class="icon-sign">
                <div class="hlines">
                    <hr>
                    <h6 class="H6">or sign up with</h6>
                    <hr>
                </div>
                <?php
include("./include/db.php");

function sendLoginSuccessEmail($email) {
    $to = $email;
    $subject = "Login Successful";
    $message = "Hello " . $email . ",\n\nYou have successfully logged in to your account.";
    $headers = "From: HassibShaiq@gmail.com";

    // Use the PHP mail() function to send the email
    mail($to, $subject, $message, $headers);
}

if (isset($_POST["email"])) {
    $name = $_POST["Name"];
    $lastName = $_POST["Last_Name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if the email already exists
    $statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $statement->execute(array($email));

    if ($statement->rowCount() > 0) {
        echo '<h4 style="color: red;">You have already been registered. Please sign in.</h4>';
    } else {
        // Hash the password using bcrypt
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL statement
        $insertStatement = $pdo->prepare("INSERT INTO user (`Name`, `Last_Name`, email, password) VALUES (?, ?, ?, ?)");

        // Bind the values
        $insertStatement->execute(array($name, $lastName, $email, $hashed_password));

        if ($insertStatement->rowCount() > 0) {
            echo '<h4 style="color: green;">Your registration was successful.</h4>';
        } else {
            echo '<h4 style="color: red;">There was an error in the registration process.</h4>';
        }
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
