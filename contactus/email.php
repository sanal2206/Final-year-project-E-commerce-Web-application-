<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
 $name = $_POST["name"];
 $email = $_POST["email"];
 $subject = $_POST["subject"];
 $message = $_POST["message"];
 // Define your email address and subject
 $to = "sanalsabu31@gmail.com";
 
 // Compose the email message
 $message_body = "Name: $name\n";
 $message_body .= "Email: $email\n";
 $message_body .= "Subject: $subject\n";
 $message_body .= "Message:\n$message";
 
 // Set additional headers
 $headers = "From: $email\r\n";
 $headers .= "Reply-To: $email\r\n";
 // Send the email
 $success = mail($to, $subject, $message_body, 
$headers);
 if ($success) {
 echo "Thank you for your message. We'll get back to you soon.";
 } else {
 echo "Sorry, something went wrong and we couldn't send your message.";
 }
}
?>