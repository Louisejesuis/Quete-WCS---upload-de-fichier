<?php

$directory = 'upload/';
$max_size = 1000000;
$extensions = array('png', 'gif', 'jpg', 'jpeg');

if (isset($_POST['submit'])) {
    if (count($_FILES['image']['name']) > 0) {
        for ($i =0; $i< count($_FILES['image']['name']); $i++)
        {
            $extension = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);
            if(!in_array($extension, $extensions))
            {
                echo 'Vous devez uploader un fichier de type png, gif ou jpg';
            } else {
                if(filesize($_FILES['image']['tmp_name'][$i])<$max_size)
                {
                    if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $directory . $filename ='image' . uniqid() .'.'. $extension)) {
                        echo 'Upload effectué avec succès !';
                    } else {
                        echo 'Echec de l\'upload !';
                    }
                }else {
                    echo 'Le fichier est trop gros...';
                }
            }
        }
    }
}

if (isset($_GET['file']))
{
    if (file_exists($directory . $_GET['file']))
    {
     unlink($directory . $_GET['file']);
     header('Location : upload.php');
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
                <input type="hidden" name="MAX_FILE_SIZE" value="100000">
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
                                <a href="upload.php?file=<?= $fileinfo->getFilename()?>" class="btn btn-danger" role="button" value="<?php unlink($filename) ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ; ?>
        </div>
    </body>
</html>
