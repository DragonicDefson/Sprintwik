<?php
 
  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/templates.php");

  if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_repeat'])) {
    if (empty($_POST['first_name'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=first_name-false'); exit();
    } else if (empty($_POST['last_name'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=last_name-false'); exit();
    } else if (empty($_POST['email'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=email-false'); exit();
    } else if (empty($_POST['password'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=password-false'); exit();
    } else if (empty($_POST['password_repeat'])) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=password-repeat-false'); exit();
    } else if ($_POST['password'] !== $_POST['password_repeat']) {
      header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=password-password_repeat-false'); exit();
    } else {
      $api_endpoint = $configuration['api_endpoint'] . 'authentication/user/register';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::register(
          $_POST['first_name'],
          $_POST['last_name'],
          $_POST['email'],
          $_POST['password']
        )
      )));
      $response = curl_exec($init);

      if (json_decode($response) === '200') {
        header('Location: ' . $configuration['root'] . 'authentication/student/login.php?status=register-true'); exit();
      } else if (json_decode($response) === '205') {
        header('Location: ' . $configuration['root'] . 'authentication/student/register.php?status=existing-user-true'); exit();
      }
    }
  }
?>
