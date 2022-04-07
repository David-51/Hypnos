<?php
/**
 * @param $picture = $_FILES['name']
 * $pictures is the array containine ['name' 'type' 'tmp_name' 'error' 'size']
 * @param $path to record pictures
 */
function record_image($picture, $path){ // Origine et destination de l'enregsitrement
        
    $fromUrl = $picture['tmp_name'];
    // définition du nom de fichier original.
    $date = new DateTime();
    $timestamp = date_format($date, 'U');
    
    $ext = explode('/', $picture['type'])[1];
    $new_name = 'suite'.$timestamp.'.'.$ext;
    $dest_name = 'suite'.$timestamp.'-640x426.'.$ext;
    // destination des fichiers et leurs noms
    
    $source_url = __DIR__.'/../../'.$path.'/'.'temp/'.$new_name.'.'.$ext;
    $destination_url = __DIR__.'/../../'.$path.'/'.$dest_name;
    
    // retourne une valeur qui correspond au type de fichier.

    $image_type = exif_imagetype($picture['tmp_name']);    

//------ compression et redimensionnement du fichier ------- //

    function compress_image($source_url, $destination_url, $quality){
        $info = getimagesize($source_url);    
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        
        $height = imagesy($image);
        $width = imagesx($image);

        $imageResized = imagecreatetruecolor('640','426');    // création d'un objet image vide
        imagecopyresampled($imageResized, $image, 0,0,0,0,  '640', '426', $width, $height); // on met l'image source dans notre nouvelle image vide avec les bonnes dimesions   
        imagejpeg($imageResized, $destination_url, $quality); // on compress la nouvelle image aux nouvelles dimensions.                
    }

    if($image_type === 1 | $image_type === 2 | $image_type === 3){
        // source_url est l'emplacement destination du fichier qui nous servira d'original

        file_put_contents($source_url, file_get_contents($fromUrl));           
        compress_image($source_url, $destination_url, 70);

        unlink($source_url);    
        http_response_code(201);                          
    }
    else{
        http_response_code(404);                           
    }
    return $dest_name; // nom de l'image     
}