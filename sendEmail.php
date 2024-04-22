<?php
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'message' => 'Failed to send message. Please try again.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];

    $to = 'belentesfaye17@gmail.com'; // Your email address
    $subject = 'New message from your website';
    $headers = "From: $email\r\n";

    // Send email
    if (mail($to, $subject, $messageContent, $headers)) {
        $response = [
            'status' => 'success',
            'message' => 'Message sent successfully!'
        ];
    }
}

echo json_encode($response);
?>
