<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../config/config.php';

if (isset($_POST["email"])) {

    $emailTo = $_POST["email"];

    $code=uniqid(true);

     // Check if email already exists in the database
     $query = "SELECT * FROM users WHERE email = '$emailTo'";
     $result = $db->query($query);
 
     if ($result->rowCount() == 0) {
         echo json_encode(array('success' => false, 'message' => 'Email does not exists. try another email'));
         exit();
     }
     else{

         try {
             $statement = $db->prepare("INSERT INTO `reset-password` (code,email) VALUES (:code,:email)");
             $statement->bindValue(':code', $code);
             $statement->bindValue(':email', $emailTo);
             $statement->execute();
         } catch (PDOException $e) {
             echo "Database error: " . $e->getMessage();
             exit();
         }
     }
    

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kawanedres211@gmail.com';                     //SMTP username
        $mail->Password   = 'zqnzdjmxsjxbxvvn';                               //SMTP password
        $mail->SMTPSecure = 'tls';                                   //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('kawanedres211@gmail.com', 'facebook');
        $mail->addAddress("$emailTo");     //Add a recipient



        //Content
        $url="http://".$_SERVER["HTTP_HOST"] ."/A-Kawan-Idrees-Mawlood3"."/reset.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset Link';
        $mail->Body    = "<h1> You Requested password reset </h1>Click 
          <a href='$url'>this link</a> to reset it. $code";

        $mail->send();
        echo json_encode(array('success' => true, 'message' => 'Reset Password Link has been sent to your email'));
        exit();

    } catch (Exception $e) {
        
        echo json_encode(array('success' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));

    }
    exit();
}
?>
