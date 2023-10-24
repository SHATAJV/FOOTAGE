<?php
include("./include/db.php");
include("./include/headerprofil.php");

// Handle search form submission and photo deletion
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['search'])) {
        $searchTerm = $_POST['searchTerm'];

        // Retrieve photos from the 'uploaded_photos' table that match the search term
        $stmt = $pdo->prepare("SELECT * FROM uploaded_photos WHERE filename LIKE :searchTerm");
        $stmt->bindValue(':searchTerm', "%{$searchTerm}%");
        $stmt->execute();
        $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any matching photos are found
        if (count($photos) === 0) {
            $errorMessage = "There are no photos matching the search term.";
        }
    } elseif (isset($_POST['delete'])) {
        $photoId = $_POST['photoId'];

        // Retrieve the filename from the database
        $stmt = $pdo->prepare("SELECT filename FROM uploaded_photos WHERE id = :id");
        $stmt->bindParam(':id', $photoId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $filename = $result['filename'];
            // Delete the photo from the server
            $imagePath = './upload/' . $filename;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // Delete the photo from the database
            $stmt = $pdo->prepare("DELETE FROM uploaded_photos WHERE id = :id");
            $stmt->bindParam(':id', $photoId, PDO::PARAM_INT);
            $stmt->execute();

            // Set a flag in the session to indicate photo deletion success
            $_SESSION['photo_deleted'] = true;
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Check if the photo deletion success flag is set in the session
$photoDeleted = false;
if (isset($_SESSION['photo_deleted']) && $_SESSION['photo_deleted'] === true) {
    $photoDeleted = true;
    // Unset the flag after displaying the success message
    unset($_SESSION['photo_deleted']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Photos</title>
    <link rel="stylesheet" href="./include/css/search.css">
</head>
<body>
    <div class="mainbody">
        <div class="search-form">
            <form method="POST" action="">
                <input type="text" name="searchTerm" placeholder="Enter search term">
                <button type="submit" name="search">Search</button>
            </form>
        </div>

        <?php if ($photoDeleted): ?>
            <p class="success-message">Your photo was deleted successfully.</p>
        <?php endif; ?>

        <div class="gallery">
            <?php if (isset($errorMessage)): ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php elseif (isset($photos) && count($photos) > 0): ?>
                <?php foreach ($photos as $photo): ?>
                    <div class="photo">
                        <?php
                        $imagePath = './upload/' . $photo['filename']; 
                        ?>
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo $photo['filename']; ?>">
                        <p><?php echo $photo['filename']; ?></p>
                        <?php
                        $downloadLink = "upload/" . $photo['filename'];
                        echo "<p><a href=\"$downloadLink\" download=\"{$photo['filename']}\">Download your photo</a></p>";
                        ?>

                        <?php
                        // Add a delete form for each photo with onclick event for confirmation
                        echo "<form method=\"POST\">";
                        echo "<input type=\"hidden\" name=\"photoId\" value=\"{$photo['id']}\">";
                        echo "<button type=\"submit\" name=\"delete\" onclick=\"return confirmDelete();\">Delete</button>";
                        echo "</form>";
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // JavaScript function to prompt the user before deleting the photo
        function confirmDelete() {
            return confirm("Are you sure you want to delete this photo?");
        }
    </script>
</body>
</html>
