<?php
include('Mail.php');
include('Mail/mime.php');

class Mailer extends CApplicationComponent
{
	public $backend;
	public $mailParams=array();
	public $mimeParams=array();
	
	public function send($from, $to, $subject, $body)
	{
		$headers['From'] = $from;
		$headers['To'] = $to;
		$headers['Subject'] = $subject;
				
		$mail_object =& Mail::factory($this->backend, $this->mailParams);
		return $mail_object->send($to, $headers, $body);
	}
	
	public function sendHTML($from, $to, $subject, $html)
	{
		$headers['From'] = $from;
		$headers['To'] = $to;
		$headers['Subject'] = $subject;
		
		$mime = new Mail_mime($this->mimeParams);
		
		$mime->setHTMLBody($html);
		
		$body = $mime->get();
		$headers = $mime->headers($headers);
		
		$mail_object =& Mail::factory($this->backend, $this->mailParams);
		return $mail_object->send($to, $headers, $body);
	}
}