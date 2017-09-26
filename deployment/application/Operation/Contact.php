<?php
namespace Operation;

use P3x\Language;
use P3x\Router;

class Contact
{
    public static function Execution()
    {
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

        if (count($result['error']) == 0) {
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