<?php
		$font = "MYRIADPRO-REGULAR.OTF";
                $fbold = "MYRIADPRO-SEMIBOLD.OTF";
        echo "Hola";
        $imagename='imageupload/1.png';
        
        $image = imagecreatefromjpeg('whole.jpg');
        $color = imagecolorallocate($image, 255, 255, 255);
    
    
        // $empName = 'Hi DEMO ,';
        imagettftext($image, 20, 0, 25, 335, $color, $fbold, 'Hi, Receiver Name');
    
        // $notes = $msg;
        imagettftext($image, 18, 0, 25, 390, $color, $font, 'Voucher Name');

        imagettftext($image, 14, 0, 25, 420, $color, $font, 'Voucher Message for Receiver.');

    
                // $qrcode = "https://chart.apis.google.com/chart?cht=qr&chs=200x200&chl=18&chco=000000";
                // imagettftext($image, 20, 0, 15, 120, $color, $font, $qrcode);
    
        // $price = 'Rs.  '.$price.'';
        imagettftext($image, 27, 0, 180, 500, $color, $fbold, 'Rs. xxxx');
    
        // $edate = '*Valid Till '.$expirydate.'';
        imagettftext($image, 14, 0, 180, 525, $color, $font, '*Valid Till dd-mm-yyyy');

        imagettftext($image, 8, 0, 220, 560, $color, $font, '+91 9724 522 777');

        imagettftext($image, 8, 0, 345, 560, $color, $font, 'shreeshanti.in');
    
        $src = imagecreatefrompng('https://chart.apis.google.com/chart?cht=qr&chs=115x115&chl=gotcha!&chco=000000&chld=H|0');
        $top = imagecreatefrompng($imagename);
        imagecopymerge($image, $src, 35, 458, 0, 0, 115, 115, 100);
        imagecopymerge($image, $top, 0, 0, 0, 0, 600, 300, 100);
    
        $file = "abcd111";
        $filepath="uploads/" . $file . ".jpg";
        imagejpeg($image, $filepath);
        imagedestroy($image);

?>