<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $job_type = htmlspecialchars($_POST['job_type']);
    $message = htmlspecialchars($_POST['message']);
    $to = "info@shadvisorylimited.com";
    $subject = "New Job Application";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // File attachment handling
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['resume']['tmp_name'];
        $file_name = $_FILES['resume']['name'];
        $file_type = $_FILES['resume']['type'];
        $file_size = $_FILES['resume']['size'];

        $boundary = md5(uniqid(time()));
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        $message_body = "--$boundary\r\n";
        $message_body .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $message_body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message_body .= "Name: $name\n";
        $message_body .= "Email: $email\n";
        $message_body .= "Phone: $phone\n";
        $message_body .= "Job Type: $job_type\n";
        $message_body .= "Message: $message\n\n";
        
        // Add attachment
        $file_content = chunk_split(base64_encode(file_get_contents($file_tmp)));
        $message_body .= "--$boundary\r\n";
        $message_body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $message_body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
        $message_body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $message_body .= "$file_content\r\n";
        $message_body .= "--$boundary--";

        $mail_sent = mail($to, $subject, $message_body, $headers);
        if ($mail_sent) {
            echo "Application submitted successfully!";
        } else {
            echo "Failed to send application. Please try again.";
        }
    } else {
        echo "Please attach a valid resume file.";
    }
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $project = htmlspecialchars($_POST['project']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "info@shadvisorylimited.com"; // Recipient email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $full_message = "Name: $name\n";
    $full_message .= "Email: $email\n";
    $full_message .= "Phone: $phone\n";
    $full_message .= "Project: $project\n";
    $full_message .= "Subject: $subject\n";
    $full_message .= "Message:\n$message\n";

    if (mail($to, $subject, $full_message, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request method.";
}
?>


