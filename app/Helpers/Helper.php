<?php
namespace App\Helpers;

class Helper
{
    public static function imagesaver($image_data){ 
        list($type, $data) = explode(';', $image_data); // exploding data for later checking and validating 

        if (preg_match('/^data:image\/(\w+);base64,/', $image_data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif
        
            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }
        
            $data = base64_decode($data);
        
            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }
        
        $fullname = time().'.'.$type;
        
        if(file_put_contents(public_path('image/').$fullname, $data)){
            $result = $fullname;
        }else{
            $result =  "error";
        }
        /* it will return image name if image is saved successfully 
        or it will return error on failing to save image. */
        return $result; 
    }

    public static function obfuscate_email($email)
    {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
    }
}


