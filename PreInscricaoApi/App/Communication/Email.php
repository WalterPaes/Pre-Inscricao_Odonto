<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 01/02/2019
 * Time: 09:02
 */

namespace Communication;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use Helper\TemplateHelper;
use Response\ResponseJson;
use Cliente;

class Email
{
    // PHPMailer Object
    private $mail;

    // Sender Data
    private $username;
    private $email;
    private $pass;

    // Cliente Data
    private $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->mail = new PHPMailer();

        // Set Cliente Data
        $this->cliente = $cliente;
        $this->configMail();
        $this->auth();
        $this->send();
    }

    private function configMail()
    {
        header('Content-Type: text/html; charset=UTF-8');
        $this->mail->isSMTP();                      // Dizendo para o PHPMailer usar SMTP
        $this->mail->CharSet = "UTF-8";
        $this->mail->SMTPDebug = 0;                 // Definindo o Debug
        $this->mail->Host = 'smtp.office365.com';   // Definindo o Host
        $this->mail->Port = 587;                    // Definindo a Porta
        $this->mail->SMTPSecure = 'tls';            // Definindo o sistema de encriptção
        $this->mail->SMTPOptions = array(
            "ssl" => [
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            ],
        );
        $this->mail->SMTPAuth = true;               // Dizendo para o PHPMailer utilizar autenticação SMTP
    }

    private function auth()
    {
        $this->mail->Username = "YOUR_EMAIL";
        $this->mail->Password = "YOUR_PASS";
    }

    private function send()
    {
        try {
            $this->mail->setFrom('YOUR_EMAIL', 'Odontologia - SESC/PA');         // Email Remetente
            $this->mail->addAddress($this->cliente->getEmail(), $this->cliente->getNome());                 // Email Destinatário

            $this->mail->Subject = 'Comprovante de Pré-Inscrição';                                          // Assunto do Email
            $this->mail->msgHTML($this->setHtml());                                                         // Definindo o HTML do Email utilizando Template

            $this->mail->send();                                                                            // Enviando o Email

        } catch (PHPMailerException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }

    private function setHtml()
    {
        $html = TemplateHelper::render('confirm_pre_insc_tmp', [
            "{{ NOME }}" => $this->cliente->getNome(),
            "{{ IDADE }}" => $this->cliente->getIdade(),
            "{{ MATRICULA }}" => $this->cliente->getMatricula(),
            "{{ TELEFONE }}" => $this->cliente->getTelefone(),
            "{{ EMAIL }}" => $this->cliente->getEmail()
        ]);
        return $html;
    }
}