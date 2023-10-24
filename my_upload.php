<?php
// include necessary files and establish database connection (db.php)
include("./include/db.php");
include("include/headerprofil.php");

// Function to handle photo deletion
function deletePhoto($pdo, $photoId) {
    $deleteStmt = $pdo->prepare("DELETE FROM uploaded_photos WHERE id = :photoId");
    $deleteStmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
    $deleteStmt->execute();
}

// Function to handle photo download and registration
function downloadPhoto($pdo, $photoId) {
    // Fetch the photo information from the 'uploaded_photos' table
    $fetchPhotoStmt = $pdo->prepare("SELECT * FROM uploaded_photos WHERE id = :photoId");
    $fetchPhotoStmt->bindValue(':photoId', $photoId, PDO::PARAM_INT);
    $fetchPhotoStmt->execute();
    $photo = $fetchPhotoStmt->fetch(PDO::FETCH_ASSOC);

    if ($photo) {
        // Insert the downloaded photo into the 'downloaded_photos' table
        $insertStmt = $pdo->prepare("INSERT INTO downloaded_photos (filename) VALUES (:filename)");
        $insertStmt->bindValue(':filename', $photo['filename'], PDO::PARAM_STR);
        $insertStmt->execute();

        // Provide the download link to the user when clicked
        $downloadLink = "./upload/" . $photo['filename'];
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $photo['filename'] . "\"");
        readfile($downloadLink);
        exit();
    } else {
        echo "Photo not found.";
    }
}

// Check if the 'delete' parameter is set in the URL and the confirmation is given
if (isset($_GET['delete']) && isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    $photoId = $_GET['delete'];
    deletePhoto($pdo, $photoId);

    // Redirect back to the same page after deletion to update the photo gallery
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Check if the 'download' parameter is set in the URL
if (isset($_GET['download'])) {
    $photoId = $_GET['download'];
    downloadPhoto($pdo, $photoId);
}

// Fetch data from the 'uploaded_photos' table
$stmt = $pdo->query("SELECT * FROM uploaded_photos");
$photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Downloads</title>
    <link rel="stylesheet" href="include/css/myupload.css">
    <link rel="stylesheet" href="include/css/mydownload.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        function confirmDelete(photoId) {
            var confirmResult = confirm("Are you sure you want to delete this photo?");
            if (confirmResult) {
                window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?delete=" + photoId + "&confirm=yes";
            }
        }

        function downloadPhoto(photoId) {
            window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?download=" + photoId;
        }

        function sharePhoto(photoId, filename) {
            if (navigator.share) {
                navigator.share({
                    title: "Check out this photo!",
                    text: "I downloaded this photo: " + filename,
                    url: window.location.origin + "/download/" + filename
                }).then(() => {
                    console.log("Successfully shared!");
                }).catch((error) => {
                    console.error("Share failed:", error);
                });
            } else {
                alert("Sharing is not supported on your device/browser.");
            }
        }
    </script>
</head>
<body>
<div class="mainbody">
    <main>
        <section class="gallery">
            <?php if (!empty($photos) && is_array($photos)): ?>
                <?php foreach ($photos as $photo): ?>
                    <div class="photo">
                        <?php
                        $imagePath = './upload/' . $photo['filename'];
                        ?>
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo $photo['filename']; ?>">
                        <p><?php echo $photo['filename']; ?></p>
                        <?php
                        // Add a download link for each photo
                        echo "<p><a href=\"#\" onclick=\"downloadPhoto({$photo['id']})\">Download</a></p>";
                        // Add a delete link for each photo with onclick event for confirmation
                        echo "<p><a href=\"#\" onclick=\"confirmDelete({$photo['id']})\">Delete</a></p>";
                        // Add a share link for each photo
                        echo "<p><a href=\"#\" onclick=\"sharePhoto({$photo['id']}, '{$photo['filename']}')\">Share</a></p>";
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No photos found. You didn't upload any photo. You should upload some.</p>
            <?php endif; ?>
        </section>
    </main>
    <div>
        <div>
            <button class="button"><a style="color:#fbfbfb; " href="indexupload.php">Upload Files</a></button>
        </div>
    </div>
</div>

</body>

</html>
