<?php

namespace vvinners\Messenger;

class SendGrid
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $_sendgrid = null;

    public function __construct() {
        $this->_sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
    }

    public function send($to, $subject = "no subject", $content) {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(env("MESSENGER_FROM_EMAIL", "noreply@domain.com"), env("MESSENGER_FROM_NAME", "noreply"));
        $email->setSubject($subject);
        $email->addTo($to["email"], $to["name"]);
        $email->addContent(
            "text/html", $content
        );
        // $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        try {
            return $response = $this->_sendgrid->send($email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function sendActivation($to, $data) {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom(env("MESSENGER_FROM_EMAIL", "noreply@domain.com"), env("MESSENGER_FROM_NAME", "noreply"));
        $email->setSubject("Account activation");
        $email->addTo($to["email"], $to["name"]);
        $email->addContent(
            "text/html", view("messenger::email.activation", $data)->render()
        );
        // $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
        try {
            return $response = $this->_sendgrid->send($email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }


}
