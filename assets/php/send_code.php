<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

function sendCode($email, $subject, $code) {
    global $mail;
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'gonzalochiaradia@gmail.com';                     
        $mail->Password   = 'fnlz uqql cbsm wnas'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    

        //Recipients
        $mail->setFrom('gonzalochiaradia@gmail.com', 'PicFlow');    
        $mail->addAddress($email);               

        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    padding: 20px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #333;
                }
                p {
                    font-size: 16px;
                    color: #555;
                }
                .code {
                    font-size: 24px;
                    font-weight: bold;
                    color: #007bff;
                    padding: 10px;
                    border: 1px solid #007bff;
                    border-radius: 5px;
                    display: inline-block;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #aaa;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <img src="assets/images/pictogram.png" alt="Logo" style="max-width: 100%; height: auto; margin-bottom: 20px;"> 
                <h1>¡Hola!</h1>
                <p>Tu código de verificación es:</p>
                <div class="code">'.$code.'</div>
                <p>Por favor, ingrésalo en la aplicación para continuar.</p>
                <div class="footer">Si no solicitaste este código, ignora este correo.</div>
            </div>
        </body>
        </html>';
        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar el correo: {$mail->ErrorInfo}");
        echo "No se pudo enviar el mensaje.";
    }
}