<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Your email address
    $to = 'belentesfaye17@gmail.com';

    // Email subject
    $subject = 'New message from portfolio website';

    // Email message
    $email_message = "Name: " . $name . "\n";
    $email_message .= "Email: " . $email . "\n";
    $email_message .= "Message:\n" . $message;

    // Headers
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send email
    if (mail($to, $subject, $email_message, $headers)) {
        echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to send message.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}
?>
