<?php
/**
 * This script will try to send an email using PHP's mail() function and hopefully
 * help you diagnose any problems you might have sending emails with your web server.
 *
 * Enter your email address inside the single quotes below. Then upload this file
 * to your web server and visit the page with your web browser.
 *
 * If the script says the email was successfully accepted for delivery it does
 * not guarantee that the message will arrive.  You will need to check your inbox.
 * If the mail does not arrive then there is a problem with your mail delivery system,
 * you should ask your hosting company if they allow you to use PHP's mail() function and
 * how to get it working, it is not a problem with the Quform script.
 *
 * If the script says the email was not accepted for delivery you should check for
 * any other errors on the page that may indicate the reason for this.  You will need
 * to ask your hosting company if they allow you to use PHP's mail() function and
 * how to set that up.
 *
 * If your hosting company does not allow you to use the mail() function, you should read
 * the Quform documentation which explains how you can set up the Quform to use an SMTP server
 * instead to send the email.  Alternatively you could find another host that does allow you to
 * use the function.
 */

// Enter your email address inside the single quotes
$email = '';

// Turn on all error reporting
error_reporting(-1);
@ini_set('display_errors', 'On');

// Send the email
$result = mail($email, 'Test message from Quform', 'Your server can send email successfully :)', "From: $email");

if ($result) {
    echo 'Mail was accepted for delivery, this does NOT guarantee that it will arrive! Check your inbox, if you do not receive the email then there is a problem with your host!';
} else {
    echo 'Mail was NOT accepted for delivery - contact your host!';
}