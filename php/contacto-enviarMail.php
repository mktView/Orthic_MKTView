<?php
$remitente = $_POST['email'];
$destinatario = 'juanantonio488@gmail.com';
$asunto = 'Contacto-Orthic'; 
if (!$_POST){
?>

<?php
}else{
	 
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
}
?>
