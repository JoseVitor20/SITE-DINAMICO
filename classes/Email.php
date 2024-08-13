<?php

// Implementando PHPMailer Início 2/??
    // Importar as classes do PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Email
    {

        private $mailer;

        public function __construct($host, $username, $senha, $name)
        {
            // Carregar o autoload do Composer
            require 'vendor/autoload.php';

            // Criar uma nova instância do PHPMailer
            $this->mailer = new PHPMailer;

            // Configurações do servidor
            $this->mailer->isSMTP();
            $this->mailer->Host       = $host;
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = $username;
            $this->mailer->Password   = $senha;
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = 587;

            // Adicionar o email e nome de quem envia
            $this->mailer->setFrom($username, $name);

            // Conteúdo do email
            $this->mailer->isHTML(true);
        }

        // Adicionar o email e nome de quem recebe
        public function addAdress($email, $nome)
        {
            $this->mailer->addAddress($email, $nome);
        }

        public function formatarEmail($info)
        {
            $this->mailer->Subject = $info['assunto'];
            $this->mailer->Body    = $info['corpo'];
            $this->mailer->AltBody = strip_tags($info['corpo']);
        }

        public function enviarEmail()
        {
            if ($this->mailer->send()) {
                return true;
            } else {
                return false;
            }
        }
    }
// Implementando PHPMailer Fim 2/??