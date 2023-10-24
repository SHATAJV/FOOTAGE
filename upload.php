<?php
include("./include/headerprofil.php");?>
<link rel="stylesheet" href="./include/css/myupload.css">
<div class="mainbody">


<?php
// Connect to your MySQL database using PDO
$host = 'localhost';
$dbname = 'FOOTAGE';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le fichier a été uploadé sans erreur
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $extensions = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];

        // Vérifier l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $extensions)) {
            die("Erreur: this format is not valid.");
        }

        // Vérifier la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            die("Erreur: the size is more than size accepted.");
        }

        // Vérifier le type MIME du fichier
        if (in_array($filetype, $extensions)) {
            // Vérifier si le fichier existe déjà avant de le télécharger
            if (file_exists("upload/" . $filename)) {
                echo $filename . " this photo is uploded before.";
            } else {
                // Télécharger le fichier dans son emplacement
                move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $filename);
                echo "<p>your photo was uploaded successefuly.</p>";

                // Insérer le nom du fichier dans la base de données
                $insertQuery = "INSERT INTO uploaded_photos (filename, uploaded_at) VALUES (:filename, NOW())";
                $stmt = $pdo->prepare($insertQuery);
                $stmt->bindParam(':filename', $filename);

                if ($stmt->execute()) {
                    echo "<p>Informations was added in data base.</p>";
                } else {
                    echo "Erreur this information can not be added in data base.";
                }

                // Afficher l'image téléchargée
                echo "<img src='upload/" . $filename . "' alt='Uploaded Image' style='width: 600px; height: auto;'>";

                // Ajouter un lien de téléchargement pour le fichier
                $downloadLink = "upload/" . $filename;
                echo "<p><a href=\"$downloadLink\" download=\"$filename\">Download Photo</a></p>";
            }
        } else {
            echo "Erreur: type de fichier non pris en charge.";
        }
    } else {
        echo "Erreur: this photo can't be uploaded please try again";
    }
} else {
    echo "Erreur: the photo wasn't choosed please choose a photo .";
} ?>
</div>


