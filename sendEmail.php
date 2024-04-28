<?php
header('Content-Type: application/json');

require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

$response = [
    'status' => 'error',
    'message' => 'Failed to send message. Please try again.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $messageContent = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($messageContent)) {
        // Create an SES client
        $sesClient = new SesClient([
            'version' => 'latest',
            'region'  => 'us-east-1', // Change this to your preferred AWS region
        ]);

        $senderEmail = 'belentesfaye17@gmail.com'; // Change this to your verified email in SES

        // Set up the email parameters
        $emailParams = [
            'Destination' => [
                'ToAddresses' => ['belentesfaye17@gmail.com'], // Change this to your recipient email
            ],
            'Message' => [
                'Body' => [
                    'Text' => [
                        'Charset' => 'UTF-8',
                        'Data' => $messageContent,
                    ],
                ],
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data' => 'New message from your website',
                ],
            ],
            'Source' => $senderEmail,
        ];

        try {
            // Send the email
            $result = $sesClient->sendEmail($emailParams);
            $messageId = $result->get('MessageId');
            
            // Check if the email was successfully sent
            if ($messageId) {
                $response = [
                    'status' => 'success',
                    'message' => 'Message sent successfully!'
                ];
            }
        } catch (AwsException $e) {
            // Handle errors
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
