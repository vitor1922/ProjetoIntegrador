<?php
    //Importa as classes do PHPMailer para o escopo global
    //Eles devem estar no topo do seu script, não dentro de uma função
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //Carrega o Composer's autoloader
    require 'vendor/autoload.php';

    //Cria uma instância; Passando `true` para habilitar exeções
    $mail = new PHPMailer(true);

    try {
        //Configurações de servidor
        $mail->isSMTP();                                                 //Envia usando SMTP
        $mail->Host       = 'smtp.gmail.com';                            //Definir o servidor SMTP para enviar
        $mail->SMTPAuth   = true;                                        //Habilita autenticação por SMTP 
        $mail->Username   = 'sistemasenacsaude@gmail.com';               //SMTP Usuario
        $mail->Password   = 'agcwxqbeqhnzuagc';                          //SMTP Senha
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                 //Ativar criptografia TLS implícita
        $mail->Port       = 465;                                         //Porta TCP para se conectar;
        
        //Destinatários
        $mail->setFrom('sistemasenacsaude@gmail.com', 'Suporte Senac');
        $mail->addAddress("$email",$_SESSION["user"]["nomeCompleto"]);        //Adiciona um destinatário
        $mail->isHTML(true);                                             //Defini o formato de email para HTML
        $mail->Subject = "Esqueci minha senha";
        $mail->Body    = utf8_decode( "
            <head>
            <meta charset='UTF-8'>
                <style>
                    .text-danger {
                        color: red;
                    }
                </style>
            </head>
            <body>
                <b>Olá, ".generateName()."</b>
                <p>Recebemos uma solicitação de redefinição de senha do seu Senac Saúde.<br> Insira o seguinte código para continuar:</p>
                <h1 class='text-danger'><b>$cod</b></h1>
                <p>Se esta mensagem não foi solcitada por você, sua conta pode estar em risco.</p>
                <b>Atenciosamente, equipe Senac Saúde.</b>
            </body>
        ");
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        generateWarning("Código enviado por email!</br><div class='spinner-border text-success mt-2'></div>", false);
    } catch (Exception $e) {
        generateWarning("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
?>