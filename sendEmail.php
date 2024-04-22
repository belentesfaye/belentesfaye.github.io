<?php
header('Content-Type: application/json');

$response = [
    'status' => 'error',
    'message' => 'Failed to send message. Please try again.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $messageContent = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($messageContent)) {
        $to = 'belentesfaye17@gmail.com';
        $subject = 'New message from your website';
        $headers = "From: $email\r\n";

        if (mail($to, $subject, $messageContent, $headers)) {
            $response = [
                'status' => 'success',
                'message' => 'Message sent successfully!'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to send message. Please try again.'
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Please fill in all required fields.'
        ];
    }
}

echo json_encode($response);

?>
