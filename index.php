<?php

$directory = 'upload/';
$extensions = array('png', 'gif', 'jpg', 'jpeg');
if (isset($_FILES['image'])) {
    if (count($_FILES['image']['name']) > 0) {

        for ($i =0; $i< count($_FILES['image']['name']); $i++) {
            $extension = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
            $filename = 'image' . uniqid() . '.' . $extension;
            if(!in_array($extension, $extensions)) {
                echo 'Vous devez uploader un fichier de type png, gif ou jpg';
                } elseif(isset($_POST['submit'])) {
                if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $directory . $filename)) {
                    echo "<span>Upload réussi !</span>";
                } else {
                    echo "Vous dever uploadez un fichier de moins de 1Mo";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Page Description">
        <meta name="author" content="louise">
        <title>Upload de fichier</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <form method="POST" action="" enctype="multipart/form-data" class="form-group">
                <h1 class="page-header">Upload de fichier</h1>
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
                <input type="file" name="image[]" class="form-control" multiple="multiple">
                <input type="submit" name="submit" value="Envoyer le fichier" class="btn btn-primary">
            </form>
            <?php
            $it = new FilesystemIterator($directory);
            foreach ($it as $fileinfo) :
            ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Galerie</h1>
                    </div>
                    <div class="row">
                        <div class="thumbnail">
                            <img src="<?= $directory . $fileinfo->getFilename(); ?>" alt="...">
                            <div class="caption">
                                <h3><?= $fileinfo->getFilename(); ?></h3>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="filename" value="<?= $fileinfo->getFilename(); ?>">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ; ?>
        </div>
    </body>
</html>
