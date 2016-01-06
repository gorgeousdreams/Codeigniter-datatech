<?php

function image_thumb( $image_path, $image_name, $height, $width ) {

    // Get the CodeIgniter super object
    $CI =& get_instance();
    $offset = strpos($image_name, '.');
    $image_name = substr_replace($image_name, $height . '_' . $width . '.jpg', $offset);
    
    // Path to image thumbnail
    $image_thumb = dirname( $image_path ) . '/' . $image_name;

    if ( !file_exists( $image_thumb ) ) {
        // LOAD LIBRARY
        $CI->load->library( 'image_lib' );

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = $image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize( $config );
        $CI->image_lib->resize();
        $CI->image_lib->clear();
        
    }
}

function create_thumbnail( $image_path, $image_name, $height, $width )
{
    require_once 'vendor/phpThumb/PhpThumbFactory.php';

    $offset = strpos($image_name, '.');
    $image_name = substr_replace($image_name, $height . '_' . $width . '.jpg', $offset);
    
    // Path to image thumbnail
    $image_thumb = dirname( $image_path ) . '/' . $image_name;
    $options = array('resizeUp' => true, 'jpegQuality' => 100);

    try
    {
        $thumb = PhpThumbFactory::create($image_path, $options);
    }
    catch (Exception $e)
    {
        // handle error here however you'd like
    }

    $thumb->adaptiveResize($height, $width);
    $thumb->save($image_thumb, 'jpg');
}

/* End of file image_helper.php */
/* Location: ./application/helpers/image_helper.php */

function make_thumb( $image_path, $image_name, $height, $width) {
    // echo $image_path."-".$image_name."-".$height."-".$width;
    /* read the source image */
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    if($ext == 'jpg' || $ext == 'jpeg')
    {
        $source_image = imagecreatefromjpeg($image_name);
    }
    elseif($ext == 'png')
    {
        $source_image = imagecreatefrompng($image_name);
    }
    elseif($ext == 'gif')
    {
        $source_image = imagecreatefromgif($image_name);
    }
    elseif($ext == 'bmp')
    {
        $source_image = imagecreatefrombmp($image_name);
    }
    
    $actual_width = imagesx($source_image);
    $actual_height = imagesy($source_image);
     
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($width, $height);
    Imagefill($virtual_image, 0, 0, imagecolorallocate($virtual_image, 255, 255, 255));
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $width, $height, $actual_width, $actual_height);
    
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $image_path);
}