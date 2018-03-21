<?php

if (isset($_POST['email'])) {

  // Email fields
  $email_to = "richardjshu@gmail.com";
  $email_subject = "Success! Your website contact form works";

  // Contact form fields
  $name = $_POST['name'];
  $email_from = $_POST['email'];
  $message = $_POST['message'];

  // Error message
  $error_message = "";

  // Email validation
  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  // Name validation
  $string_exp = "/^[A-Za-z .'-]+$/";

  // This function displays the error message if the contact form is not submitted correctly.
  function died ($error) {
      echo "There were errors found with the form you submitted:<br/><br/>";
      echo $error."<br/>";
      echo "Please go back and fix these errors.<br/><br/>";
      die();
  }

  // validation expected data exists
  if (!isset($_POST['name']) ||
      !isset($_POST['email']) ||
      !isset($_POST['message'])) {
      died("We are sorry, but there appears to be a problem with the form you submitted.");       
  }
 
  if (!preg_match($email_exp,$email_from)) {
    $error_message .= "The email address you entered is not valid.<br/>";
  }
 
  if (!preg_match($string_exp,$name)) {
    $error_message .= "The name you entered is not valid.<br/>";
  }
 
  if (strlen($message) < 2) {
    $error_message .= "The message you entered is not valid.<br/>";
  }
 
  if (strlen($error_message) > 0) {
    died($error_message);
  }
 
  $email_message = "Form details below.\n\n";

   
  function clean_string ($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad, "", $string);
  }

  $email_message .= "Name: ".clean_string($name)."\n";
  $email_message .= "Email: ".clean_string($email_from)."\n";
  $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- =Success message when the contact form is submitted correctly -->
 
Thank you for contacting me!
 
<?php
 
}
?>