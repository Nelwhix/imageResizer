<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once 'vendor/autoload.php';
        if (isset($_POST['submit'])) {
            //Taking all the parameters from the file superglobal
            $file = $_FILES['file'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            
            $fileError = $file['error'];
            $fileSize = $file['size'];

            $fileExt = explode(".", $fileName);
            $newFilename = strtolower($fileExt[0]);
            $fileActualExt = strtolower(end($fileExt));

            $allowedtypes = array("jpg", "png", "jpeg", "jiff");

            function resizeImage($imagefullname) 
         {
             global $file;
             $fileTempname = $file['tmp_name'];
             $imagine = new \Imagine\Gd\Imagine();
             $width = $_POST['width'];
             $height = $_POST['height'];
             $size = new \Imagine\Image\Box($width, $height);
             $imagine->open($fileTempname)
                         ->thumbnail($size)
                         ->save("Images/". $imagefullname);
                 }

            if (in_array($fileActualExt, $allowedtypes)) 
            {
                if ($fileError === 0) {
                    $imagefullname = $newFilename."-resized". uniqid("", true).".". $fileActualExt;
                    resizeImage($imagefullname);
                    session_start();
                    $_SESSION['imgfullname'] = $imagefullname;
                } else {
                    echo "You had an error uploading this file!";
                    exit();
                }
            }else {
                    echo "This file type is not supported";
                    exit();
                }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Image Resizer</title>
</head>
<body>
    <section class="p-5 bg-dark text-light">
        <div class="container-sm">
            <form class="row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                <p class="lead text-danger">All values must be in pixels</p>
                <input type="number" name="width" placeholder="width" class="form-control mb-3" >
                <input type="number" name="height" placeholder="height" class="form-control mb-3">
                <input type="file" name="file" class="form-control mb-3">
                <button type="submit" class="btn btn-primary" name="submit">Resize</button>
            </form>
        </div>
</section>
<?php 
    if (!isset($_SESSION['imgfullname'])) {
        $_SESSION['imgfullname'] = 'none';
    }   else {
?>
<section class="p-5 bg-light">
    <div class="container">
        <p class="lead text-center">Your resized Image is ready for download!</p>
        <img src="<?php echo 'Images/'.$_SESSION['imgfullname'];?>" alt="" class="img-thumbnail">
        <a href="<?php echo 'Images/'.$_SESSION['imgfullname']; ?>" class="btn btn-primary text-center" download>Download <i class="bi bi-download"></i></a>
    </div>
</section>
<?php 
    }
?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>