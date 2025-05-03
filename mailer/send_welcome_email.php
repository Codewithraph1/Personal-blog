<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendWelcomeEmail($email, $full_name, $username, $raw_password) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.raphonyeka.com';
        $mail->SMTPAuth = true; // ✅ Important
        $mail->Username = 'web@raphonyeka.com';
        $mail->Password = 'Akpakaraph1.';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // ✅ Better than using 'ssl' string
        $mail->Port = 465;

        // Debug (optional)
        $mail->SMTPDebug = 2; // Or 3 for full logs (remove in production)
        // $mail->Debugoutput = 'html'; // Optional: outputs as HTML for debugging



        // Recipients
        $mail->setFrom('web@raphonyeka.com', 'Blog Admin');
        $mail->addAddress($email, $full_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = ' Welcome to Our Blog Team!';
        $mail->Body    = "
            <h2>Hi $full_name,</h2>
            <p>We're excited to welcome you to the team!</p>
            <p><strong>Login Details:</strong></p>
            <ul>
                <li><strong>Username:</strong> $username</li>
                <li><strong>Password:</strong> $raw_password</li>
            </ul>
            <p>Please change your password after your first login for security reasons.</p>
            <p>Best regards,<br>The Blog Team</p>
        ";

        return $mail->send();
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}
