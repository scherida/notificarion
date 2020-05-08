<?php
namespace Notification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Email 
{
    
    private $mail = \stdClass::class;
    
    public function __construct(){
        $this->mail = new PHPMailer;
        $this->mail->SMTPDebug = 0;                                         // Enable verbose debug output
        $this->mail->isSMTP();                                              // Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
        $this->mail->SMTPAuth = true;                                    // Enable SMTP authentication
        $this->mail->Username   = 'teste@gmail.com';               // SMTP username
        $this->mail->Password   = 'teste@123';                             // SMTP password
        $this->mail->SMTPSecure =  'ssl';                                    // Enable TLS encryption; `ssl` also accepted
        $this->mail->Port       = 465;                                      // TCP port to connect to
        $this->mail->Charset    = 'utf-8';
        $this->mail->setLanguage('br');
        $this->mail->isHtml(true);
        $this->mail->setFrom('test@gmail.com', 'Curso FullStack');
    }
  
    public function sendMail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName) {
        $this->mail->Subject = (string)$subject;
        $this->mail->msgHTML = $body;
        
        //Remetente do Email
        $this->mail->addReplyTo($replyEmail, $replyName);
        //Destinatário
        $this->mail->addAddress($addressEmail, $addressName);
        
        try{
            $this->mail->send();
        } catch (Exception $ex) {
            echo "Erro ao enviar: {$this->mail->ErrorInfo}{$ex->getMessage()}";
        }        
    }
}

