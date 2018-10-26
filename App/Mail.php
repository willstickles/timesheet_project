<?php

namespace App;

use \App\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Mail
 *
 * PHP version 7.0.2-22
 */
class Mail
{
	/**
	 * Send a message
	 *
	 * @param string    $to         Recipient
	 * @param string    $subject    Subject
	 * @param string    $text       Text-only content of the message
	 * @param string    $html       HTML content of the message
	 *
	 * @return mixed
	 */
	public static function send( $to, $subject, $text, $html ) {
		$mail = new PHPMailer(true);
		
		try {
			$mail->SMTPDebug = CONFIG::PHPMAILER_SMTPDEBUG;
			$mail->isSMTP();
			$mail->Host = CONFIG::PHPMAILER_HOST;
			$mail->SMTPAuth = CONFIG::PHPMAILER_SMTPAUTH;
			$mail->Username = CONFIG::PHPMAILER_USERNAME;
			$mail->Password = CONFIG::PHPMAILER_PASSWORD;
			$mail->SMTPSecure = CONFIG::PHPMAILER_SMTPSECURE;
			$mail->Port = CONFIG::PHPMAILER_PORT;

			$mail->setFrom( 'smtp.user@tierradaily.com', 'TierraDailyReport' );
			$mail->addAddress( $to );
			$mail->addCC( 'timesheets@tierraeng.com' );
			$mail->isHTML( true );
			$mail->Subject = $subject;
			$mail->Body = $html;
			$mail->AltBody = $text;

			$mail->send();
			Flash::addMessage( 'Mail sent successfully' );
		} catch ( Exception $e ) {
			Flash::addMessage( 'Message could not be sent.' );
			Flash::addMessage( 'Mailer Error: ' . $mail->ErrorInfo );
		}
	}
}