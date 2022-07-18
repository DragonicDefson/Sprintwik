<?php

  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  session_start();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/templates.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");

  class timeline {

    static function select_header () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      $api_endpoint = $configuration['api_endpoint'] . 'data/user/timeline/select/header';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::select_header(
        $_SESSION['email']
      ))));
      return json_decode(curl_exec($init), true);
    }

    static function select_post () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      $api_endpoint = $configuration['api_endpoint'] . 'data/user/timeline/select/post';
      $init = curl_init($api_endpoint);
      curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::select_post(
        $_SESSION['email']
      ))));
      return array_reverse(json_decode(curl_exec($init), true));
    }

    static function insert_post () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      if (isset($_SESSION['email'])) {
        if (empty($_POST['text'])) {
          header('Location: ' . $configuration['root'] . 'timeline/index.php?status=text-false'); exit();
        } else {
          $authentication_api_endpoint = $configuration['authentication_api_endpoint'] . 'data/user/check';
          $init = curl_init($authentication_api_endpoint);
          curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::check(
            $_SESSION['email']
          ))));
          $response = curl_exec($init);
          if (json_decode($response) === '200') {
            if ($_FILES['file']['tmp_name'] === '') {
              $api_endpoint = $configuration['api_endpoint'] . 'data/user/timeline/insert/post';
              $init = curl_init($api_endpoint);
              curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::insert_post(
                $_SESSION['email'],
                $_POST['text'],
                $encoded_file
              ))));
              $response = curl_exec($init);
              if (json_decode($response) === '200') {
                header('Location: ' . $configuration['root'] . 'timeline/index.php?status=insert-true'); exit();
              } else {
                header('Location: ' . $configuration['root'] . 'timeline/index.php?status=insert-false'); exit();
              }
            } else {
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
                  $api_endpoint = $configuration['api_endpoint'] . 'data/user/timeline/insert/post';
                  $init = curl_init($api_endpoint);
                  curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::insert_post(
                    $_SESSION['email'],
                    $_POST['text'],
                    $encoded_file
                  ))));
                  $response = curl_exec($init);
                  if (json_decode($response) === '200') {
                    header('Location: ' . $configuration['root'] . 'timeline/index.php?status=insert-true'); exit();
                  } else {
                    header('Location: ' . $configuration['root'] . 'timeline/index.php?status=insert-false'); exit();
                  }
                } else {
                  header('Location: ' . $configuration['root'] . 'timeline/index.php?status=extension-false'); exit();
                }
              }
            } 
          }   
        }
      }
    }

    static function remove_post () {
      $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
      if (isset($_SESSION['email'])) {
        $authentication_api_endpoint = $configuration['authentication_api_endpoint'] . 'data/user/check';
        $init = curl_init($authentication_api_endpoint);
        curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::check(
          $_SESSION['email']
        ))));
        $response = curl_exec($init);
        if (json_decode($response) === '200') {
          $api_endpoint = $configuration['api_endpoint'] . 'data/user/timeline/remove/post';
          $init = curl_init($api_endpoint);
          curl_setopt_array($init, \Sprintwik\essentials::options(json_encode(\Sprintwik\templates::remove_post(
            $_POST['upid']
          ))));
          $response = curl_exec($init);
          if (json_decode($response) === '200') {
            header('Location: ' . $configuration['root'] . 'timeline/index.php?status=remove-true'); exit();
          } else {
            header('Location: ' . $configuration['root'] . 'timeline/index.php?status=remove-false'); exit();
          }
        }
      }
    }
  }

  if (isset($_GET['post'])) {
    $timeline = new timeline(); $timeline::insert_post();
  }

  if (isset($_POST['upid'])) {
    $timeline = new timeline(); $timeline::remove_post();
  }

?>
