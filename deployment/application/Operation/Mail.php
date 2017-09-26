<?php
namespace Operation;

use Config\Config;

class Mail
{
    public static function Send($from, $to, $subject, $message)
    {
        $settings = Config::$private;
//        print_r($settings->gmail->username);
//        print_r($settings->gmail->password);
//        exit;
        $smtp = $settings['email']['smtp'];
        $transporter = \Swift_SmtpTransport::newInstance($smtp['host'], $smtp['port'], $smtp['security'])
            ->setUsername($settings['email']['username'])
            ->setPassword($settings['email']['password']);

        $mailer = \Swift_Mailer::newInstance($transporter);

        $message = \Swift_Message::newInstance($subject)
            ->setFrom($settings['email']['username'])
            ->setReplyTo($from)
            ->setTo($to)
            ->setBody($message)
            ->setContentType("text/html")
        ;
        $result = $mailer->send($message);
        return $result;
    }
}