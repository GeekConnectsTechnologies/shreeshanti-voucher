<?php
    function generateImage($recieverName,$msg,$price,$expirydate,$id,$imagename)
    {
        $font = "AGENCYR.TTF";
        echo "Hola";
        $imagename='imageupload/'.$imagename;
        
        $image = imagecreatefromjpeg("white (2).jpg");
        $color = imagecolorallocate($image, 19, 21, 22);
    
    
        $empName = 'Hi '.$recieverName.' ,';
        imagettftext($image, 20, 0, 25, 335, $color, $font, $empName);
    
        $notes = $msg;
        imagettftext($image, 20, 0, 25, 370, $color, $font, $notes);
    
                // $qrcode = "https://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=18&chco=000000";
                // imagettftext($image, 20, 0, 15, 120, $color, $font, $qrcode);
    
        $price = 'Rs.  '.$price.'';
        imagettftext($image, 50, 0, 300, 490, $color, $font, $price);
    
        $edate = '*Valid Till '.$expirydate.'';
        imagettftext($image, 20, 0, 300, 530, $color, $font, $edate);
    
        $src = imagecreatefrompng('https://chart.apis.google.com/chart?cht=qr&chs=150x150&chl='.$id.'&chco=000000&chld=H|0');
        $top = imagecreatefrompng($imagename);
        imagecopymerge($image, $src, 30, 410, 0, 0, 150, 150, 100);
        imagecopymerge($image, $top, 0, 0, 0, 0, 600, 300, 100);
    
        $file = $id;
        $filepath="uploads/" . $file . ".jpg";
        imagejpeg($image, $filepath);
        imagedestroy($image);
    }
?>


