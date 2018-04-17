<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 17/04/18
 * Time: 10:55
 */

if (file_exists('upload/' . $_GET['image'] ))
{
    unlink('upload/' . $_GET['image']);
}

header("Location:index.php");
exit();
