<?php
    require_once 'vendor/autoload.php';
    use Imagine\Image\Box;
    use Imagine\Image\ImageInterface;
    use Imagine\Image\Point;

    if (isset($_POST['submit'])) {
        //Taking all the parameter frome the file superglobal
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
                        ->save("../Images/". $imagefullname);
                }
    
        if (in_array($fileActualExt, $allowedtypes)) {
            if ($fileError === 0) {
                $imagefullname = $newFilename."-resized". uniqid("", true).".". $fileActualExt;
                resizeImage($imagefullname);
                session_start();
                $_SESSION['imgfullname'] = $imagefullname;
                //The header function wahala
                header("Location: ");
                }
            } else {
                echo "You had an error uploading this file!";
                exit();
            }
        } else {
            echo "This file type is not supported";
            exit();
        }











         

         
     
         
             
             } else {
                
             }
         } 
         if ($fileError === 0) {
            
            
            }