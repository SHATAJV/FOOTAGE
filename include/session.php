
<?php
// Session will start if the user has already provided their email and logged in,
// otherwise, they will remain on the login page.
session_start();

// Check if the user is not connected or the session has timed out
if (!isset($_SESSION["connected"]) || (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 120))) {
    // Destroy the session
    session_unset();
    session_destroy();
    header("location: SignIn.php");
    exit();
} else {
    // Update last activity time to the current time
    $_SESSION['LAST_ACTIVITY'] = time();

    require("db.php");

    $request = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $request->execute(["email" => $_SESSION["email"]]);
    $user = $request->fetch(PDO::FETCH_ASSOC);
}
?>
