<?php
  function sendEmail($subject,$to_email,$from_email,$to_fullname,$from_fullname,$filename)
  {
    $imagepath='uploads/'.$filename.'.jpg';
    $fname=$filename.'.jpg';
    // $filepath = "../emailtemplate/uploadtemplate/";
        // boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
    $headers  = "nMIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; charset=utf-8\r\n" . " boundary=\"{$mime_boundary}\"";
    $headers .= "To: $to_fullname <$to_email>\r\n";
    $headers .= "From: $from_fullname <$from_email>\r\n";

    // multipart boundary 
        $message = "This is a multi-part message in MIME format.\n\n";
        $message .= "--{$mime_boundary}\n";
        $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        $message .= "--{$mime_boundary}\n";
    
    // preparing attachments            
    $file = fopen($imagepath,"rb");
    $data = fread($file,filesize($imagepath));
    fclose($file);
    $data = chunk_split(base64_encode($data));
    $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$fname."\"\n" . 
    "Content-Disposition: attachment;\n" . " filename=\"$fname\"\n" . 
    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    $message .= "--{$mime_boundary}--\n";

    
    if (!mail($to_email, $subject, $message, $headers)) { 
      $errorMsg = error_get_last();
      return $errorMsg;
    }
    else 
    { 
      $successMsg = "Email Sent Successfull Successfull";
      return $successMsg;
    }
  }
  
?>