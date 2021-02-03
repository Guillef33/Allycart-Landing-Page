<?php 

    $notificacion="Hubo un error y el mail no se ha enviado.";
    $respuesta=0;

if(isset($_POST['email'])) {


    //<bold> Debes editar las próximas dos líneas de código de acuerdo con tus preferencias</bold>
    $email_to = "marketing@allytech.com";
    $email_subject = "Contacto desde Allycart.com";
  
    $email_from="marketing@allytech.com";
    //<bold> Aquí se deberían validar los datos ingresados por el usuario</bold>
  
    if(empty($_POST['name']) ||
      empty($_POST['email']) ||
      empty($_POST['subject']) ||
      empty($_POST['message']) )
    {
        $respuesta = 0;
        $notificacion =  "Error: Los datos ingresados no son validos o están vacíos.";
    }else {

      $nombreCliente = filter_var(ucwords(strtolower($_POST['name'])),FILTER_SANITIZE_STRING);
      $emailCliente =filter_var(strtolower($_POST['email']),FILTER_SANITIZE_EMAIL);
      $asuntoCliente = filter_var(ucfirst(strtolower($_POST['subject'])),FILTER_SANITIZE_STRING);
      $mensajeCliente = filter_var($_POST['message'],FILTER_SANITIZE_STRING);


        $email_message = "Detalles del formulario de contacto:\n\n";
        $email_message .= "Nombre: " . $nombreCliente . "\n";
        $email_message .= "E-mail: " . $emailCliente . "\n";
        $email_message .= "Asunto: " . $asuntoCliente . "\n";
        $email_message .= "Mensaje: " . $mensajeCliente . "\n\n";
  
  
        // Ahora se envía el e-mail usando la función mail() de PHP
  
        $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($email_to, $email_subject, $email_message, $headers);
        $notificacion =  "El mail se ha enviado con éxito!";
        $respuesta = 1;
    }
  
  }

    $array = array("respuesta"=>$respuesta,"notificaciones"=>$notificacion);
    echo json_encode($array);

?>
