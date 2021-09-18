<?php

    function compress( $source , $quantity ){
        //        get info image
        $path_parts = pathinfo($source);
        $name_image = $path_parts['filename'];
        $base_file_name = $path_parts['basename'];
        $name_image = $name_image . ".jpg";
        //      replace name
        $new_source = str_replace($base_file_name , $name_image , $source );
        try {
            $source = change_format_to_jpg( $source , $new_source);
            $img_info = getimagesize($source);
            $image = null;
            $ext = $img_info['mime'];
            switch ($ext) {
                case 'image/jpg':
                case 'image/jpeg':
                    // create a jpeg extension
                    $image = imagecreatefromjpeg($source);
                    if (imagetypes() & IMG_JPG) {
                        imagejpeg($image, $source, $quantity);
                    }
                    break;
                // Image is a GIF
                case 'image/gif':
                    $image = @imagecreatefromgif($source);
                    if (imagetypes() & IMG_GIF) {
                        imagegif($image, $source);
                    }
                    break;
                // Image is a PNG
                case 'image/png':
                    $image = @imagecreatefrompng($source);
                    $invertScaleQuality = 9 - round(($quantity/100) * 9);
                        // Check PHP supports this file type
                    if (imagetypes() & IMG_PNG) {
                        imagepng($image, $source, $invertScaleQuality);
                    }
                    break;
                // Mime type not found
                default:
                    throw new Exception("File is not an image, please use another file type.", 1);
            }

        } catch ( Exception $ex ) {
            echo "ERR: " . $ex->getMessage();
        }
    }

    function change_format_to_jpg($source, $path){
        if( file_exists( $source ) ){
            // Khởi tạo ảnh blank 
            imagejpeg(imagecreatefromstring(file_get_contents($source)) ,$path);
            // delete old file
            $path_parts = pathinfo($source);
            if($path_parts['extension'] != "jpg" && $path_parts['extension'] != "jpeg" ){
                unlink($source);
            }
            return $path;
        }else{
            throw new Exception("File not exits");
        }
    }
//     change_format_to_jpg("images/anh2.jpg" , "images/anh2.jpg");
//    compress('images/anh3.jpg' , 70);

    function resize($max_width){
        // get info image 

        $ext = null;
        $image = null;
        $newImage = null;
        $origWidth = null;
        $origHeight = null;
        $resizeWidth = null;
        $resizeHeight = null;
        $file_create = null;
        $source = 'images/gaixinh.jpg';

        $image_info = getimagesize($source);

        $width = $image_info[0];
        $height = $image_info[1];
        $type = $image_info['mime'];

        function HeightByWidth( $old_w , $old_h , $new_w ){
            $new_h = ( $old_h / $old_w ) * $new_w ;
            return $new_h;
        }

        function save_image( $type, $new_image , $save_path , $quantity ){

            switch ($type) {
                case 'image/jpg':
                case 'image/jpeg':
                    // Check PHP supports this file type
                    if (imagetypes() & IMG_JPG) {
                        imagejpeg($new_image, $save_path, $quantity);
                    }
                    break;
                case 'image/gif':
                    // Check PHP supports this file type
                    if (imagetypes() & IMG_GIF) {
                        imagegif($new_image, $save_path);
                    }
                    break;
                case 'image/png':
                    $invertScaleQuality = 9 - round(($quantity/100) * 9);
                    // Check PHP supports this file type
                    if (imagetypes() & IMG_PNG) {
                        imagepng($new_image, $save_path, $invertScaleQuality);
                    }
                    break;
            }

            
        }

        //  nén ảnh 

        
        if($width > $max_width){
            // prosesss...
            // check type image
            switch ($type) {
                case 'image/jpg':
                case 'image/jpeg':
                    // create a jpeg extension
                    $image = imagecreatefromjpeg($source);
                    break;
                // Image is a GIF
                case 'image/gif':
                    $image = @imagecreatefromjpeg($source);
                    break;
                // Image is a PNG
                case 'image/png':
                    $image = @imagecreatefromjpeg($source);
                    break;
                // Mime type not found
                default:
                    throw new Exception("File is not an image, please use another file type.", 1);
            }
            $origHeight = imagesy($image);
            $origWidth = imagesx($image);

            $resizeWidth = $max_width;

            $resizeHeight = HeightByWidth( $origWidth , $origHeight , $resizeWidth );

            $newImage = imagecreatetruecolor($resizeWidth , $resizeHeight);

            // imagecopyresampled($newImage, $image, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $origWidth, $origHeight);

            // save_image($type, $newImage , $source , 100);

            // save_image($type, $newImage , $source , 70);
            return $image;
        }




    }

    function render_header_image(){
        header('Content-type: ' . 'image/jpeg' );
        imagejpeg(resize(300));
    
    }
    render_header_image();



    // this my comment 
    
    // echo $a;
?>

