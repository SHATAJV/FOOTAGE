<?php
// include necessary files and establish database connection (db.php)
include("./include/db.php");
include("include/headerprofil.php");

// Fetch all data from the 'downloaded_photos' table
$stmt = $pdo->query("SELECT * FROM downloaded_photos");
$downloadedPhotos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Downloads</title>
    <link rel="stylesheet" href="include/css/mydownload.css">
</head>
<body>
    <main>
        <h1>My Downloaded Photos</h1>
        <section class="gallery">
            <?php if (count($downloadedPhotos) > 0): ?>
                <?php foreach ($downloadedPhotos as $photo): ?>
                    <div class="photo">
                        <?php
                       
                        $imagePath = 'upload/' . $photo['filename'];
                        ?>
                        <img src="<?php echo $imagePath; ?>" alt="<?php echo $photo['filename']; ?>">
                        <p><?php echo $photo['filename']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No photos downloaded yet.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
