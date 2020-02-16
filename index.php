<?php

  $msg = "";
  //when click on the submit button following process is happen
  if(isset($_POST['submit'])){
    require 'phpmailer/PHPMailerAutoload.php';

    //php function for executing the phpmailer
    function sendemail($to,$from,$fromName,$body,$attachment=""){
      //phpmailer code
      $mail = new PHPMailer();
      $mail->setFrom($from,$fromName);
      $mail->addAddress($to);
      $mail->addAttachment($attachment);
      $mail->Subject = 'Contact form email';
      $body->Body = $body;
      $mail->isHTML(false);

      //returns whether email is send or not
      return $mail->send();
    }

    //calling the sendEmail function
    $name = $_POST['name'];
    $email = $_POST['email'];
    $body = $_POST['message'];

    //define where the attachment is uploaded
    $file = "attachment/". basename($_FILES['attachment']['name']);
    /*echo "<pre>";
    printf($_FILES);*/
    if(move_uploaded_file($_FILES['attachment']['tmp_name'],$file)){
      if(sendEmail('pulithaanjana@gmail.com',$email,$name,$body,$file)){
          $msg = "Email sent";
        //informing the arrival of a new email to an another email account
        //sendEmail('second@gmail.com',);
      }
      else{
        $msg = "Email failed";
      }
    }
    else{
      $msg = "Please chech your attachment !";
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>php contact form</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <form class="contact-form" action="index.html" method="post" enctype="multipart/form-data">
      <div class="container">
        <label>Name</label><br>
        <input class="text-box" style="width:60%; height:30px" type="text" name="name" placeholder="Name" required><br>
        <label>email</label><br>
        <input class="text-box" style="width:60%; height:30px" type="email" name="email" placeholder="email" required><br>
        <label>message</label><br>
        <textarea name="message" rows="8" cols="80"></textarea><br>
        <label>Attach Files</label><br>
        <input type="file" name="attachment" required><br><br>
        <input class="button" style="width:30%; height:40px; border-style:none; border-radius:20px; background:crimson; color:#fff;" type="submit" name="submit" value="Send Email">
      </div>
    </form>
    <br>
    <br>

    <?php echo $msg; ?>
  </body>
</html>
