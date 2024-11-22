<?php
$port = getenv('PORT') ?: 8000;


// Function to serve HTML files
function servePage($page) {
    $filePath = __DIR__ . '/public/' . $page;
    if (file_exists($filePath)) {
        readfile($filePath);
    } else {
        http_response_code(response_code: 404);
        echo "404 Not Found";
    }
}

// Handle incoming requests
$requestUri = $_SERVER['REQUEST_URI'];

// Routing based on the requested URL
switch ($requestUri) {
    case '/':
        include 'public/index.html';
        break;
    case '/about':
        include 'public/about.html';
        break;
    case '/contact':
        include 'public/contact.html';
        break;
    case '/project':
        include 'public/projects.html';
        break;
    case '/apply':
        include 'public/apply.html';
        break;
    case '/apply_es':
        include 'public/apply_es.html';
        break;
    case '/contact-submit':
        // Handle the contact form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            $to = 'reception@alexcoelectric.com'; // Set your email address here
            $subject = 'New Contact Form Submission';
            $body = "Name: $name\nEmail: $email\nMessage:\n$message";
            $headers = "From: $email";

            // Send the email
            if (mail($to, $subject, $body, $headers)) {
                echo 'Thank you for your message!';
            } else {
                echo 'Error sending email.';
            }
        }
        break;
    case '/apply-submit':
        // Handle the contact form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $phone = htmlspecialchars($_POST['phone']);
            $email = htmlspecialchars($_POST['email']);
            $position = htmlspecialchars($_POST['position']);
            $q1 = htmlspecialchars($_POST['q1']);
            $q2 = htmlspecialchars($_POST['q2']);
            $start = htmlspecialchars($_POST['start']);
            $salary = htmlspecialchars($_POST['salary']);
            $message = htmlspecialchars($_POST['message']);
            $tool_1 = htmlspecialchars($_POST['tool_1']);
            $tool_2 = htmlspecialchars($_POST['tool_2']);
            $tool_3 = htmlspecialchars($_POST['tool_3']);
            $tool_4 = htmlspecialchars($_POST['tool_4']);
            $tool_5 = htmlspecialchars($_POST['tool_5']);
            $tool_6 = htmlspecialchars($_POST['tool_6']);
    
            $fileTmpPath = $_FILES['resume']['tmp_name'];
            $fileName = $_FILES['resume']['name'];
            $fileSize = $_FILES['resume']['size'];
            $fileType = $_FILES['resume']['type'];
            $fileContent = file_get_contents($fileTmpPath);

            // Generate a boundary for the email
            $boundary = md5(time());

            // Email headers
            $to = 'reception@alexcoelectric.com';
            $subject = 'New Application Form Submission';
            $headers = "From: $email\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

            // Plain text body
            $body = "--$boundary\r\n";
            $body .= "Content-Type: text/plain; charset=UTF-8\r\n\r\n";
            $body .= "Name: $name\nPhone Number: $phone\nEmail: $email\nPosition: $position\nAvailable Start-Date: $start\nDesired Salary: $salary\n
            What color is designated for a Neutral conductor in a 120/208V system?: $q1\n
            What does a green wire with a yellow stripe usually represent?: $q2\n\nFormer Employers:\n$message\r\n
            The tools the applicant has: \n$tool_1\n$tool_2\n$tool_3\n$tool_4\n$tool_5\n$tool_6\n";

            // Attachment part
            $body .= "--$boundary\r\n";
            $body .= "Content-Type: $fileType; name=\"$fileName\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"$fileName\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($fileContent)) . "\r\n";
            $body .= "--$boundary--";
    
            // Send the email
            if (mail($to, $subject, $body, $headers)) {
                echo 'Thank you for your message!';
            } else {
                echo 'Error sending email.';
            }
        }
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}