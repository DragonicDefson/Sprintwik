<?php
  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
  session_start();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/templates.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");

  if (isset($_POST['email']) && isset($_POST['password'])) {
    if (empty($_POST['email'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/login.php?status=email-false'); exit();
    } else if (empty($_POST['password'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/login.php?status=password-false'); exit();
    } else {
      
      $api_endpoint = $configuration['api_endpoint'] . 'authentication/user/login';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::login(
          $_POST['email'],
          $_POST['password']
      ))));
      $response = curl_exec($init);

      if (json_decode($response) === '200') {
        $_SESSION['email'] = $_POST['email'];
        header('Location: ' . $configuration['root'] . 'timeline/index.php'); exit();
      } else {
        header('Location: ' . $configuration['root'] . 'authentication/student/login.php?status=login-false'); exit();
      }
    }
  }
?>
