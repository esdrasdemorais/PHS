<?php
include_once __DIR__ . '/../vendor/PHPMailer/PHPMailerAutoload.php';

class PHPMailerClient extends PHPMailer
{
    public function __construc()
    {
	    $this->setConfigs();
    }

    public function setConfigs()
    {
	    $this->SMTPDebug = 3;
	    $mail->setLanguage('pt_br');//, '/optional/path/to/language/directory/');
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'contato@terceiroelementoservico.com.br';                 // SMTP username
        $mail->Password = 'T3rC3ir0El3m3nt1S!';               // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->setFrom('contato@terceiroelementoservico.com.br', 'Mailer');
        $mail->addAddress('esdrasdemorias@gmail.com', 'Esdras');     // Add a recipient
        $mail->isHTML(true);                                  // Set email format to HTML
    }
}
