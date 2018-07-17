 <?php
$to = "bjkumar@technosofteng.com";
$subject = "Nonsensical Latin";

// compose headers
$headers = "From: bjkumar@technosofteng.com\r\n";
$headers .= "Reply-To: bjkumar@technosofteng.com\r\n";
$headers .= "X-Mailer: PHP/".phpversion();

// compose message
$message = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.";
$message .= " Nam iaculis pede ac quam. Etiam placerat suscipit nulla.";
$message .= " Maecenas id mauris eget tortor facilisis egestas.";
$message .= " Praesent ac augue sed enim aliquam auctor. Ut dignissim ultricies est.";
$message .= " Pellentesque convallis tempor tortor. Nullam nec purus.";
$message = wordwrap($message, 70);

// send email
mail($to, $subject, $message, $headers);
?>
