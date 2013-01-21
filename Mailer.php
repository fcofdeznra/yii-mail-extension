<?php
class Mailer extends CApplicationComponent
{
	public $backend;
	public $params;
	
	public function init()
	{
		include('Mail.php');
		
		parent::init();
	}
	
	public function send($from, $to, $subject, $body)
	{
		$headers['From'] = $from;
		$headers['To'] = $to;
		$headers['Subject'] = $subject;
				
		$mail_object =& Mail::factory($this->backend, $this->params);
		return $mail_object->send($to, $headers, $body);
	}
}