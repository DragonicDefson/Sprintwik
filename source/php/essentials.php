<?php
    namespace Sprintwik;
    use Sprintwik as Sprintwik;
    date_default_timezone_set('Europe/Amsterdam');

    class essentials {
        
        static function encrypt ($text, $public_key) {
            $configuration = parse_ini_file("{$_SERVER['DOCUMENT_ROOT']}/source/configuration/config.ini");
            $algorithm = $configuration['algorithm'];
            $private_key = $configuration['private_key'];
            return bin2hex(openssl_encrypt($text, $algorithm, $private_key, OPENSSL_RAW_DATA,  $public_key));
        }

        static function public_key () {
            return bin2hex(openssl_random_pseudo_bytes(8));
        }

        static function date () {
            return \Sprintwik\essentials::format_day(date('N')) . ' ' . date('j') . ' ' . \Sprintwik\essentials::format_month(date('n')) . ' ' . date('Y') . ' - ' . date('H:i');
        }
        
        static function options ($parameters) {
            return [
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_POST           => true,
              CURLOPT_POSTFIELDS     => $parameters,
              CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json'
              ],
              CURLOPT_SSL_VERIFYPEER => false
            ];
        }

        static function format_day ($index) {
            $date_array = ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag'];
            return $date_array[$index - 1];
        }

        static function format_month ($index) {
            $date_array = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];
            return $date_array[$index - 1];
        }
    }
?>
