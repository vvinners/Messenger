<?php

namespace VVinners\Messenger;

use VVinners\Messenger\SendGrid;
use VVinners\Messenger\Nexmo;

class Messenger {

    //send email
    //send sms
    // build email template
    // email template (account activation, forgot password, registration, logged in notification, reminder, custom empty email)
    // sms templae (account activation, forgot password, registration, logged in notifcaation, custom sms template)
    /// activation (name, link to activate account)
    // help others to register account send account details to them

    /**
     * sendmail
     *
     * @param  array $to `name` for receiver's name `email` for receiver's email
     * @param  array $data `name` for receiver's name and `url` is for activation url that should redirect to own website / host
     * @param  string $type support various of type, will send activation mail template by default
     *
     * @return void
     */

    public static function sendActivation($user_id, $delivery_type = "email", $model = Admin::class) {
        $user = $model::find($user_id);
        if ($user) {
            if ($delivery_type == "email") {
                $mail = new SendGrid();

                $to = [
                    "name" => $user->name,
                    "email" => $user->email
                ];

                $data = [
                    "name" => $user->name,
                    "url" => "https://www.vvinners.com/" // TODO, should replace the link with dynamic generated link
                ];

                return $mail->sendActivation($to, $data);
            } else {
                // otherwise send sms
                // TODO
                // should get user activation code to dynamically

                $content = "
                    Hi $user->name, activation code is 51273
                ";

                $sms = new Nexmo();
                return $sms->send($user->phone_num, $content);
            }

        }

        return null;
    }

    public static function sendEmail($to, $subject, $content) {
        $mail = new SendGrid();
        return $mail->send($to, $subject, $content);
    }

    public static function sendSMS($to, $content) {
        $sms = new Nexmo();
        return $sms->send($to, $content);
    }

    // add user type and user id ?
    // public static function sendmail($to, $data = [], $type = "activation") {

    //     if ($type == "activation") {
    //         if ($data["name"] != null && $data["url"] != null) {
    //             $mail = new SendGridController();
    //             $mail->sendActivationMail($to, $data);
    //         }
    //     } else if ($type == "forgot") {
    //     }

    // }

}

?>
