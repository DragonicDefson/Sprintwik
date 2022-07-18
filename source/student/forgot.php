<?php
  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/vendor/autoload.php");
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/templates.php");
  
  if (isset($_POST['email'])) {
    if (empty($_POST['email'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/forgot.php?status=email-false'); exit();
    } else {

      $api_endpoint = $configuration['api_endpoint'] . 'authentication/user/check';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::check(
          $_POST['email']
      ))));
      $response = curl_exec($init);

      if (json_decode($response) === '200') {
        
        $mail = new PHPMailer();
        $mail->IsSMTP($configuration['smtp']);
        $mail->Host = $configuration['host'];
        $mail->SMTPAuth = $configuration['auth'];
        $mail->Username = $configuration['username'];
        $mail->Password = $configuration['password'];
        $mail->SMTPSecure = $configuration['encryption'];
        $mail->Port = $configuration['port'];
     
        $template = file_get_contents('../email/template.html');
        $mail->SetFrom($configuration['username'], 'Sprintwik');
        $mail->Subject = 'Wachtwoord Herstel';
        $mail->Body = $template;
        $mail->IsHTML($configuration['html']);
        $mail->AddAddress($_POST['email'], $_POST['email']);
  
        if ($mail->send()) {
          header('Location: ' . $configuration['root'] . 'authentication/student/forgot.php?status=email-send-true'); exit();
        } else {
          header('Location: ' . $configuration['root'] . 'authentication/student/forgot.php?status=email-send-false'); exit();
        }
      } else {
        header('Location: ' . $configuration['root'] . 'authentication/student/forgot.php?status=email-check-false'); exit();
      }
    }
  }
?>
