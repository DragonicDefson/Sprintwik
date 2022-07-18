<?php
  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  session_start();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/templates.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");

  class profile {

    static function select_settings () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      $api_endpoint = $configuration['api_endpoint'] . 'data/user/profile/select/settings';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::select_settings(
        $_SESSION['email']
      ))));
      return json_decode(curl_exec($init), true);
    }

    static function update_profile_picture () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      if ($_FILES['file']['tmp_name'] === '') {
        header('Location: ' . $configuration['root'] . 'profile/index.php'); exit();
      } else {
        $file_extensions = array('gif', 'png', 'jpg');
        $file_name = $_FILES['file']['name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($extension, $file_extensions)) {
          $file = file_get_contents($_FILES['file']['tmp_name']);
          $encoded_file = base64_encode($file);
          $api_endpoint = $configuration['api_endpoint'] . 'data/user/profile/update/profile-picture';
          $init = curl_init($api_endpoint);
          curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::update_profile_picture(
            $_SESSION['email'],
            $encoded_file
          ))));
          $response = curl_exec($init);
          if (json_decode($response) === '200') {
            header('Location: ' . $configuration['root'] . 'profile/index.php?status=profile-picture-true'); exit();
          } else {
            header('Location: ' . $configuration['root'] . 'profile/index.php?status=profile-picture-false'); exit();
          }
        } else {
          header('Location: ' . $configuration['root'] . 'profile/index.php?status=extension-false'); exit();
        }
      }
    }

    static function update_user_settings () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      $api_endpoint = $configuration['api_endpoint'] . 'data/user/profile/update/user-settings';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::update_user_settings(
        $_SESSION['email'],
        $_POST['first_name'],
        $_POST['last_name'],
        $_POST['email'],
        $_POST['password']
      ))));
      $response = curl_exec($init);
      if (json_decode($response) === '200') {
        $_SESSION['email'] = $_POST['email'];
        header('Location: ' . $configuration['root'] . 'profile/index.php?status=user-settings-true'); exit();
      } else {
        header('Location: ' . $configuration['root'] . 'profile/index.php?status=user-settings-false'); exit();
      }
    }

    static function update_contact_data () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      $api_endpoint = $configuration['api_endpoint'] . 'data/user/profile/update/contact-data';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::update_contact_data(
        $_SESSION['email'],
        $_POST['address'],
        $_POST['city'],
        $_POST['country']
      ))));
      $response = curl_exec($init);
      if (json_decode($response) === '200') {
        header('Location: ' . $configuration['root'] . 'profile/index.php?status=contact-data-true'); exit();
      } else {
        header('Location: ' . $configuration['root'] . 'profile/index.php?status=contact-data-false'); exit();
      }
    }

    static function update_header_picture () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      if ($_FILES['file']['tmp_name'] === '') {
        header('Location: ' . $configuration['root'] . 'profile/index.php'); exit();
      } else {
        $file_extensions = array('png', 'jpg');
        $file_name = $_FILES['file']['name'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($extension, $file_extensions)) {
          $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
          $file = file_get_contents($_FILES['file']['tmp_name']);
          $encoded_file = base64_encode($file);
          $api_endpoint = $configuration['api_endpoint'] . 'data/user/profile/update/header-picture';
          $init = curl_init($api_endpoint);
          curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::update_header_picture(
            $_SESSION['email'],
            $encoded_file
          ))));
          $response = curl_exec($init);
          if (json_decode($response) === '200') {
            header('Location: ' . $configuration['root'] . 'profile/index.php?status=header-profile-true'); exit();
          } else {
            header('Location: ' . $configuration['root'] . 'profile/index.php?status=header-profile-false'); exit();
          }
        } else {
          header('Location: ' . $configuration['root'] . 'profile/index.php?status=extension-false'); exit();
        }
      }
    }
  }

  $profile = new profile();

  if (isset($_GET['profile_picture'])) {
    $profile::update_profile_picture();
  }

  if (isset($_GET['user_settings'])) {
    $profile::update_user_settings();
  }

  if (isset($_GET['contact_data'])) {
    $profile::update_contact_data();
  }

  if (isset($_GET['header_picture'])) {
    $profile::update_header_picture();
  }

?>
