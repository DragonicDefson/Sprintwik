<?php

  namespace Sprintwik;
  use Sprintwik as Sprintwik;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/source/php/essentials.php");

  class templates {

    static function select_settings ($email) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key)
      ];
    }

    static function login ($email, $password) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'password' => \Sprintwik\essentials::encrypt($password, $public_key)
      ];
    }

    static function register ($first_name, $last_name, $email, $password) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'first_name' => \Sprintwik\essentials::encrypt($first_name, $public_key),
        'last_name' => \Sprintwik\essentials::encrypt($last_name, $public_key),
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'password' => \Sprintwik\essentials::encrypt($password, $public_key),
      ];
    }

    static function select_header ($email) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key)
      ];
    }

    static function select_post ($email) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key)
      ];
    }

    static function check ($email) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key)
      ];
    }

    static function insert_post ($email, $text, $file) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'text' => \Sprintwik\essentials::encrypt($text, $public_key),
        'date' => \Sprintwik\essentials::encrypt(\Sprintwik\essentials::date(), $public_key),
        'picture' => \Sprintwik\essentials::encrypt($file, $public_key)
      ];
    }

    static function update_profile_picture ($email, $file) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'profile_picture' => \Sprintwik\essentials::encrypt($file, $public_key)
      ];
    }

    static function update_header_picture ($email, $file) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'header_picture' => \Sprintwik\essentials::encrypt($file, $public_key)
      ];
    }

    static function update_user_settings ($check_email, $first_name, $last_name, $email, $password) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'check_email' => \Sprintwik\essentials::encrypt($check_email, $public_key),
        'first_name' => \Sprintwik\essentials::encrypt($first_name, $public_key),
        'last_name' => \Sprintwik\essentials::encrypt($last_name, $public_key),
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'password' => \Sprintwik\essentials::encrypt($password, $public_key)
      ];
    }

    static function update_contact_data ($email, $address, $city, $country) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'email' => \Sprintwik\essentials::encrypt($email, $public_key),
        'address' => \Sprintwik\essentials::encrypt($address, $public_key),
        'city' => \Sprintwik\essentials::encrypt($city, $public_key),
        'country' => \Sprintwik\essentials::encrypt($country, $public_key)
      ];
    }

    static function remove_post ($upid) {
      $public_key = \Sprintwik\essentials::public_key();
      return [
        'public_key' => $public_key,
        'upid' => \Sprintwik\essentials::encrypt($upid, $public_key)
      ];
    }
  }
?>