<?PHP
class Mail extends model {
  public function sendMail($to, $msg) {

    $from = "forwarder.erikson@eriksonoliveira.com";
    $receiver = $to;
    $subject = "Recuperação de senha - Monitoramento Meteorológico";
    $msg_body = "Message: ".$msg;
    $msg_head = "From: ".$from."\r\n";
  //  echo nl2br($msg_head);

    mail($receiver, $subject, $msg_body, $msg_head);
  }
}
?>
