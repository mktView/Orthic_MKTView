<?php
$remitente = $_POST['email'];
$destinatario = 'juanantonio488@gmail.com';
$asunto = 'Contacto-Orthic'; 
$captcha;
$secretKey = "6Le4quUUAAAAAC46Ocq3XoDv672VIYdRLCt2YUPV";
if (!$_POST){
?>

<?php
}else{

    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
////////////////////////////////////////////////////////
        $ch = curl_init();

        curl_setopt_array($ch, [
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'secret' => $secretKey,
            'response' => $captcha,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ],
        CURLOPT_RETURNTRANSFER => true
        ]);

        $output = curl_exec($ch);
        curl_close($ch);
////////////////////////////////////////////////////////
        $json = json_decode($output);

        if (isset($json->success) && $json->success) { 
            echo 'success'; 
            $cuerpo  = "Nombre Completo: " . $_POST["name"] . "\r\n"; 
            $cuerpo .= "Compañia: " . $_POST["company"] . "\r\n"; 
            $cuerpo .= "Email: " . $_POST["email"] . "\r\n";
            $cuerpo .= "Telefono/Celular: " . $_POST["phone"] . "\r\n";
            $cuerpo .= "Consulta: " . $_POST["message"] . "\r\n";
        
            $headers  = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=utf-8\n";
            $headers .= "X-Priority: 3\n";
            $headers .= "X-MSMail-Priority: Normal\n";
            $headers .= "X-Mailer: php\n";
            $headers .= "From: \"".$_POST['name']."\" <".$remitente.">\n";
        
            mail($destinatario, $asunto, $cuerpo, $headers);
            //include 'confirma.html';
        }else { 
            echo 'ERROR1'; 
        }
    }else{
        echo 'ERROR2';
    }
}
?>
