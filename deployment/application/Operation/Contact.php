<?php
namespace Operation;

use Config\Config;
use P3x\Language;
use P3x\Router;

class Contact
{
    public static function Execution()
    {
        $reCaptchaBackendKey = Config::$private['recaptcha']['backend'];
        //echo $reCaptchaBackendKey;
        //exit;

        $email = isset($_POST['contact-form-email']) ? $_POST['contact-form-email'] : '';
        $message = isset($_POST['contact-form-message']) ? $_POST['contact-form-message'] : '';
        $result = [
            'result' => null,
            'error' => []
        ];
        if (strlen(trim($message)) == 0) {
            $result['error']['contact-form-message'] = Language::Get('contact', 'contact-form-message-error');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['error']['contact-form-email'] = Language::Get('contact', 'contact-form-email-error');
        }


        if ( count($result['error']) === 0) {
            $post_data = http_build_query(
                array(
                    'secret' => $reCaptchaBackendKey,
                    'response' => $_POST['g-recaptcha-response'],
                    // 'remoteip' => $_SERVER['REMOTE_ADDR']
                )
            );
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );
            $context  = stream_context_create($opts);
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
            $captcha_success = json_decode($response);

            if ($captcha_success->success !== true) {
                $result['error']['contact-form-captcha'] = Language::Get('contact', 'contact-form-recaptcha-error');
            }
        }

        if (count($result['error']) === 0) {
            $data = Router::RequestInfo();

            $message
                = <<<EOF
{$email}
<br/><br/>
<strong>{$message}</strong>
<br/><br/>
{$data}
EOF;
            $own_email = base64_decode(EMAIL);
            $own_email_name = Language::Get('layout', 'title');
            $header
                = <<<EOF
Content-Type: text/html; charset=UTF-8            
MIME-Version: 1.0
From: $own_email_name <{$own_email}>;
Reply-To: {$email};
EOF;

            $mail = \Operation\Mail::Send($email, base64_decode(EMAIL),Language::Get('contact', 'contact-form-mail-subject'),$message );

            if ($mail == false) {
                $result['error']['contact-form-email'] = Language::Get('contact', 'contact-form-mail-error');
            }
            // $result['alert-messsage'] = \Language::Get('contact', 'contact-Form-email-verify-Error');
        }

        $result['result'] = count($result['error']) == 0 ? 'success' : 'error';
        return $result;
    }
}
