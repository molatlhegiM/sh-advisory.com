<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Identify the form
    $form_id = isset($_POST['form_id']) ? $_POST['form_id'] : '';

    // Common variables
    $to = "info@shadvisorylimited.com";
    $headers = "Content-Type: text/plain; charset=UTF-8\r\n";

    switch ($form_id) {
        case "contactForm":
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $phone = htmlspecialchars($_POST['phone']);
            $subject = htmlspecialchars($_POST['subject']);
            $message = htmlspecialchars($_POST['message']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email address. Please try again.";
                exit;
            }

            $email_subject = "Contact Form Submission: $subject";
            $email_body = "Name: $name $surname\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage:\n$message\n";

            if (mail($to, $email_subject, $email_body, $headers)) {
                echo "Your message has been successfully sent! Thank you for contacting us.";
            } else {
                echo "There was an error sending your message. Please try again later.";
            }
            break;

        case "newsletterForm":
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email address. Please try again.";
                exit;
            }

            $email_subject = "New Newsletter Signup";
            $email_body = "A new user has signed up for the newsletter:\n\nEmail: $email";

            if (mail($to, $email_subject, $email_body, $headers)) {
                echo "Thank you for subscribing to our newsletter!";
            } else {
                echo "There was an error. Please try again later.";
            }
            break;

        case "jobApplicationForm":
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $job_type = htmlspecialchars($_POST['job_type']);
            $message = htmlspecialchars($_POST['message']);

            $email_subject = "New Job Application";
            $email_body = "Name: $name\nEmail: $email\nPhone: $phone\nJob Type: $job_type\nMessage:\n$message\n";

            if (mail($to, $email_subject, $email_body, $headers)) {
                echo "Your application has been successfully submitted!";
            } else {
                echo "There was an error sending your application. Please try again.";
            }
            break;

        default:
            echo "Invalid form submission.";
    }
} else {
    echo "Invalid request method.";
}
?>
