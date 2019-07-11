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

        $transporter = (new \Swift_SmtpTransport($smtp['host'], $smtp['port'], $smtp['security']))
            ->setUsername($settings['email']['username'])
            ->setPassword($settings['email']['password']);

        $mailer = new \Swift_Mailer($transporter);

        $message = (new \Swift_Message($subject))
            ->setFrom($settings['email']['username'])
            ->setReplyTo($from)
            ->setTo($to)
            ->setBody($message)
            ->setContentType("text/html");
        $result = $mailer->send($message);
        return $result;
    }
}
